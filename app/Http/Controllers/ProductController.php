<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function posIndex()
    {
        $products = Product::all();
        return view('sales.index', compact('products'));
    }

    public function reportsIndex()
    {
        return view('reports.index');
    }

   public function store(Request $request)
{
    // Validaciones opcionales...
    
    $data = $request->except('imagen');

    // Comprobar si viene una imagen en la petición
    if ($request->hasFile('imagen')) {
        // Esto guarda el archivo en 'storage/app/public/productos' y devuelve la ruta ej: 'productos/abc.png'
        $data['imagen'] = $request->file('imagen')->store('productos', 'public');
    }

    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
}
public function update(Request $request, Product $product)
{
    $data = $request->except('imagen');

    if ($request->hasFile('imagen')) {
        // Opcional: podrías borrar la imagen vieja si existe con Storage::disk('public')->delete($product->imagen);
        
        // Guardar la nueva imagen
        $data['imagen'] = $request->file('imagen')->store('productos', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
}

    public function destroy(Product $product)
    {
        // Opcional: Eliminar la imagen del servidor al borrar el producto
        if ($product->imagen && Storage::disk('public')->exists($product->imagen)) {
            Storage::disk('public')->delete($product->imagen);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }

    // Carga Masiva desde archivo CSV corregida
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048'
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        // Detectar si el delimitador es coma (,) o punto y coma (;)
        $firstLine = file_get_contents($filePath, false, null, 0, 500);
        $delimiter = (strpos($firstLine, ';') !== false) ? ';' : ',';

        $handle = fopen($filePath, 'r');
        
        // Omitir encabezados
        fgetcsv($handle, 1000, $delimiter);

        $count = 0;
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            if (isset($data[0]) && !empty(trim($data[0]))) {
                
                // Evitar duplicados por código de barras si ya existe, de lo contrario lo crea
                Product::updateOrCreate(
                    ['codigo_barras' => isset($data[1]) && !empty(trim($data[1])) ? trim($data[1]) : null],
                    [
                        'nombre' => trim($data[0]),
                        'precio' => isset($data[2]) ? floatval(str_replace(',', '.', $data[2])) : 0,
                        'stock'  => isset($data[3]) ? intval($data[3]) : 0,
                    ]
                );
                $count++;
            }
        }

        fclose($handle);

        return redirect()->route('products.index')->with('success', "¡Se importaron/actualizaron {$count} productos con éxito!");
    }

    public function storeSale(Request $request)
    {
        return redirect()->route('sales.index')->with('success', 'Venta realizada con éxito.');
    }
}