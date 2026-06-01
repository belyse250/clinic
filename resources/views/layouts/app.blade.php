<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clinic System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0D9488;
            --primary-hover: #0F766E;
            --bg-gradient-start: #0F766E;
            --bg-gradient-end: #10B981;
            --secondary-color: #64748B;
            --secondary-hover: #475569;
            --success-color: #10B981;
            --success-hover: #059669;
            --warning-color: #F59E0B;
            --warning-hover: #D97706;
            --danger-color: #EF4444;
            --danger-hover: #DC2626;
            --bg-color: #F0FDFA;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1E293B;
        }

        .navbar {
            background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
            box-shadow: 0 4px 20px rgba(13, 148, 136, 0.15);
            padding: 12px 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: white !important;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.95) !important;
            transition: all 0.2s;
            margin: 0 5px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-1px);
        }

        .sidebar {
            background: white;
            min-height: calc(100vh - 70px);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.02);
            border-right: 1px solid #E2E8F0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar-nav li {
            margin: 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            border-left: 4px solid transparent;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: #E6F8F6;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .sidebar-nav i {
            width: 20px;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .main-content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 24px;
            overflow: hidden;
            background: white;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .card-header {
            background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
            color: white;
            border: none;
            font-weight: 600;
            padding: 16px 24px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            text-align: center;
            border: 1px solid #F1F5F9;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.05);
        }

        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #1E293B;
        }

        .stat-card .stat-label {
            color: #64748B;
            margin-top: 10px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        /* Buttons system */
        .btn {
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.2s ease-in-out;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.25);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover, .btn-danger:focus {
            background-color: var(--danger-hover) !important;
            border-color: var(--danger-hover) !important;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }

        .btn-success:hover, .btn-success:focus {
            background-color: var(--success-hover) !important;
            border-color: var(--success-hover) !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover, .btn-warning:focus {
            background-color: var(--warning-hover) !important;
            border-color: var(--warning-hover) !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover, .btn-secondary:focus {
            background-color: var(--secondary-hover) !important;
            border-color: var(--secondary-hover) !important;
        }

        .table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #F1F5F9;
        }

        .table thead {
            background: #F8FAFC;
            border-bottom: 2px solid #E2E8F0;
        }

        .table-hover tbody tr:hover {
            background: #F8FAFC;
        }

        /* Badge styling */
        .badge {
            font-weight: 600 !important;
            padding: 0.35em 0.65em !important;
            font-size: 0.75em !important;
            border-radius: 50rem !important;
            display: inline-block;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
        }

        /* Status colors */
        .badge-pending, .badge-warning {
            background-color: #FEF3C7 !important;
            color: #D97706 !important;
        }

        .badge-confirmed, .badge-success {
            background-color: #DBEAFE !important;
            color: #2563EB !important;
        }

        .badge-completed, .badge-info {
            background-color: #D1FAE5 !important;
            color: #059669 !important;
        }

        .badge-cancelled, .badge-danger {
            background-color: #FEE2E2 !important;
            color: #DC2626 !important;
        }

        .alert {
            border: none;
            border-radius: 10px;
            animation: slideIn 0.3s ease-out;
            padding: 15px 20px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-title {
            font-size: 2rem;
            font-weight: bold;
            color: #1E293B;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 15px;
            background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #CBD5E1;
            padding: 10px 14px;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .footer {
            background: #F8FAFC;
            padding: 20px;
            text-align: center;
            color: #64748B;
            border-top: 1px solid #E2E8F0;
            margin-top: 40px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                padding: 20px;
            }
        }

        /* Print styles optimization */
        @media print {
            .navbar, .sidebar, .btn, .footer, form, .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .main-content {
                padding: 0 !important;
                width: 100% !important;
            }
            .card {
                box-shadow: none !important;
                border: 1px solid #E2E8F0 !important;
                margin-bottom: 15px !important;
                page-break-inside: avoid;
            }
            .card-header {
                background: #F8FAFC !important;
                color: black !important;
                border-bottom: 2px solid #E2E8F0 !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-hospital"></i>Clinic System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-cog"></i>Profile Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>Register
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @auth
                <div class="col-md-3 col-lg-2 sidebar">
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.profile') }}" class="@if(request()->routeIs('user.profile')) active @endif">
                                <i class="fas fa-user-cog"></i>My Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('patients.index') }}" class="@if(request()->routeIs('patients.*')) active @endif">
                                <i class="fas fa-users"></i>Patients
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('doctors.index') }}" class="@if(request()->routeIs('doctors.*')) active @endif">
                                <i class="fas fa-user-md"></i>Doctors
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('appointments.index') }}" class="@if(request()->routeIs('appointments.*')) active @endif">
                                <i class="fas fa-calendar-alt"></i>Appointments
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reports.daily') }}" class="@if(request()->routeIs('reports.*')) active @endif">
                                <i class="fas fa-chart-line"></i>Daily Report
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth

            <!-- Main Content -->
            <div class="@auth col-md-9 col-lg-10 @else col-12 @endauth">
                <div class="main-content">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Error!</strong> Please check the form below.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 Clinic System. All rights reserved. | Powered by Laravel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>
