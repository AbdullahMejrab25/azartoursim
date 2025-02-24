<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 1.75rem;
            color: #ffcc00;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>
<body>
   <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            Welcome, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile Update</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <div class="list-group">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                    @can('view users')
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Users</a>
                    @endcan
                    @can('manage roles')
                        <a href="{{ route('admin.roles.index') }}" class="list-group-item list-group-item-action">Roles</a>
                    @endcan
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>