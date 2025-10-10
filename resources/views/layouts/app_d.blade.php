<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SB Admin 2 - Buttons</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layout.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Topbar -->
            @include('layout.navbar')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/dist/echo.iife.js"></script>
    <script>
        if (typeof Echo === 'undefined') {
            console.error('Laravel Echo library did not load. Check the <script> tag URL.');
        } else {
            // أنشئ instance واحدة فقط
            window.Echo = new Echo({
                broadcaster: 'reverb',
                key: "{{ env('REVERB_APP_KEY', 'local') }}",
                wsHost: "{{ env('REVERB_HOST', request()->getHost()) }}",
                wsPort: Number("{{ env('REVERB_PORT', 8080) }}"),
                wssPort: Number("{{ env('REVERB_PORT', 8080) }}"),
                forceTLS: "{{ env('REVERB_SCHEME', 'http') }}" === 'https',
                enabledTransports: ['ws', 'wss'],
                // (اختياري) لو عندك دومين/منفذ مختلفين، عرّف authEndpoint/headers
                // authEndpoint: '{{ url('/broadcasting/auth') }}',
                // auth: { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } },
            });
            console.log('Echo ready:', window.Echo && typeof window.Echo.private);
        }
    </script>

    @yield('script')

</body>

</html>
