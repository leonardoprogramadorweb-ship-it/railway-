<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papelería - Punto de Venta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto space-y-6">
        
        <!-- Header / Navegación -->
        <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-gray-800">🛒 Punto de Venta - Papelería</h1>
            <a href="/" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Ver Inventario</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 p-4 rounded font-semibold text-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 p-4 rounded font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Lista de Productos Disponibles -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-1">
                <h2 class="text-lg font-bold mb-4 text-gray-700">Productos Disponibles</h2>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($products as $product)
                        <div class="border p-3 rounded flex justify-between items-center hover:bg-gray-50">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $product->nombre }}</p>
                                <p class="text-xs text-gray-500">Stock: {{ $product->stock }} | ${{ number_format($product->precio, 2) }}</p>
                            </div>
                            <button onclick="addToCart({{ $product->id }}, '{{ $product->nombre }}', {{ $product->precio }}, {{ $product->stock }})" 
                                    class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                + Agregar
                            </button>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">No hay productos con stock.</p>
                    @endforelse
                </div>
            </div>

            <!-- Carrito de Compras / Caja -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
                <h2 class="text-lg font-bold mb-4 text-gray-700">Carrito de Cobro</h2>

                <form action="{{ route('sales.store') }}" method="POST" id="sale-form">
                    @csrf
                    
                    <table class="w-full text-left border-collapse mb-4">
                        <thead>
                            <tr class="bg-gray-100 text-sm">
                                <th class="p-2 border">Producto</th>
                                <th class="p-2 border">Precio</th>
                                <th class="p-2 border w-24">Cantidad</th>
                                <th class="p-2 border">Subtotal</th>
                                <th class="p-2 border text-center">X</th>
                            </tr>
                        </thead>
                        <tbody id="cart-table">
                            <!-- Se llena dinámicamente con JS -->
                        </tbody>
                    </table>

                    <div class="border-t pt-4 space-y-3">
                        <div class="flex justify-between text-xl font-bold">
                            <span>TOTAL A PAGAR:</span>
                            <span class="text-green-600" id="total-display">$0.00</span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Paga con ($):</label>
                                <input type="number" step="0.01" name="pago_con" id="pago_con" required class="border p-2 rounded w-full text-lg" placeholder="0.00" oninput="calculateChange()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cambio:</label>
                                <div class="text-lg font-bold p-2 text-gray-700" id="cambio-display">$0.00</div>
                            </div>
                        </div>

                        <button type="submit" id="btn-cobrar" disabled class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 disabled:opacity-50 text-lg mt-4">
                            💵 Completar Venta
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        let cart = [];

        function addToCart(id, name, price, maxStock) {
            let item = cart.find(i => i.id === id);
            if (item) {
                if (item.quantity < maxStock) {
                    item.quantity++;
                } else {
                    alert('Límite de stock alcanzado para este producto.');
                }
            } else {
                cart.push({ id, name, price, quantity: 1, maxStock });
            }
            renderCart();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            renderCart();
        }

        function updateQuantity(index, qty) {
            qty = parseInt(qty);
            if (qty > cart[index].maxStock) {
                alert('La cantidad supera el stock disponible.');
                cart[index].quantity = cart[index].maxStock;
            } else if (qty > 0) {
                cart[index].quantity = qty;
            } else {
                cart.splice(index, 1);
            }
            renderCart();
        }

        function renderCart() {
            let tbody = document.getElementById('cart-table');
            tbody.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                let subtotal = item.price * item.quantity;
                total += subtotal;

                tbody.innerHTML += `
                    <tr class="border-b text-sm">
                        <td class="p-2">${item.name}
                            <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                        </td>
                        <td class="p-2">$${item.price.toFixed(2)}</td>
                        <td class="p-2">
                            <input type="number" name="items[${index}][cantidad]" value="${item.quantity}" min="1" max="${item.maxStock}" class="w-16 border rounded p-1 text-center" onchange="updateQuantity(${index}, this.value)">
                        </td>
                        <td class="p-2 font-semibold">$${subtotal.toFixed(2)}</td>
                        <td class="p-2 text-center">
                            <button type="button" onclick="removeFromCart(${index})" class="text-red-500 font-bold hover:underline">✕</button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById('total-display').innerText = `$${total.toFixed(2)}`;
            document.getElementById('btn-cobrar').disabled = cart.length === 0;
            calculateChange();
        }

        function calculateChange() {
            let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            let pago = parseFloat(document.getElementById('pago_con').value) || 0;
            let cambio = pago - total;
            document.getElementById('cambio-display').innerText = cambio >= 0 ? `$${cambio.toFixed(2)}` : '$0.00 (Insuficiente)';
        }
    </script>
</body>
</html>