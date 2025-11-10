@include('frontend.layout.inc.header')
<body>
    <!-- Navbar -->
    @include('frontend.layout.inc.navbar')
    <!-- Sidebar -->
    @include('frontend.layout.inc.sidebar')

    <!-- Main Content -->
    <main id="mainContent">
        @yield('content')
        @stack('modal')
    </main>

    <!-- Footer  -->
    @include('frontend.layout.inc.footer')

    <!-- Mobile Menu -->
    <button id="mobileMenu">☰</button>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" defer></script>
    <script src="{{asset('frontend/js/script.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    {{-- External JS  --}}
    @stack('js')
</body>

</html>