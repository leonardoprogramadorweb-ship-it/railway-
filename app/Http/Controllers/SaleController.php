<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    // Muestra la pantalla del Punto de Venta
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        $sales = Sale::with('details.product')->latest()->take(10)->get();
        return view('sales.index', compact('products', 'sales'));
    }

    // Registra la venta y descuenta el stock
    public function store(Request $request)
    {
        $request->validate([
            'pago_con' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;
            $itemsToSave = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['cantidad']) {
                    return redirect()->back()->with('error', "Stock insuficiente para: {$product->nombre}");
                }

                $subtotal = $product->precio * $item['cantidad'];
                $total += $subtotal;

                // Descontar stock
                $product->decrement('stock', $item['cantidad']);

                $itemsToSave[] = [
                    'product_id' => $product->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $product->precio,
                    'subtotal' => $subtotal,
                ];
            }

            if ($request->pago_con < $total) {
                return redirect()->back()->with('error', 'El dinero entregado es menor al total de la venta.');
            }

            $cambio = $request->pago_con - $total;

            // Registrar Venta Principal
            $sale = Sale::create([
                'total' => $total,
                'pago_con' => $request->pago_con,
                'cambio' => $cambio,
                'metodo_pago' => $request->metodo_pago ?? 'efectivo',
            ]);

            // Registrar Detalles
            foreach ($itemsToSave as $detail) {
                $sale->details()->create($detail);
            }

            DB::commit();

            return redirect()->back()->with('success', "¡Venta completada! Cambio a entregar: $" . number_format($cambio, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al procesar la venta.');
        }
    }
}