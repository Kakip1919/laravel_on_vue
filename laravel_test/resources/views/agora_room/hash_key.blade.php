<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    http://127.0.0.1:8000/video_room/{{$hash_parameter}}
    <hash-key-component>
    </hash-key-component>
</div>
</body>
</html>
