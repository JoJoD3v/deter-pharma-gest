<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DeterPharma Gest') }} - Gestionale</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --dp-blue-deep: #216581;
            --dp-blue-medium: #2FA4C4;
            --dp-blue-intermediate: #41B7D1;
            --dp-blue-light: #60D6F4;
            --dp-blue-pastel: #98DFEC;
            --dp-bg-main: #F8FBFC;
            --dp-card-bg: #FFFFFF;
            --dp-border-light: #E0F5FA;
            --dp-table-alt: #F0FAFC;
        }

        body {
            background-color: var(--dp-bg-main);
        }

        .navbar-dark {
            background-color: var(--dp-blue-deep) !important;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--dp-blue-deep) 0%, var(--dp-blue-medium) 100%);
            box-shadow: 2px 0 10px rgba(33, 101, 129, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 12px 20px;
            margin: 4px 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: var(--dp-blue-intermediate);
            color: white;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: var(--dp-blue-light);
            color: var(--dp-blue-deep) !important;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(96, 214, 244, 0.3);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1em;
        }

        .card {
            background-color: var(--dp-card-bg);
            border: 1px solid var(--dp-border-light);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(33, 101, 129, 0.08);
        }

        .card-header {
            background-color: var(--dp-blue-pastel);
            color: var(--dp-blue-deep);
            font-weight: 600;
            border-bottom: 2px solid var(--dp-blue-light);
        }

        .btn-primary {
            background-color: var(--dp-blue-medium);
            border-color: var(--dp-blue-medium);
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color: var(--dp-blue-intermediate);
            border-color: var(--dp-blue-intermediate);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(47, 164, 196, 0.3);
        }

        .btn-secondary {
            background-color: var(--dp-blue-pastel);
            border-color: var(--dp-blue-pastel);
            color: var(--dp-blue-deep);
            border-radius: 6px;
        }

        .btn-secondary:hover {
            background-color: var(--dp-blue-light);
            border-color: var(--dp-blue-light);
            color: var(--dp-blue-deep);
        }

        .btn-info {
            background-color: var(--dp-blue-intermediate);
            border-color: var(--dp-blue-intermediate);
        }

        .btn-info:hover {
            background-color: var(--dp-blue-light);
            border-color: var(--dp-blue-light);
        }

        .table {
            background-color: var(--dp-card-bg);
        }

        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: var(--dp-table-alt);
        }

        .table thead th {
            background-color: var(--dp-blue-pastel);
            color: var(--dp-blue-deep);
            border-bottom: 2px solid var(--dp-blue-intermediate);
        }

        a {
            color: var(--dp-blue-intermediate);
            text-decoration: none;
        }

        a:hover {
            color: var(--dp-blue-medium);
            text-decoration: underline;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .badge {
            border-radius: 6px;
            padding: 6px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--dp-blue-intermediate);
            box-shadow: 0 0 0 0.25rem rgba(65, 183, 209, 0.25);
        }

        .page-link {
            color: var(--dp-blue-medium);
        }

        .page-link:hover {
            color: var(--dp-blue-deep);
            background-color: var(--dp-blue-pastel);
        }

        .page-item.active .page-link {
            background-color: var(--dp-blue-medium);
            border-color: var(--dp-blue-medium);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="bi bi-clipboard-data"></i> DeterPharma Gest
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="bi bi-house-door"></i> Dashboard
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }} {{ Auth::user()->cognome }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-md-block bg-light sidebar">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                    <i class="bi bi-people"></i> Gestione Utenti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('clienti.*') ? 'active' : '' }}" href="{{ route('clienti.index') }}">
                                    <i class="bi bi-person-vcard"></i> Gestione Clienti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('ddts.*') ? 'active' : '' }}" href="{{ route('ddts.index') }}">
                                    <i class="bi bi-file-earmark-text"></i> Gestione DDT
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('lavori.*') ? 'active' : '' }}" href="{{ route('lavori.index') }}">
                                    <i class="bi bi-tools"></i> Gestione Lavori
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-10 ms-sm-auto px-md-4">
                    <div class="py-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        @else
            <main class="py-4">
                @yield('content')
            </main>
        @endauth
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
