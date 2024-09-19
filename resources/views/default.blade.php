<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Application')</title>
    <!-- Inserisci qui i tuoi CSS personalizzati -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <!-- Header -->
    <header>
        <h1>@yield('header', 'Welcome to My Application')</h1>
        <!-- Inserisci qui eventuale menu di navigazione -->
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} My Application</p>
    </footer>
</div>

<!-- Inserisci qui i tuoi script JavaScript -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
