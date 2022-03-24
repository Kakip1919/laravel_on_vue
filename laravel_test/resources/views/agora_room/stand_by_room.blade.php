<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Laravel</title>
</head>
<body>
<div>
    現在の参加人数{{$response->current_attendees}}
</div>
<div class="boxContainer">
    待機中です
</div>
@if($response->current_attendees >= $response->num_of_attendees)
    <a href="{{url("/stream/$hash_key")}}">
        <button type="button" class="btn-primary">参加する</button>
    </a>
@endif
<script>


    const timer = 2000    // ミリ秒で間隔の時間を指定
    window.addEventListener('load', function () {
        setInterval('location.reload()', timer);
    });
</script>
</body>
</html>
