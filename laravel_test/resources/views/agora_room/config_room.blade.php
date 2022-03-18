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
    <form action="{{route("agora_room.hash_create")}}" method="POST">
        @csrf
        <config-component></config-component>
    </form>
</div>
</body>
</html>
<script>
    import ExampleComponent from "../../js/components/ExampleComponent";
    export default {
        components: {ExampleComponent}
    }
</script>
