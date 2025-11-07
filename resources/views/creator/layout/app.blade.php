<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Watchfull</title>
    <link rel="icon" type="image/png" href="images/logo-removebg-preview.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    @stack('cdn')
    @stack('css')
</head>

<body>
    <!-- Navbar -->
    @include('creator.layout.inc.navbar')
    <!-- Sidebar -->
    @include('creator.layout.inc.sidebar')

    <!-- Main Content -->
    <main id="mainContent">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('creator.layout.inc.footer')

   @stack('modal')

    <!-- Mobile Menu -->
    <button id="mobileMenu">☰</button>

    @stack('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" defer></script>
    <script src="js/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>