<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Caja POS - Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        .pos-card {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
        }

        .pos-service-btn {
            background-color: #222222;
            border: 1px solid #333333;
            border-radius: 10px;
            color: #ffffff;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .pos-service-btn:hover {
            background-color: #2a2a2a;
            border-color: #f59e0b;
            color: #fbbf24;
            transform: translateY(-2px);
        }

        .pos-product-row {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .pos-product-row:hover {
            border-color: #f59e0b;
            background-color: #222222;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .pos-prod-img {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #333333;
            background-color: #222222;
        }

        .pos-search-wrapper, .pos-input-wrapper {
            position: relative;
            background-color: #161616;
            border: 1.5px solid #2a2a2a;
            border-radius: 10px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .pos-search-wrapper:focus-within, .pos-input-wrapper:focus-within {
            background-color: #1e1e1e;
            border-color: #f59e0b;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.12), inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .pos-search-icon, .pos-input-icon {
            color: #94a3b8;
            font-size: 1.1rem;
            transition: color 0.2s ease;
        }

        .pos-search-wrapper:focus-within .pos-search-icon, 
        .pos-input-wrapper:focus-within .pos-input-icon {
            color: #f59e0b;
        }

        .pos-search-input, .pos-dark-input {
            background-color: transparent !important;
            border: none !important;
            color: #ffffff !important;
            font-size: 0.925rem;
            font-weight: 500;
            box-shadow: none !important;
            padding-left: 0.5rem;
        }

        .pos-search-input::placeholder, .pos-dark-input::placeholder {
            color: #94a3b8 !important;
            font-weight: 400;
        }

        .pos-quick-cash {
            background-color: #222222;
            border: 1px solid #333333;
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.1s;
        }
        .pos-quick-cash:hover {
            background-color: #2a2a2a;
            border-color: #f59e0b;
            color: #fbbf24;
        }

        .payment-tab {
            background-color: #222222;
            border: 1px solid #333333;
            color: #94a3b8;
            font-size: 0.82rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            padding: 8px;
        }
        .payment-tab.active {
            background-color: rgba(245, 158, 11, 0.15);
            border-color: #f59e0b;
            color: #f59e0b;
        }

        .table {
            color: #ffffff;
        }
        .table-light {
            background-color: #222222 !important;
            color: #ffffff !important;
            border-color: #333333 !important;
        }
        .table-light th {
            background-color: #222222 !important;
            color: #ffffff !important;
            border-color: #333333 !important;
        }
        .table>:not(caption)>*>* {
            background-color: transparent;
            color: #ffffff;
            border-bottom-color: #2a2a2a;
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #121212; }
        ::-webkit-scrollbar-thumb { background: #333333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #f59e0b; }

        @media (max-width: 991.98px) {
            .pos-card {
                margin-bottom: 1rem;
            }
            #contenedorProductos {
                max-height: 40vh !important;
            }
        }

        /* Estructura optimizada para ticket térmico profesional */
        #ticketImpresion {
            display: none;
        }

        @media print {
            @page {
                size: 80mm auto;
                margin: 0mm;
            }

            html, body {
                width: 80mm;
                height: auto;
                background: #ffffff !important;
                color: #000000 !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            body * {
                visibility: hidden;
            }

            #ticketImpresion, #ticketImpresion * {
                visibility: visible;
            }

            #ticketImpresion {
                display: block !important;
                position: absolute;
                left: 0;
                top: 0;
                width: 76mm;
                font-family: 'Courier New', Courier, monospace;
                color: #000000;
                background: #ffffff;
                padding: 2mm;
                font-size: 11px;
                line-height: 1.2;
            }
        }
    </style>
</head>
<body class="p-2 p-md-4">

    <div class="container-fluid px-0" style="max-width: 1650px;">
        
        <!-- Barra superior de caja -->
        <div class="d-flex justify-content-between align-items-center mb-3 px-2">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-warning text-dark px-2.5 py-1.5 font-monospace rounded-pill shadow-xs fw-bold">CAJA #1</span>
                <span class="text-secondary d-none d-sm-inline">|</span>
                <span class="text-white small fw-semibold d-none d-sm-inline"><i class="bi bi-person-badge me-1"></i> Operador Activo</span>
            </div>
            <div>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="button" class="btn btn-outline-danger btn-sm px-3 py-1.5 rounded-pill d-flex align-items-center gap-1 shadow-xs" onclick="confirmarCierreSesion()">
                        <i class="bi bi-box-arrow-right"></i> <span class="d-none d-sm-inline">Cerrar Caja / </span>Salir
                    </button>
                </form>
            </div>
        </div>

        <div class="row g-3 g-md-4">
            
            <!-- Columna Izquierda: Servicios y Búsqueda -->
            <div class="col-lg-7 d-flex flex-column gap-3">
                
         

                <!-- Buscador e Inventario -->
                <div class="pos-card p-3 p-md-4 flex-grow-1 d-flex flex-column">
                    <div class="mb-3">
                        <div class="pos-search-wrapper px-3 py-2 d-flex align-items-center">
                            <i class="bi bi-search pos-search-icon me-2"></i>
                            <input type="text" id="inputCodigoBarras" class="form-control pos-search-input" placeholder="Escanear código o escribir nombre..." onkeydown="buscarPorCodigoEnter(event)" oninput="filtrarInventario()" autofocus>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                        <span class="text-white small fw-bold text-uppercase tracking-wider">Inventario Registrado</span>
                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2.5 py-1 rounded-pill">{{ count($products) }} productos</span>
                    </div>

                    <div class="d-flex flex-column gap-2 overflow-auto pe-1" style="max-height: 52vh; min-height: 250px;" id="contenedorProductos">
                        @foreach($products as $product)
                            @php
                                $esBajo = $product->stock <= 4;
                                $codigoProd = $product->codigo ?? $product->code ?? 'S/C';
                                $imagenProd = !empty($product->imagen) ? asset('storage/' . $product->imagen) : (!empty($product->image) ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=100&auto=format&fit=crop&q=80');
                            @endphp
                            <div class="pos-product-row p-2.5 d-flex align-items-center justify-content-between product-item" data-name="{{ strtolower($product->nombre ?? $product->name ?? '') }}" data-code="{{ strtolower($codigoProd) }}">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $imagenProd }}" alt="{{ $product->nombre ?? $product->name }}" class="pos-prod-img shadow-xs" onerror="this.src='https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=100&auto=format&fit=crop&q=80'">
                                    <div>
                                        <h6 class="text-white mb-1 fw-semibold" style="font-size: 0.9rem;">{{ $product->nombre ?? $product->name }}</h6>
                                        <span class="text-white-50" style="font-size: 0.78rem;">
                                            Código: <span class="text-info font-monospace">{{ $codigoProd }}</span> | 
                                            Existencias: <strong class="{{ $esBajo ? 'text-danger' : 'text-white' }}">{{ $product->stock }}</strong>
                                            <span class="mx-1">•</span>
                                            <span class="text-warning fw-bold">${{ number_format($product->precio ?? $product->price, 2) }}</span>
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-warning px-3 py-1.5 fw-medium rounded-pill shadow-xs" style="font-size: 0.78rem;"
                                        onclick="agregarAlCarrito({{ $product->id }}, '{{ addslashes($product->nombre ?? $product->name) }}', {{ $product->precio ?? $product->price }}, {{ $product->stock }}, '{{ $codigoProd }}', '{{ $imagenProd }}')">
                                    <i class="bi bi-plus-lg me-1"></i> Agregar
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Columna Derecha: Ticket y Cobro -->
            <div class="col-lg-5 d-flex flex-column">
                <div class="pos-card p-3 p-md-4 flex-grow-1 d-flex flex-column justify-content-between shadow-sm">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="fw-bold text-white small text-uppercase tracking-wider">
                                <i class="bi bi-receipt text-warning me-1"></i> Detalle de Ticket
                            </span>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-outline-danger btn-sm py-0.5 px-2 rounded-pill" style="font-size: 0.72rem;" onclick="limpiarCarrito()">Limpiar</button>
                                <span class="badge bg-dark text-white border border-secondary px-2.5 py-1 rounded-pill" id="contadorItemsBadge" style="font-size: 0.72rem;">0 ítems</span>
                            </div>
                        </div>

                        <!-- Tabla de Ticket -->
                        <div class="table-responsive mb-3" style="max-height: 24vh; min-height: 130px;">
                            <table class="table table-sm align-middle mb-0" style="font-size: 0.82rem;">
                                <thead class="table-light text-uppercase" style="font-size: 0.68rem;">
                                    <tr>
                                        <th style="width: 40%;">Artículo</th>
                                        <th style="width: 18%;">Precio</th>
                                        <th style="width: 26%;" class="text-center">Cant.</th>
                                        <th style="width: 12%;">Sub.</th>
                                        <th style="width: 4%;"></th>
                                    </tr>
                                </thead>
                                <tbody id="tablaCarritoBody">
                                    <tr>
                                        <td colspan="5" class="text-center text-white-50 py-4">No hay artículos capturados</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <!-- Pantalla Total -->
                        <div class="p-3 rounded-3 mb-3 border border-secondary border-opacity-25 d-flex justify-content-between align-items-center shadow-xs" style="background-color: #222222;">
                            <span class="text-white small fw-bold text-uppercase">TOTAL A PAGAR</span>
                            <h2 class="fw-bold text-warning mb-0">$<span id="totalGeneral">0.00</span></h2>
                        </div>

                        <!-- Selector de Método de Pago -->
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div id="tabEfectivo" class="payment-tab active" onclick="cambiarMetodoPago('Efectivo')">
                                    <i class="bi bi-cash me-1"></i> Efectivo
                                </div>
                            </div>
                            <div class="col-6">
                                <div id="tabTarjeta" class="payment-tab" onclick="cambiarMetodoPago('Tarjeta')">
                                    <i class="bi bi-credit-card me-1"></i> Tarjeta
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="paymentMethod" value="Efectivo">

                        <!-- Sección de Efectivo / Cambio -->
                        <div id="seccionEfectivo">
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <label class="form-label text-white small fw-bold mb-1">Efectivo Recibido</label>
                                    <div class="pos-input-wrapper px-2.5 py-1 d-flex align-items-center">
                                        <span class="text-warning fw-bold me-1">$</span>
                                        <input type="number" id="pagoCon" class="form-control pos-dark-input py-1" placeholder="0.00" oninput="calcularCambio()">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label text-white small fw-bold mb-1">Cambio</label>
                                    <div class="pos-input-wrapper px-2.5 py-1 d-flex align-items-center" style="background-color: #161616;">
                                        <span class="text-warning fw-bold me-1">$</span>
                                        <span id="cambioCalculado" class="text-warning fw-bold py-1 fs-6">0.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-1.5 mb-3">
                                <div class="col-3"><button type="button" class="btn pos-quick-cash w-100 py-1.5 shadow-xs" onclick="fijarPagoExacto()">Exacto</button></div>
                                <div class="col-3"><button type="button" class="btn pos-quick-cash w-100 py-1.5 shadow-xs" onclick="sumarEfectivo(100)">+$100</button></div>
                                <div class="col-3"><button type="button" class="btn pos-quick-cash w-100 py-1.5 shadow-xs" onclick="sumarEfectivo(200)">+$200</button></div>
                                <div class="col-3"><button type="button" class="btn pos-quick-cash w-100 py-1.5 shadow-xs" onclick="sumarEfectivo(500)">+$500</button></div>
                            </div>
                        </div>

                        <!-- Botón de cobro final -->
                        <button class="btn w-100 py-3 fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 rounded-3 text-uppercase tracking-wider text-dark" style="background-color: #f59e0b; font-size: 0.95rem;" onclick="procesarVenta()">
                            <i class="bi bi-cash-coin fs-5"></i> Cobrar y Finalizar Venta
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Estructura HTML del Ticket Profesional Pro para Impresora Térmica -->
    <div id="ticketImpresion">
        <div style="text-align: center; font-weight: bold; font-size: 13px;">PAPELERÍA / NEGOCIO</div>
        <div style="text-align: center; font-size: 10px;">RFC: XAXX010101000</div>
        <div style="text-align: center; font-size: 10px;">Av. Principal #123, Centro</div>
        <div style="text-align: center; font-size: 10px; margin-bottom: 4px;">Tel: 81 1234 5678</div>
        
        <div style="border-bottom: 1px dashed #000; margin-bottom: 4px;"></div>
        
        <div style="display: flex; justify-content: space-between; font-size: 10px;">
            <span>FOLIO: #<span id="ticketFolio">13</span></span>
            <span>Caja #1</span>
        </div>
        <div id="ticketFechaHora" style="font-size: 10px;"></div>
        <div style="font-size: 10px; margin-bottom: 4px;">Cajero: Operador Activo</div>
        
        <div style="border-bottom: 1px dashed #000; margin-bottom: 4px;"></div>
        
        <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 10px;">
            <span>CANT / DESCRIPCIÓN</span>
            <span>IMPORTE</span>
        </div>
        <div style="border-bottom: 1px dotted #000; margin-bottom: 4px;"></div>
        
        <div id="ticketItemsBody"></div>
        
        <div style="border-bottom: 1px dashed #000; margin: 4px 0;"></div>
        
        <div style="display: flex; justify-content: space-between; font-size: 10px;">
            <span>Total de artículos:</span>
            <span id="ticketTotalArticulos">0</span>
        </div>
        <div style="display: flex; justify-content: space-between; font-size: 11px;">
            <span>SUBTOTAL:</span>
            <span id="ticketSubtotal">$0.00</span>
        </div>
        <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 12px;">
            <span>TOTAL:</span>
            <span id="ticketTotal">$0.00</span>
        </div>
        
        <div style="margin-top: 4px; font-size: 10px;">
            <div style="display: flex; justify-content: space-between;">
                <span>MÉTODO PAGO:</span>
                <span id="ticketMetodoPago">Efectivo</span>
            </div>
            <div id="ticketBloqueEfectivo">
                <div style="display: flex; justify-content: space-between;">
                    <span>RECIBIDO:</span>
                    <span id="ticketRecibido">$0.00</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>CAMBIO:</span>
                    <span id="ticketCambio">$0.00</span>
                </div>
            </div>
        </div>
        
        <div style="border-bottom: 1px dashed #000; margin: 6px 0;"></div>
        
        <!-- Código QR Decorativo de Validación de Venta -->
        <div style="text-align: center; margin: 6px 0;">
            <div style="display: inline-block; border: 2px solid #000; padding: 4px; background: #fff;">
                <div style="font-family: monospace; font-size: 8px; line-height: 1; letter-spacing: 2px;">█▀▀▀█ █ ▀█ █▀▀▀█</div>
                <div style="font-family: monospace; font-size: 8px; line-height: 1; letter-spacing: 2px;">█ █ █ ▀▀█ █ █ █</div>
                <div style="font-family: monospace; font-size: 8px; line-height: 1; letter-spacing: 2px;">█▄▄▄█ █ █ █ █▄▄▄█</div>
            </div>
            <div style="font-size: 8px; margin-top: 2px;">Folio Digital Verificable</div>
        </div>

        <div style="text-align: center; font-weight: bold; margin-top: 6px; font-size: 11px;">¡GRACIAS POR SU COMPRA!</div>
        <div style="text-align: center; font-size: 9px;">Vuelva pronto</div>
    </div>

    <script>
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

        function emitirBeep(frecuencia = 1800, duracion = 0.08) {
            if (audioCtx.state === 'suspended') { audioCtx.resume(); }
            let now = audioCtx.currentTime;
            let osc = audioCtx.createOscillator();
            let gain = audioCtx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(frecuencia, now);
            gain.gain.setValueAtTime(0.15, now);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + duracion);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start(now);
            osc.stop(now + duracion);
        }

        function reproducirSonidoMecanico() {
            emitirBeep(1760, 0.06);
            setTimeout(() => { emitirBeep(2637, 0.08); }, 80);
        }

        function reproducirCampanaClasica() {
            emitirBeep(1318, 0.08);
            setTimeout(() => emitirBeep(1567, 0.08), 90);
            setTimeout(() => emitirBeep(2093, 0.18), 180);
        }

        let carrito = [];
        const productosDisponibles = [
            @foreach($products as $p)
                {
                    id: {{ $p->id }},
                    nombre: "{{ addslashes($p->nombre ?? $p->name) }}",
                    codigo: "{{ $p->codigo ?? $p->code ?? 'S/C' }}",
                    precio: {{ $p->precio ?? $p->price }},
                    stock: {{ $p->stock }},
                    imagen: "{{ !empty($p->imagen) ? asset('storage/' . $p->imagen) : (!empty($p->image) ? asset('storage/' . $p->image) : 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=100&auto=format&fit=crop&q=80') }}"
                },
            @endforeach
        ];

        function cambiarMetodoPago(metodo) {
            document.getElementById('paymentMethod').value = metodo;
            reproducirSonidoMecanico();
            
            let tabEfectivo = document.getElementById('tabEfectivo');
            let tabTarjeta = document.getElementById('tabTarjeta');
            let seccionEfectivo = document.getElementById('seccionEfectivo');

            if (metodo === 'Efectivo') {
                tabEfectivo.classList.add('active');
                tabTarjeta.classList.remove('active');
                seccionEfectivo.style.display = 'block';
            } else {
                tabTarjeta.classList.add('active');
                tabEfectivo.classList.remove('active');
                seccionEfectivo.style.display = 'none';
            }
        }

        function confirmarCierreSesion() {
            if (confirm('¿Cerrar sesión de caja?')) {
                document.getElementById('logoutForm').submit();
            }
        }

        function filtrarInventario() {
            let filtro = document.getElementById('inputCodigoBarras').value.toLowerCase().trim();
            let items = document.querySelectorAll('.product-item');

            items.forEach(item => {
                let nombre = item.getAttribute('data-name');
                let codigo = item.getAttribute('data-code');
                if (nombre.includes(filtro) || codigo.includes(filtro)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function buscarPorCodigoEnter(event) {
            if (event.key === 'Enter') {
                let codigoInput = document.getElementById('inputCodigoBarras').value.trim().toLowerCase();
                if (!codigoInput) return;
                let productoEncontrado = productosDisponibles.find(p => p.codigo.toLowerCase() === codigoInput || p.nombre.toLowerCase().includes(codigoInput));
                if (productoEncontrado) {
                    agregarAlCarrito(productoEncontrado.id, productoEncontrado.nombre, productoEncontrado.precio, productoEncontrado.stock, productoEncontrado.codigo, productoEncontrado.imagen);
                    document.getElementById('inputCodigoBarras').value = '';
                    filtrarInventario();
                } else {
                    alert('⚠️ Producto no encontrado');
                    document.getElementById('inputCodigoBarras').select();
                }
            }
        }

        function agregarAlCarrito(id, nombre, precio, stock, codigo, imagen) {
            let index = carrito.findIndex(item => item.id === id);
            if (index !== -1) {
                if (carrito[index].quantity < stock) {
                    carrito[index].quantity++;
                } else {
                    alert('⚠️ Stock máximo alcanzado');
                    return;
                }
            } else {
                if (stock > 0) {
                    carrito.push({ id, name: nombre, price: precio, quantity: 1, stock, code: codigo, imagen });
                } else {
                    alert('⚠️ Producto agotado');
                    return;
                }
            }
            reproducirSonidoMecanico();
            actualizarTabla();
            document.getElementById('inputCodigoBarras').focus();
        }

        function actualizarTabla() {
            let tbody = document.getElementById('tablaCarritoBody');
            tbody.innerHTML = '';
            let total = 0;
            let totalItems = 0;

            if (carrito.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-white-50 py-4">No hay artículos capturados</td></tr>`;
            }

            carrito.forEach((item, index) => {
                let subtotal = item.price * item.quantity;
                total += subtotal;
                totalItems += item.quantity;
                tbody.innerHTML += `
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="${item.imagen}" class="rounded border border-secondary flex-shrink-0" style="width: 28px; height: 28px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=100&auto=format&fit=crop&q=80'">
                                <span class="text-truncate text-white fw-medium" style="max-width: 100px;" title="${item.name}">${item.name}</span>
                            </div>
                        </td>
                        <td class="text-white-50">$${item.price.toFixed(2)}</td>
                        <td class="text-center">
                            <div class="input-group input-group-sm justify-content-center" style="width: 72px; margin: 0 auto;">
                                <button class="btn btn-outline-secondary px-1 py-0 text-white" onclick="cambiarCantidad(${index}, -1)">-</button>
                                <span class="text-white px-1 d-flex align-items-center justify-content-center fw-bold border-top border-bottom border-secondary" style="width: 22px; background-color: #222222;">${item.quantity}</span>
                                <button class="btn btn-outline-secondary px-1 py-0 text-white" onclick="cambiarCantidad(${index}, 1)">+</button>
                            </div>
                        </td>
                        <td class="fw-bold text-warning">$${subtotal.toFixed(2)}</td>
                        <td class="text-end">
                            <button class="btn btn-link text-danger p-0 lh-1" onclick="eliminarItem(${index})" title="Eliminar"><i class="bi bi-x-lg"></i></button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById('totalGeneral').innerText = total.toFixed(2);
            document.getElementById('contadorItemsBadge').innerText = totalItems + (totalItems === 1 ? ' ítem' : ' ítems');
            calcularCambio();
        }

        function cambiarCantidad(index, delta) {
            let nuevoVal = carrito[index].quantity + delta;
            if (nuevoVal > 0 && nuevoVal <= carrito[index].stock) {
                carrito[index].quantity = nuevoVal;
                reproducirSonidoMecanico();
                actualizarTabla();
            }
        }

        function eliminarItem(index) {
            carrito.splice(index, 1);
            reproducirSonidoMecanico();
            actualizarTabla();
        }

        function limpiarCarrito() {
            carrito = [];
            reproducirSonidoMecanico();
            actualizarTabla();
        }

        function fijarPagoExacto() {
            let total = carrito.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            document.getElementById('pagoCon').value = total.toFixed(2);
            reproducirSonidoMecanico();
            calcularCambio();
        }

        function sumarEfectivo(monto) {
            let actual = parseFloat(document.getElementById('pagoCon').value) || 0;
            document.getElementById('pagoCon').value = (actual + monto).toFixed(2);
            reproducirSonidoMecanico();
            calcularCambio();
        }

        function calcularCambio() {
            let total = carrito.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            let pagoCon = parseFloat(document.getElementById('pagoCon').value) || 0;
            let cambio = pagoCon - total;
            document.getElementById('cambioCalculado').innerText = cambio >= 0 ? cambio.toFixed(2) : '0.00';
        }

        function imprimirTicket(total, pago_con, cambio, metodo) {
            const ahora = new Date();
            const opcionesFecha = { month: 'numeric', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', second: '2-digit', hour12: true };
            document.getElementById('ticketFechaHora').innerText = ahora.toLocaleString('es-MX', opcionesFecha);
            document.getElementById('ticketFolio').innerText = Math.floor(1000 + Math.random() * 9000);

            let htmlItems = '';
            let totalArticulos = 0;

            carrito.forEach(item => {
                let subtotal = item.price * item.quantity;
                totalArticulos += item.quantity;
                htmlItems += `
                    <div style="font-size: 10px; margin-bottom: 2px;">
                        <div style="font-weight: bold;">${item.name}</div>
                        <div style="display: flex; justify-content: space-between; color: #333;">
                            <span>[${item.code}] ${item.quantity} x $${item.price.toFixed(2)} c/u</span>
                            <span style="font-weight: bold;">$${subtotal.toFixed(2)}</span>
                        </div>
                    </div>
                `;
            });
            document.getElementById('ticketItemsBody').innerHTML = htmlItems;
            document.getElementById('ticketTotalArticulos').innerText = totalArticulos;

            document.getElementById('ticketSubtotal').innerText = '$' + total.toFixed(2);
            document.getElementById('ticketTotal').innerText = '$' + total.toFixed(2);
            document.getElementById('ticketMetodoPago').innerText = metodo;

            let bloqueEfectivo = document.getElementById('ticketBloqueEfectivo');
            if (metodo === 'Efectivo') {
                bloqueEfectivo.style.display = 'block';
                document.getElementById('ticketRecibido').innerText = '$' + pago_con.toFixed(2);
                document.getElementById('ticketCambio').innerText = '$' + cambio.toFixed(2);
            } else {
                bloqueEfectivo.style.display = 'none';
            }

            window.print();
        }

        function procesarVenta() {
            if (carrito.length === 0) {
                alert('⚠️ La venta no tiene artículos');
                return;
            }
            let total = carrito.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            let payment_method = document.getElementById('paymentMethod').value;
            
            let pago_con = total;
            let cambio = 0;

            if (payment_method === 'Efectivo') {
                pago_con = parseFloat(document.getElementById('pagoCon').value) || total;
                cambio = pago_con - total;

                if (pago_con < total) {
                    alert('⚠️ El efectivo recibido es menor al total de la venta.');
                    return;
                }
            }

            fetch('/sales', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ items: carrito, total: total, pago_con: pago_con, cambio: cambio, payment_method: payment_method })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    reproducirCampanaClasica();
                    
                    imprimirTicket(total, pago_con, cambio, payment_method);

                    window.onafterprint = () => {
                        location.reload();
                    };
                    
                    setTimeout(() => {
                        location.reload();
                    }, 3000);

                } else {
                    alert('❌ ' + data.message);
                }
            })
            .catch(err => alert('❌ Error al conectar con el servidor.'));
        }

        actualizarTabla();
    </script>
</body>
</html>