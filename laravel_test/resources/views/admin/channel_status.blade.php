<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>
<body>
@if($channel_exists === true)
    <h1>チャンネル名：　{{ $channel_name }}</h1>
    <h1>参加ユーザー数：　{{ $user_count }}人</h1>
@else
    <h1>{{ $channel_exists }}</h1>
@endif

<script>
    const timer = 60000    // ミリ秒で間隔の時間を指定
    window.addEventListener('load', function () {
        setInterval('location.reload()', timer);
    });
</script>
</body>
</html>
