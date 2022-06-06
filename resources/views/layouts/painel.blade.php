<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta ref="js-base_url" content="{{ env('APP_URL') }}">
    <meta ref="js-base_url_api" content="{{ env('APP_URL_API') }}">
    <meta ref="url" content="{{ _url() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ _mix('panel/css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>

<body>
    <div id="app">
        <x-menus />

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <script src="{{ _mix('panel/js/vendor.js') }}"></script>
    <script src="{{ _mix('panel/js/painel.js') }}"></script>
    <x-toastr />
    @yield('scripts')

</body>

</html>
