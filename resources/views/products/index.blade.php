<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema | Inventario General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-body: #0c0a09;
            --bg-panel: #141210;
            --bg-card: #1c1917;
            --bg-table: #0f0d0c;
            --bg-input: #0c0a09;
            --border-subtle: #292524;
            --border-hover: #f59e0b;
            --primary-accent: #f59e0b;
            --primary-hover: #fbbf24;
            --gold-glow: rgba(245, 158, 11, 0.25);
            --text-main: #f5f5f4;
            --text-muted: #e5e7eb; 
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .text-muted, 
        .table .text-muted, 
        .table td p {
            color: var(--text-muted) !important;
        }

        .main-container {
            background: var(--bg-panel);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
        }

        .form-control, .form-select {
            background-color: var(--bg-input) !important;
            border-color: var(--border-subtle) !important;
            color: var(--text-main) !important;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px var(--gold-glow);
            border-color: var(--border-hover) !important;
        }
        .form-control::placeholder {
            color: var(--text-muted);
            opacity: 0.8;
        }

        .custom-file-upload {
            position: relative;
            background-color: var(--bg-input);
            border: 1px solid var(--border-subtle);
            border-radius: 8px;
            padding: 0.4rem 0.6rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .custom-file-upload:hover {
            border-color: var(--border-hover);
            box-shadow: 0 0 8px var(--gold-glow);
        }
        .custom-file-upload input[type="file"] {
            display: none;
        }
        .file-upload-btn {
            background: linear-gradient(135deg, #262220 0%, #1c1917 100%);
            color: #f59e0b;
            border: 1px solid var(--border-subtle);
            padding: 0.35rem 0.8rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .custom-file-upload:hover .file-upload-btn {
            background: linear-gradient(135deg, #2d2623 0%, #262220 100%);
            border-color: var(--border-hover);
            color: #fbbf24;
        }
        .file-upload-name {
            font-size: 0.85rem;
            color: var(--text-muted);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .search-box-wrapper {
            background: linear-gradient(135deg, #1c1917 0%, #141210 100%);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.04);
            overflow: hidden;
            transition: all 0.25s ease;
        }
        .search-box-wrapper:focus-within {
            border-color: var(--border-hover);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6), 0 0 14px var(--gold-glow), inset 0 1px 0 rgba(255, 255, 255, 0.08);
            transform: translateY(-1px);
        }
        .search-box-wrapper .input-group-text {
            background: transparent !important;
            border: none !important;
            color: var(--text-muted);
            padding-left: 1.1rem;
            transition: color 0.2s ease;
        }
        .search-box-wrapper:focus-within .input-group-text {
            color: var(--primary-accent);
        }
        .search-box-wrapper input.form-control {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            color: var(--text-main) !important;
            padding: 0.75rem 1rem 0.75rem 0.5rem;
            font-size: 0.95rem;
        }

        .btn-custom-primary {
            background-color: var(--primary-accent);
            color: #0c0a09;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            padding: 0.6rem 1.2rem;
            transition: all 0.2s ease;
        }
        .btn-custom-primary:hover {
            background-color: var(--primary-hover);
            color: #0c0a09;
            transform: translateY(-1px);
        }

        .btn-glass-action {
            background: linear-gradient(135deg, #1c1917 0%, #141210 100%);
            color: var(--text-main);
            border: 1px solid var(--border-subtle);
            border-radius: 10px;
            font-weight: 600;
            padding: 0.55rem 1.1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            transition: all 0.2s ease;
        }
        .btn-glass-action:hover {
            background: linear-gradient(135deg, #262220 0%, #1c1917 100%);
            border-color: var(--border-hover);
            color: var(--primary-accent);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.6), 0 0 12px var(--gold-glow), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .table-shadow-container {
            background: var(--bg-table);
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            box-shadow: 0 14px 35px 0 rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(245, 158, 11, 0.1);
            overflow: hidden;
        }

        .table {
            color: var(--text-main);
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            background-color: transparent !important;
        }
        .table-custom-header {
            background-color: #0a0807 !important;
            color: #f59e0b !important;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
            border-bottom: 2px solid var(--border-subtle) !important;
        }
        .table tbody tr {
            background-color: var(--bg-table);
            transition: background-color 0.15s ease;
        }
        .table tbody tr:hover {
            background-color: #1a1614;
        }
        .table td, .table th {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-subtle) !important;
            background-color: transparent !important;
            color: var(--text-main);
        }

        .product-img-wrapper {
            position: relative;
            width: 45px;
            height: 45px;
            border-radius: 8px;
            overflow: hidden;
            background: var(--bg-input);
            border: 1px solid var(--border-subtle);
        }
        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-content {
            background-color: var(--bg-panel);
            border: 1px solid var(--border-subtle);
            color: var(--text-main);
            border-radius: 14px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.8);
        }
        .modal-header, .modal-footer {
            border-color: var(--border-subtle);
        }
        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .alert-custom {
            border-radius: 10px;
            border: 1px solid transparent;
        }
        .alert-success-custom {
            background-color: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            border-color: rgba(34, 197, 94, 0.3);
        }
        .alert-danger-custom {
            background-color: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .card-form-section {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .badge-stock-low {
            background-color: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .badge-stock-normal {
            background-color: var(--bg-input);
            color: var(--text-main);
            border: 1px solid var(--border-subtle);
        }

        @media (max-width: 991.98px) {
            .desktop-table-view {
                display: none !important;
            }
            .mobile-card-view {
                display: block !important;
            }
        }
        @media (min-width: 992px) {
            .desktop-table-view {
                display: block !important;
            }
            .mobile-card-view {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 0.5rem !important;
            }
            .main-container {
                padding: 1rem !important;
                border-radius: 12px;
            }
            .display-6 {
                font-size: 1.35rem;
            }
            .btn-glass-action, .btn-custom-primary {
                font-size: 0.85rem;
                padding: 0.5rem 0.8rem;
            }
        }
    </style>
</head>
<body class="py-2 py-md-4 py-lg-5 px-2 px-md-3">

    <div class="container-fluid px-0" style="max-width: 1400px;">
        <div class="main-container p-3 p-md-4 p-lg-5">
            
            <!-- Cabecera Responsiva -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-4 border-bottom border-secondary border-opacity-25 gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge border border-warning border-opacity-50 px-3 py-1.5 rounded-pill font-mono small" style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; letter-spacing: 0.05em;">
                            MÓDULO ADMINISTRATIVO
                        </span>
                    </div>
                    <h1 class="fw-bold m-0 text-light tracking-tight display-6">Inventario de Productos</h1>
                    <p class="text-muted small mt-1 mb-0">Control analítico y gestión general de artículos en existencia.</p>
                </div>
                
                <div class="d-flex align-items-center gap-2 flex-wrap p-2 rounded-3 border border-secondary border-opacity-25 w-100 w-md-auto justify-content-start justify-content-md-end" style="background-color: var(--bg-card);">
                    @can('admin-only')
                        <form id="importForm" action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="d-none">
                            @csrf
                            <input type="file" id="fileInput" name="file" accept=".csv, .txt, .xlsx, .xls" onchange="document.getElementById('importForm').submit()">
                        </form>
                        <button type="button" class="btn btn-sm btn-glass-action d-inline-flex align-items-center gap-2 shadow-sm border-0 flex-fill flex-md-grow-0 justify-content-center" onclick="document.getElementById('fileInput').click()">
                            <span class="rounded-circle" style="width: 6px; height: 6px; background-color: #f59e0b;"></span> Importar
                        </button>
                    @endcan

                    <a href="{{ route('sales.index') }}" class="btn btn-sm btn-glass-action d-inline-flex align-items-center gap-2 shadow-sm border-0 flex-fill flex-md-grow-0 justify-content-center">
                        <span class="rounded-circle" style="width: 6px; height: 6px; background-color: #ef4444;"></span> Venta
                    </a>

                    @can('admin-only')
                        <a href="{{ route('reports.index') }}" class="btn btn-sm btn-glass-action d-inline-flex align-items-center gap-2 shadow-sm border-0 flex-fill flex-md-grow-0 justify-content-center">
                            <span class="rounded-circle" style="width: 6px; height: 6px; background-color: #22c55e;"></span> Reportes
                        </a>
                    @endcan

                    <form action="{{ route('logout') }}" method="POST" class="d-inline flex-fill flex-md-grow-0 m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-glass-action d-inline-flex align-items-center gap-2 shadow-sm border-0 w-100 justify-content-center text-danger" title="Cerrar sesión">
                            <i class="bi bi-box-arrow-right" style="color: #ef4444;"></i> Salir
                        </button>
                    </form>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger-custom alert-custom mb-4 p-3 p-md-4 shadow-sm" role="alert">
                    <div class="fw-bold mb-2 d-flex align-items-center gap-2 fs-6">
                        <i class="bi bi-exclamation-octagon-fill fs-5"></i> Se encontraron errores:
                    </div>
                    <ul class="mb-0 ps-3 small" style="color: #f87171;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success-custom alert-custom mb-4 p-3 p-md-4 shadow-sm d-flex align-items-center gap-3" role="alert">
                    <i class="bi bi-check-circle-fill fs-4" style="color: #4ade80;"></i>
                    <div class="fw-medium text-light">{{ session('success') }}</div>
                </div>
            @endif

            <!-- Formulario de Registro Adaptable -->
            @can('admin-only')
                <div class="card-form-section p-3 p-md-4 mb-4 shadow-sm">
                    <h6 class="fw-bold mb-3 text-light d-flex align-items-center gap-2 fs-5">
                        <div class="p-2 rounded-3 border border-warning border-opacity-50 d-inline-flex" style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        Registrar Nuevo Producto
                    </h6>
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 col-md-6 col-lg-3">
                                <label class="form-label text-muted small fw-semibold">Nombre del producto</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej. Artículo" required>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label class="form-label text-muted small fw-semibold">Código de barras</label>
                                <input type="text" name="codigo_barras" class="form-control font-mono" placeholder="Escanee o escriba">
                            </div>
                            <div class="col-12 col-md-4 col-lg-2">
                                <label class="form-label text-muted small fw-semibold">Precio ($)</label>
                                <input type="number" step="0.01" name="precio" class="form-control font-mono fw-bold" style="color: #f59e0b !important;" placeholder="0.00" required>
                            </div>
                            <div class="col-12 col-md-4 col-lg-2">
                                <label class="form-label text-muted small fw-semibold">Stock inicial</label>
                                <input type="number" name="stock" class="form-control font-mono" placeholder="0" required>
                            </div>
                            <div class="col-12 col-md-4 col-lg-2">
                                <label class="form-label text-muted small fw-semibold">Imagen</label>
                                <label class="custom-file-upload w-100">
                                    <span class="file-upload-btn"><i class="bi bi-folder2-open"></i> Subir</span>
                                    <span class="file-upload-name">Ningún archivo</span>
                                    <input type="file" name="imagen" accept="image/*" onchange="updateFileName(this)">
                                </label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-custom-primary w-100 py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-cloud-arrow-up-fill fs-5"></i> Guardar Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endcan

            <!-- Barra de Búsqueda Responsiva -->
            <div class="row mb-4">
                <div class="col-12 col-md-6 col-lg-5 ms-auto">
                    <div class="input-group search-box-wrapper">
                        <span class="input-group-text">
                            <i class="bi bi-search fs-6"></i>
                        </span>
                        <input type="text" id="searchTableInput" class="form-control" placeholder="Filtrar por nombre o código..." onkeyup="filterInventory()">
                    </div>
                </div>
            </div>

            <!-- CONTENEDOR ESCRITORIO: Tabla tradicional -->
            <div class="table-shadow-container mb-4 desktop-table-view">
                <div class="table-responsive">
                    <table class="table align-middle" id="inventoryTable">
                        <thead>
                            <tr class="table-custom-header">
                                <th class="py-3 px-4" style="width: 80px;">Imagen</th>
                                <th class="py-3">Producto</th>
                                <th class="py-3">Código</th>
                                <th class="py-3">Precio</th>
                                <th class="py-3">Stock</th>
                                <th class="py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="product-row" data-name="{{ strtolower($product->nombre ?? $product->name) }}" data-code="{{ strtolower($product->codigo_barras ?? $product->code ?? '') }}">
                                    <td class="align-middle px-4 py-3">
                                        @php $img = $product->imagen ?? $product->image; @endphp
                                        <div class="product-img-wrapper shadow-sm">
                                            @if($img)
                                                <img src="{{ asset('storage/' . $img) }}" alt="Prod">
                                            @else
                                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted" style="background-color: var(--bg-input);">
                                                    <i class="bi bi-image opacity-50" style="font-size: 16px;"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="fw-bold text-light fs-6">
                                        {{ $product->nombre ?? $product->name }}
                                    </td>
                                    <td class="font-mono small">
                                        <span class="badge border border-secondary border-opacity-50 px-2 py-1 text-light font-mono" style="background-color: var(--bg-input);">
                                            {{ $product->codigo_barras ?? $product->code ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="fw-bold font-mono fs-6" style="color: #f59e0b;">
                                        ${{ number_format($product->precio ?? $product->price, 2) }}
                                    </td>
                                    <td>
                                        <span class="badge {{ $product->stock <= 3 ? 'badge-stock-low' : 'badge-stock-normal' }} px-3 py-1.5 rounded-pill fw-semibold font-mono">
                                            {{ $product->stock }} disp.
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @can('admin-only')
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-sm btn-glass-action px-2.5 py-1.5 rounded-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}" title="Editar">
                                                    <i class="bi bi-pencil-square" style="color: #f59e0b;"></i>
                                                </button>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-glass-action px-2.5 py-1.5 rounded-2 shadow-sm" onclick="return confirm('¿Eliminar producto?')" title="Eliminar">
                                                        <i class="bi bi-trash3" style="color: #ef4444;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="badge border border-secondary border-opacity-25 px-2.5 py-1.5 text-muted" style="background-color: var(--bg-input);">Lectura</span>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <div class="py-4">
                                            <i class="bi bi-box-seam display-4 d-block mb-3 text-secondary opacity-25"></i>
                                            <h5 class="text-light fw-normal">No hay productos registrados</h5>
                                            <p class="text-muted small mb-0">Usa el formulario superior para agregar uno.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CONTENEDOR MÓVIL: Tarjetas adaptadas verticalmente para pantallas pequeñas -->
            <div class="mobile-card-view mb-4">
                <div class="row g-3" id="inventoryCards">
                    @forelse($products as $product)
                        <div class="col-12 product-card-item" data-name="{{ strtolower($product->nombre ?? $product->name) }}" data-code="{{ strtolower($product->codigo_barras ?? $product->code ?? '') }}">
                            <div class="card-form-section p-3 position-relative">
                                <div class="d-flex align-items-start gap-3">
                                    <!-- Imagen del producto -->
                                    @php $img = $product->imagen ?? $product->image; @endphp
                                    <div class="product-img-wrapper flex-shrink-0" style="width: 60px; height: 60px;">
                                        @if($img)
                                            <img src="{{ asset('storage/' . $img) }}" alt="Prod">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted" style="background-color: var(--bg-input);">
                                                <i class="bi bi-image opacity-50" style="font-size: 20px;"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Información principal -->
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h6 class="fw-bold text-light mb-1 text-truncate">{{ $product->nombre ?? $product->name }}</h6>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge border border-secondary border-opacity-50 px-2 py-0.5 text-light font-mono small" style="background-color: var(--bg-input);">
                                                {{ $product->codigo_barras ?? $product->code ?? 'N/A' }}
                                            </span>
                                            <span class="badge {{ $product->stock <= 3 ? 'badge-stock-low' : 'badge-stock-normal' }} px-2.5 py-0.5 rounded-pill fw-semibold font-mono small">
                                                {{ $product->stock }} disp.
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold font-mono fs-5" style="color: #f59e0b;">
                                                ${{ number_format($product->precio ?? $product->price, 2) }}
                                            </span>
                                            
                                            @can('admin-only')
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-sm btn-glass-action px-2 py-1 rounded-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}" title="Editar">
                                                        <i class="bi bi-pencil-square" style="color: #f59e0b;"></i>
                                                    </button>
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-glass-action px-2 py-1 rounded-2 shadow-sm" onclick="return confirm('¿Eliminar producto?')" title="Eliminar">
                                                            <i class="bi bi-trash3" style="color: #ef4444;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">
                            <div class="card-form-section p-4">
                                <i class="bi bi-box-seam display-4 d-block mb-3 text-secondary opacity-25"></i>
                                <h5 class="text-light fw-normal">No hay productos registrados</h5>
                                <p class="text-muted small mb-0">Usa el formulario superior para agregar uno.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <!-- MODALES DE EDICIÓN (AGREGADOS PARA QUE LOS BOTONES FUNCIONEN) -->
    @can('admin-only')
        @foreach($products as $product)
            <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header border-bottom border-secondary border-opacity-25">
                            <h5 class="modal-title fw-bold text-light" id="editModalLabel{{ $product->id }}">
                                <i class="bi bi-pencil-square text-warning me-2"></i> Editar Producto
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold">Nombre del producto</label>
                                    <input type="text" name="nombre" class="form-control" value="{{ $product->nombre ?? $product->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold">Código de barras</label>
                                    <input type="text" name="codigo_barras" class="form-control font-mono" value="{{ $product->codigo_barras ?? $product->code }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small fw-semibold">Precio ($)</label>
                                        <input type="number" step="0.01" name="precio" class="form-control font-mono" value="{{ $product->precio ?? $product->price }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small fw-semibold">Stock</label>
                                        <input type="number" name="stock" class="form-control font-mono" value="{{ $product->stock }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold">Actualizar Imagen (Opcional)</label>
                                    <input type="file" name="imagen" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer border-top border-secondary border-opacity-25">
                                <button type="button" class="btn btn-sm btn-glass-action" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-custom-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endcan

    <!-- Scripts de Bootstrap Bundle (Indispensable para que funcionen los modales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : 'Ningún archivo';
            const nameContainer = input.closest('.custom-file-upload').querySelector('.file-upload-name');
            if (nameContainer) {
                nameContainer.textContent = fileName;
            }
        }

        function filterInventory() {
            let input = document.getElementById('searchTableInput').value.toLowerCase();
            
            // Filtrar tabla de escritorio
            let rows = document.querySelectorAll('.product-row');
            rows.forEach(row => {
                let name = row.getAttribute('data-name');
                let code = row.getAttribute('data-code');
                if (name.includes(input) || code.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });

            // Filtrar tarjetas móviles
            let cards = document.querySelectorAll('.product-card-item');
            cards.forEach(card => {
                let name = card.getAttribute('data-name');
                let code = card.getAttribute('data-code');
                if (name.includes(input) || code.includes(input)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>