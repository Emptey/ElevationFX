<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Forex, Investment, Forex trading, trading" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/user.min.css') }}">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" sizes="32x32">

    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{ asset('js/user.min.js') }}"></script>


</head>
<body>
    <div class="container-fluid main-wrapper" style="height: 100%">
        <div class="row no-padding" style="height: 100%">
            
            <div class="col-md-3 col-lg-3 col-sm-12 no-padding no-margin">
                <x-user-nav />
            </div>

            <div class="col-md-9 col-lg-9 col-sm-12 no-padding no-margin">
                <div class="d-flex flex-row-reverse">
                    <x-user-header />
                </div>
                
                <div class="container center-content">
                    @yield('content')
                </div>

            </div>

        </div>
    </div>

     <!-- toastr script -->
     <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.options.progressBar = true;
                    toastr.info("{{ Session::get('message') }}");
                    break;
                
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    toastr.options.progressBar = true;
                    break;

                case 'success':
                    toastr.options.progressBar = true;
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.options.progressBar = true;
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif

        toastr.options.progressBar = true;
        // toastr.success('Hello');
    </script>
    <!-- end toastr -->

</body>
</html>