<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        .navbar-custom { background-color: #ff6b6b; }
        .navbar-brand { font-weight: bold; color: #fff !important; }
        .navbar-nav a { color: #fff !important; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .alert-custom { border-radius: 8px; padding: 12px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#">Food Explorer</a>
            <div class="ms-auto">
                <a href="#" class="nav-link d-inline-block">Dashboard</a>
                <a href="#" class="nav-link d-inline-block">Restoran</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    
</body>
</html>