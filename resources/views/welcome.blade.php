<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'Vue 3 - Stater') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <div id="app">
        <Master></Master>
    </div>

    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
