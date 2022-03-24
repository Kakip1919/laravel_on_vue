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
<div class="container">
    <div class="row justify-content-center m-md-3 bg-primary">
        <h1>{{$channel->channel_name}}</h1>
    </div>
        <form method="post" action="{{route("agora_room.hash_create")}}">
            @csrf
            <label>メールアドレスを入力してください
                <input type="email" name="email">
                <input type="hidden" name="channel_name" value="{{$channel->channel_name}}">
            </label>
            <button type="submit">送信！</button>
        </form>
</div>
</body>
</html>
