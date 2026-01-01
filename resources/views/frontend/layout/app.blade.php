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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js "></script>
    <script>
        $(document).ready(function() {
            $('#logoutBtn').on('click', function() {
                Swal.fire({
                    title: 'Are you sure you want to logout?',
                    // text: "You will be logged out of the admin panel.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('auth.user.logout') }}";
                    }
                });
            });
        });
    </script>
    {{-- External JS  --}}
    @stack('js')
</body>

</html>
