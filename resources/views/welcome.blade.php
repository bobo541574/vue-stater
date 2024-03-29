<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'Vue 3 - Stater') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="file">
        <button type="submit">upload</button>
    </form> --}}
    <div id="app">
        <Master></Master>
    </div>

</body>

</html>
