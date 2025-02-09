<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MovieApp')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Animaciones con AOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
    <!-- Fuente personalizada -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #f5f5f5;
        }
        .content {
            margin-top: 20px;
        }
        .footer {
            background-color: #1a1a1a;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 20px;
        }
        .list-group-item:hover {
            background: #007bff;
            color: white;
        }
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- HEADER -->
    @include('partials.header')

    <div class="container content">
        @yield('content')
    </div>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Animaciones con AOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @stack('scripts')

</body>
</html>
