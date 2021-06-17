<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sekolah - @yield('title')</title>

    @include('includes.style')
    @stack('custom-style')
</head>
<body style="background: #e2e8f0">
    <div id="app">
        <section class="section">
            @yield('content')
        </section>
    </div>

    @include('includes.script')
    @stack('custom-script')
</body>
</html>
