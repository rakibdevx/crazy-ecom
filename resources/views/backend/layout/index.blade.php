
<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{setting('site_name')}}| @stack('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="title" content="{{ setting('meta_title') }}">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keywords" content="{{ setting('meta_keywords') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ setting('og_title') ?? setting('meta_title') }}">
    <meta property="og:description" content="{{ setting('og_description') ?? setting('meta_description') }}">
    <meta property="og:image" content="{{ asset(setting('og_image')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ setting('meta_title') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="{{ setting('twitter_card') ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ setting('og_title') ?? setting('meta_title') }}">
    <meta name="twitter:description" content="{{ setting('og_description') ?? setting('meta_description') }}">
    <meta name="twitter:image" content="{{ asset(setting('og_image')) }}">


    <!--favicon-->
    <link rel="icon" href="{{asset(setting('site_favicon'))}}" type="image/png">

    <!--plugins-->
    <link href="{{asset('/')}}backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/plugins/metismenu/mm-vertical.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/plugins/simplebar/css/simplebar.css">

    @stack('plugins')
    <!--bootstrap css-->
    <link href="{{asset('/')}}backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/css/extra-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{asset('/')}}backend/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/main.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/dark-theme.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/semi-dark.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/bordered-theme.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/responsive.css" rel="stylesheet">
    @stack('custom-css')

    <script>
        (function() {
        const savedTheme = localStorage.getItem('myecom');
        if (savedTheme) {
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        }
        })();
    </script>

</head>

<body>

    <!--start header-->
    @include('backend.layout.header')
    <!--end top header-->


    <!--start sidebar-->

    @include('backend.layout.sidebar')
    <!--end sidebar-->


    <!--start main wrapper-->
    <main class="main-wrapper">
        @yield('body')
    </main>
    <!--end main wrapper-->


        <!--start overlay-->
        <div class="overlay btn-toggle"></div>
        <!--end overlay-->



        <!--start footer-->
        @include('backend.layout.footer')
        <!--top footer-->


    <!--bootstrap js-->
    <script src="{{asset('/')}}backend/js/bootstrap.bundle.min.js"></script>

    <!--plugins-->
    <script src="{{asset('/')}}backend/js/jquery.min.js"></script>
    @stack('js')
    <!--plugins-->
    <script src="{{asset('/')}}backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{asset('/')}}backend/plugins/metismenu/metisMenu.min.js"></script>
    <script src="{{asset('/')}}backend/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{asset('/')}}backend/js/main.js"></script>



    <script>
        const logo = document.getElementById('logo');
        const htmlTag = document.documentElement;

        function updateLogo() {
            if(htmlTag.getAttribute('data-bs-theme') === 'dark') {
            logo.src = "{{ asset(setting('site_logo_dark')) }}";
            } else {
            logo.src = "{{ asset(setting('site_logo')) }}";
            }
        }
        updateLogo();
        new MutationObserver(updateLogo).observe(htmlTag, { attributes: true });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
