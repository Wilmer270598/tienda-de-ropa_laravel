<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Boutique 2025')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --sidebar-bg: #2c3e50;
            --sidebar-link-color: #ecf0f1;
            --sidebar-link-hover: #34495e;
            --content-bg: #ecf0f1;
            --main-text-color: #34495e;
            --box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: var(--sidebar-bg);
            padding: 20px 15px;
            overflow-y: auto;
            transition: width 0.3s ease-in-out;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Este es el cambio clave */
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--sidebar-link-color);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease-in-out;
        }
        
        .sidebar a:hover {
            background-color: var(--sidebar-link-hover);
            color: #fff;
            transform: translateX(5px);
        }
        
        .sidebar a i {
            margin-right: 15px;
            font-size: 1.2rem;
            width: 25px;
            text-align: center;
            transition: color 0.3s;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 30px;
            background-color: var(--content-bg);
            height: 100vh;
            overflow-y: auto;
            transition: margin-left 0.3s ease-in-out;
            color: var(--main-text-color);
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-link-color);
            font-size: 0.9rem;
            position: absolute;
            bottom: 0;
            width: 100%;
            margin-left: 250px;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar:hover {
                width: 250px;
            }
            .sidebar a span {
                display: none;
            }
            .sidebar:hover a span {
                display: inline-block;
            }
            .sidebar a {
                justify-content: center;
            }
            .sidebar a i {
                margin-right: 0;
            }
            .logo img {
                display: none;
            }
            .content {
                margin-left: 70px;
            }
            .footer {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div> <div class="logo">
                <a href="{{ route('pantalla.inicial') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Boutique 2025">
                </a>
            </div>

            <div class="mb-3 text-center text-white" style="font-family: 'Arial', Times, serif; font-size: 1.1rem; font-style: normal; font-weight: 400; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);">
                Bienvenido: <br> {{ auth()->user()->nombre_completo }}
            </div>
            
            <div class="sidebar-nav">
                {{-- Menú condicional por rol --}}
                @if(auth()->user()->id_rol == 1)
                    <a href="{{ route('usuarios.index') }}">
                        <i class="fas fa-users"></i> <span>Usuarios</span>
                    </a>
                    <a href="{{ route('clientes.index') }}">
                        <i class="fas fa-user-tag"></i> <span>Clientes</span>
                    </a>
                    <a href="{{ route('productos.index') }}">
                        <i class="fas fa-box-open"></i> <span>Productos</span>
                    </a>
                    <a href="{{ route('proveedores.index') }}">
                        <i class="fas fa-truck"></i> Proveedores
                    </a>
                    <a href="{{ route('ventas.index') }}">
                        <i class="fas fa-chart-line"></i> <span>Ventas</span>
                    </a>
                    <a href="{{ route('detalleventa.index') }}">
                        <i class="fas fa-file-invoice"></i> <span>Detalle de ventas</span>
                    </a>
                    <a href="{{ route('inventario.index') }}">
                        <i class="fas fa-warehouse"></i> <span>Inventarios</span>
                    </a>

                @elseif(auth()->user()->id_rol == 2)
                    <a href="{{ route('clientes.index') }}">
                        <i class="fas fa-user-tag"></i> <span>Clientes</span>
                    </a>
                    <a href="{{ route('productos.index') }}">
                        <i class="fas fa-box-open"></i> <span>Productos</span>
                    </a>
                    <a href="{{ route('ventas.index') }}">
                        <i class="fas fa-chart-line"></i> <span>Ventas</span>
                    </a>
                    <a href="{{ route('detalleventa.index') }}">
                        <i class="fas fa-file-invoice"></i> <span>Detalle de ventas</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="text-center mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm w-75" style="background-color: #ffffff; color: #000000; border-color: #ced4da;">
    <i class="fas fa-sign-out-alt me-1"></i> Cerrar sesión
</button>
            </form>
        </div>
    </div>


    <div class="content">
        @yield('content')
    </div>
    
    <div class="footer">
        Copyright © 2025 Boutique Soffia
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>