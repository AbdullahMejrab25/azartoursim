<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Include CSS once -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    <!-- Include JS once and defer the loading for better performance -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
        .navbar-brand {
            font-weight: bold;
            font-size: 1.75rem;
            color: #ffcc00; /* Yellow color (you can change it to any color you want) */
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>
<body>
   <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 10px;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" aria-expanded="false" style="display:none;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Admin Panel</a>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
             <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body text-center">
                        <div class="error-icon">
                            <i class="fas fa-lock fa-5x text-danger"></i> <!-- FontAwesome lock icon -->
                        </div>
                        <h1 class="text-danger mb-3">{{ __('403 Forbidden') }}</h1>
                        <p class="lead">{{ __('You do not have permission to access this page.') }}</p>
                        <p>{{ __('If you believe this is an error, please contact your system administrator.') }}</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-home"></i> {{ __('Go to Dashboard') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>


@push('styles')
    <style>
        .error-icon {
            margin-bottom: 20px;
        }

        .error-icon i {
            font-size: 80px;
        }

        .card {
            background-color: #f8f9fa;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
@endpush
