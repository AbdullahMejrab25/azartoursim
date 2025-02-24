<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Admin Panel') }} - Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles (optional) -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .auth-card {
            width: 100%;
/*            max-width: 400px;*/
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
