<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papelería - Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <!-- Encabezado con Botones de Navegación -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Sistema de Papelería - Inventario</h1>
            <div class="space-x-2">
                <a href="{{ route('sales.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700">
                    🛒 Punto de Venta
                </a>
                <a href="{{ route('reports.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-purple-700">
                    📊 Ver Reportes
                </a>
            </div>
        </div>

        <!-- Formulario para Agregar Producto -->
        <form action="{{ route('products.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <input type="text" name="nombre" placeholder="Nombre (ej. Cuaderno Scribe)" required class="border p-2 rounded w-full">
                <input type="text" name="codigo" placeholder="Código de barras" class="border p-2 rounded w-full">
                <input type="number" step="0.01" name="precio" placeholder="Precio ($)" required class="border p-2 rounded w-full">
                <input type="number" name="stock" placeholder="Stock" required class="border p-2 rounded w-full">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold w-full hover:bg-blue-700">
                + Guardar Producto
            </button>
        </form>

        <!-- Tabla de Inventario -->
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3">Nombre</th>
                    <th class="p-3">Código</th>
                    <th class="p-3">Precio</th>
                    <th class="p-3">Stock</th>
                    <th class="p-3 text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-semibold">{{ $product->nombre }}</td>
                        <td class="p-3 text-gray-600 font-mono">{{ $product->codigo ?? 'N/A' }}</td>
                        <td class="p-3 font-bold text-green-600">${{ number_format($product->precio, 2) }}</td>
                        <td class="p-3">{{ $product->stock }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Eliminar producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-bold hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-400 italic">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
