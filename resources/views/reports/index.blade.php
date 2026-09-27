<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas Corporativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #1c1917; /* stone-900 */
            --bg-panel: #0c0a09; /* stone-950 */
            --bg-card: #141210;
            --border-subtle: #292524; /* stone-800 */
            --primary-accent: #f59e0b; /* amber-500 */
            --primary-hover: #fbbf24; /* amber-400 */
            --text-main: #f5f5f4;
            --text-muted: #a8a29e;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #f5f5f4;
            margin: 0;
            padding: 1rem;
            min-height: 100vh;
            box-sizing: border-box;
        }

        @media (min-width: 640px) {
            body {
                padding: 1.5rem;
            }
        }

        .container {
            max-width: 72rem;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        header {
            background-color: var(--bg-panel);
            padding: 1.5rem;
            border-radius: 1.25rem;
            border: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
        }

        @media (min-width: 768px) {
            header {
                padding: 2rem;
                align-items: center;
                border-radius: 1.5rem;
            }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            background-color: rgba(245, 158, 11, 0.1);
            color: #fbbf24;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0.25rem 0;
            color: #ffffff;
        }

        @media (min-width: 768px) {
            h1 {
                font-size: 1.875rem;
            }
        }

        p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        nav {
            display: flex;
            gap: 0.5rem;
            background-color: var(--bg-body);
            padding: 0.35rem;
            border-radius: 1rem;
            border: 1px solid var(--border-subtle);
            width: 100%;
            justify-content: space-around;
        }

        @media (min-width: 640px) {
            nav {
                width: auto;
                justify-content: flex-start;
                padding: 0.5rem;
            }
        }

        nav a {
            color: #d6d3d1;
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 0.75rem;
            font-size: 0.813rem;
            font-weight: 500;
            transition: all 0.2s;
            text-align: center;
        }

        @media (min-width: 640px) {
            nav a {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }

        nav a:hover {
            color: #ffffff;
            background-color: var(--border-subtle);
        }

        .grid-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .grid-section {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            .col-span-2 {
                grid-column: span 2 / span 2;
            }
        }

        .card {
            background-color: var(--bg-panel);
            padding: 1.25rem;
            border-radius: 1.25rem;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        @media (min-width: 768px) {
            .card {
                padding: 1.5rem;
                border-radius: 1.5rem;
            }
        }

        form.card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        @media (min-width: 640px) {
            form.card {
                flex-direction: row;
                align-items: flex-end;
                gap: 1.25rem;
            }
        }

        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        input[type="date"] {
            width: 100%;
            background-color: var(--bg-body);
            border: 1px solid var(--border-subtle);
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            color: #e7e5e4;
            font-weight: 500;
            font-family: inherit;
            outline: none;
            box-sizing: border-box;
            font-size: 0.875rem;
        }

        input[type="date"]:focus {
            border-color: var(--primary-accent);
        }

        button[type="submit"] {
            background-color: var(--primary-accent);
            color: #0c0a09;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
            width: 100%;
        }

        @media (min-width: 640px) {
            button[type="submit"] {
                width: auto;
            }
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
        }

        .summary-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .summary-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffffff;
            margin-top: 0.5rem;
        }

        @media (min-width: 768px) {
            .summary-value {
                font-size: 1.875rem;
            }
        }

        .summary-footer {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            min-width: 600px;
        }

        th {
            background-color: rgba(41, 37, 36, 0.5);
            border-bottom: 1px solid var(--border-subtle);
            color: var(--text-muted);
            padding: 0.875rem 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        @media (min-width: 768px) {
            th {
                padding: 1rem 1.5rem;
            }
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #1c1917;
            font-size: 0.813rem;
        }

        @media (min-width: 768px) {
            td {
                padding: 1.25rem 1.5rem;
                font-size: 0.875rem;
            }
        }

        tr:hover td {
            background-color: rgba(41, 37, 36, 0.2);
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
        }

        @media (min-width: 768px) {
            .empty-state {
                padding: 4rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- Encabezado Principal -->
        <header>
            <div>
                <div class="badge">Módulo Administrativo</div>
                <h1>Reporte de Ventas</h1>
                <p>Control analítico y auditoría de transacciones diarias.</p>
            </div>
            <nav>
                <a href="{{ route('products.index') }}"><span style="color: var(--primary-accent);">▪</span> Inventario</a>
                <a href="{{ route('sales.index') }}"><span style="color: var(--primary-accent);">▪</span> Punto de Venta</a>
            </nav>
        </header>

        <!-- Filtros y Tarjeta de Resumen Ejecutivo -->
        <section class="grid-section">
            
            <!-- Formulario de Selección -->
            <form method="GET" action="{{ route('reports.index') }}" class="card col-span-2">
                <div style="flex: 1; width: 100%;">
                    <label for="date">Fecha de Consulta</label>
                    <input type="date" id="date" name="date" value="{{ \Carbon\Carbon::parse($selectedDate)->format('Y-m-d') }}">
                </div>
                <button type="submit">Actualizar Reporte</button>
            </form>

            <!-- Card Resumen Ejecutivo -->
            <div class="card summary-card">
                <div>
                    <p style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Volumen Consolidado</p>
                    <div class="summary-value">${{ number_format($totalSales, 2) }}</div>
                </div>
                <div class="summary-footer">
                    <span>Fecha Analizada:</span>
                    <strong style="color: #e7e5e4;">{{ $selectedDate }}</strong>
                </div>
            </div>
        </section>

        <!-- Tabla Historial Corporativo -->
        <section class="card" style="padding: 0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h2 style="font-size: 1.125rem; font-weight: bold; color: #fff; margin: 0;">Registro de Folios</h2>
                    <p style="margin-top: 0.25rem;">Detalle exhaustivo de transacciones correspondientes al periodo.</p>
                </div>
                
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="font-size: 0.75rem; background: var(--bg-body); border: 1px solid var(--border-subtle); padding: 0.35rem 0.85rem; border-radius: 9999px;">
                        Total Registros: <strong style="color: #fff;">{{ $sales->count() }}</strong>
                    </div>

                    <!-- BOTÓN DE ELIMINACIÓN MASIVA POR FECHA -->
                    @if($sales->isNotEmpty())
                        <form action="{{ route('reports.destroyByDate') }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar todos los reportes de esta fecha?');" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="date" value="{{ $selectedDate }}">
                            <button type="submit" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.4rem 0.85rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; cursor: pointer; transition: background 0.2s;">
                                Eliminar Todos de este Día
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            
            @if($sales->isEmpty())
                <div class="empty-state">
                    <p style="color: #e7e5e4; font-weight: 500; margin-bottom: 0.5rem;">No se registran movimientos</p>
                    <p style="font-size: 0.75rem; color: #78716c; max-width: 20rem; margin: 0 auto;">No existen transacciones guardadas para la fecha seleccionada. Por favor, verifique el calendario.</p>
                </div>
            @else
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Folio ID</th>
                                <th>Marca Temporal</th>
                                <th>Desglose de Artículos</th>
                                <th style="text-align: right;">Importe Neto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales->sortBy('id', SORT_REGULAR, false) as $sale)
                                <tr>
                                    <td style="font-family: monospace; font-weight: bold; color: var(--primary-accent); white-space: nowrap;">
                                        #{{ $sale->id }}
                                    </td>
                                    <td style="color: var(--text-muted); white-space: nowrap;">
                                        {{ $sale->created_at->format('H:i A') }}
                                    </td>
                                    <td>
                                        <div style="display: flex; flex-direction: column; gap: 0.5rem; min-width: 220px; max-width: 40rem;">
                                            @foreach($sale->details as $detail)
                                                <div style="display: flex; justify-content: space-between; gap: 1rem; font-size: 0.75rem; background: rgba(12, 10, 9, 0.7); border: 1px solid rgba(41, 37, 36, 0.6); padding: 0.5rem 0.75rem; border-radius: 0.75rem;">
                                                    <span style="color: #d6d3d1;">
                                                        {{ $detail->product->nombre ?? $detail->product->name ?? 'Producto no disponible' }}
                                                    </span>
                                                    <span style="color: var(--text-muted); font-family: monospace; white-space: nowrap;">
                                                        {{ $detail->cantidad }} u. × <strong style="color: #e7e5e4;">${{ number_format($detail->precio_unitario, 2) }}</strong>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td style="text-align: right; font-weight: 800; color: #fff; font-family: monospace; font-size: 0.95rem; white-space: nowrap;">
                                        ${{ number_format($sale->total, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

    </div>

</body>
</html>