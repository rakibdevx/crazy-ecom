    <!doctype html>
    <html lang="en" data-bs-theme="light">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{setting('site_name')}} | @stack('title')</title>
    <!--favicon-->
        <link rel="icon" href="{{asset(setting('site_favicon'))}}" type="image/png">

    <!--plugins-->
    <link href="{{asset('')}}backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}backend/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}backend/plugins/metismenu/mm-vertical.css">
    <!--bootstrap css-->
    <link href="{{asset('')}}backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{asset('')}}backend/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/main.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/dark-theme.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/sass/responsive.css" rel="stylesheet">
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


    <!--authentication-->

    <div class="section-authentication-cover">
        <div class="">
            <div class="row g-0">
                @yield('body')
             </div>
        <!--end row-->
        </div>
    </div>

    <!--authentication-->




    <!--plugins-->
    <script src="{{asset('/')}}backend/js/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bi-eye-slash-fill");
                $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });
    </script>
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
    </script>

    </body>
</html>
