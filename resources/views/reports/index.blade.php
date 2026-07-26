<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        
        <!-- Enlaces de navegación -->
        <div class="flex justify-between items-center mb-6">
            <div class="space-x-2">
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">📦 Inventario</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('sales.index') }}" class="text-blue-600 hover:underline">🛒 Punto de Venta</a>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">📊 Reporte de Ventas</h1>
        </div>

        <!-- Filtro por Fecha y Card Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <form method="GET" action="{{ route('reports.index') }}" class="flex items-center space-x-3 bg-gray-50 p-4 rounded-lg border">
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">SELECCIONAR FECHA</label>
                    <input type="date" name="date" value="{{ $selectedDate }}" class="border p-2 rounded-lg text-gray-700">
                </div>
                <button type="submit" class="mt-5 bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700">
                    Buscar
                </button>
            </form>

            <div class="bg-green-50 border border-green-200 p-4 rounded-lg flex justify-between items-center">
                <div>
                    <p class="text-xs font-bold text-green-700 uppercase">Total Vendido ({{ $selectedDate }})</p>
                    <p class="text-3xl font-extrabold text-green-800">${{ number_format($totalSales, 2) }}</p>
                </div>
                <span class="text-4xl">💰</span>
            </div>
        </div>

        <!-- Tabla de Ventas -->
        <h2 class="text-lg font-bold text-gray-700 mb-3">Historial de Folios</h2>
        
        @if($sales->isEmpty())
            <div class="p-4 bg-yellow-50 text-yellow-800 rounded-lg text-center font-medium border border-yellow-200">
                No hay ventas registradas para la fecha seleccionada.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-3 border">Folio</th>
                            <th class="p-3 border">Hora</th>
                            <th class="p-3 border">Productos Vendidos</th>
                            <th class="p-3 border text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border font-semibold">#{{ $sale->id }}</td>
                                <td class="p-3 border text-gray-600">{{ $sale->created_at->format('H:i A') }}</td>
                                <td class="p-3 border">
                                    <ul class="list-disc list-inside text-sm text-gray-700">
                                        @foreach($sale->details as $detail)
                                            <li>
                                                {{ $detail->product ? $detail->product->name : 'Producto borrado' }} 
                                                <span class="text-gray-500">({{ $detail->quantity }} x ${{ number_format($detail->price, 2) }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-3 border text-right font-bold text-green-600">
                                    ${{ number_format($sale->total, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

</body>
</html>