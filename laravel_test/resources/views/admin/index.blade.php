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
        @if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
        @endif
    </div>
</div>
<div id="app">
    <index-component>
        <h2>ビデオチャットサンプル｜クライアント側</h2>
        <hr>
        <h3>チャンネル発行</h3>
        <form method="post" action="{{route("admin.create_channel")}}">
            @csrf
            <label>チャンネル名
            <input type="text" name="channel_name" value="" placeholder="demo">
            </label>
            <label>最大参加人数
            <input type="text" name="num_of_attendees" value="" placeholder="2">
            </label>
            <input type="submit" value="新規発行">
        </form>
        <hr>
        <h3>発行済みチャンネル</h3>
        @foreach($admin_response as $room_data)
            <div> チャンネル名：{{$room_data->channel_name}}
                <a href="{{route("admin.connect_stream", ["id" => $room_data->id])}}">接続する</a> |
                <a href="{{route("admin.channel_status", ["cname" => $room_data->channel_name])}}">接続状況チェック</a> |
                <a href="{{route("admin.remove_channel", ["id" => $room_data->id])}}">削除する</a>
            </div>
        @endforeach
        <hr>
    </index-component>
</div>
</body>
</html>
