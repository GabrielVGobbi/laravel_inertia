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

    <title>{{ 'Laravel Inertia' }}</title>

    <link href="{{ _mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ _mix('/js/app.js') }}" defer></script>
    @inertiaHead

</head>

<body>
    @inertia
</body>

</html>
