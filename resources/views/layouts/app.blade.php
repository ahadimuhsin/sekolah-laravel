<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('includes.style')
    @stack('custom-style')

</head>

<body style="background: #e2e8f0">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            @include('includes.admin.navbar')
            @include('includes.admin.sidebar')

            {{-- Main Content --}}
            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2021
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>
    @include('includes.script')
    @stack('custom-script')
</body>

</html>
