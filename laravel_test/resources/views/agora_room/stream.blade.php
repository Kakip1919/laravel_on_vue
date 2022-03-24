<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          defer>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="{{asset("css/index.css")}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/rtm-client.js')}}" defer></script>
</head>
<body>

<button type="button" id="btn">更新</button>
<input type="hidden" value="{{$ch_name}}" id="channel_name">
<div id="app">
    <agora-rtc></agora-rtc>
</div>
<input type="hidden" id="ch_name" value="{{$ch_name}}" name="channel_name">
<input type="hidden" id="email" value="{{request()->session()->get("agora_user")}}" name="email">
<input type="hidden" id="app_id" value="340dc81b046b499eadf86073d24bbc34" name="app_id">
<div class="bg-white box">
    <table id="ajax" class="table table-hover">
        <tbody class="user-table">
        @if(!empty($user_list["users"]))
            @foreach($user_list["users"] as $ul)
                <tr>
                    <td>
                        ユーザー名 : {{$ul}}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="p-20">
    <div class="row">
        <div class="col s12 m4">
            <div class="grey lighten-4 p-20">
                <label for="channelMsg">Channel Message</label>
                <textarea placeholder="Type your message here.." id="channelMsg"
                          class="materialize-textarea"></textarea>
                <button id="sendMsgBtn" class="btn waves-effect">Send Message</button>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="grey lighten-4 p-20">
                <div id="messageBox">
                    <h5><b>Channel Name:</b> <span id="channelNameBox"></span></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="joinChannelModal" class="modal">
    <div class="modal-content">
        <h4 class="center">Join Channel</h4>
        <label for="agoraAppId">App ID</label>
        <input type="hidden" value="340dc81b046b499eadf86073d24bbc34" id="agoraAppId"/>
        <label for="accountName">User Name</label>
        <input type="hidden" value="{{request()->session()->get("agora_user")}}" id="accountName"/>
        <label for="channelNameInput">Channel Name</label>
        <input type="hidden" value="{{$ch_name}}" placeholder="Channel Name" id="channelNameInput"/>
    </div>
</div>

<style>
    .box {
        margin: auto;
        width: 650px;
        height: 250px;
        background: white;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src=" https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/agora-rtm-sdk@1.3.1/index.js"></script>
<script src="{{asset("js/common.js")}}"></script>
<script>
    $(document).ready(function () {
        let count = window.sessionStorage.getItem(["{{$ch_name}}" + 'count'])
        setInterval(function () {
            window.sessionStorage.setItem(["{{$ch_name}}" + 'count'],[count]);
            count++;
            console.log(count);
        }, 1000);
    });
    $("#sendMsgBtn").on("click", function () {
        let msg = $("#channelMsg").val();
        let app_id = $("#app_id").val();
        let ch_name = $("#ch_name").val();
        let email = $("#email").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/chat_store",
            data:
                {
                    "email": email,
                    "msg": msg,
                    "app_id": app_id,
                    "ch_name": ch_name
                },
            dataType: "json"
        })
            .done((res) => {
                console.log(res);
            })
            .fail((error) => {
                console.log(error)
            })
    });
    $(function () {
        setInterval(function () {
            $.ajax({
                type: "get",
                url: "/get_api/{{$ch_name}}",
            })
                .done((res) => {

                    $(".user-table").empty();
                    $.each(res["users"], function (i, value) {
                        let html = `
                      <tr class="user-list">
                          <td class="col-xs-2">ユーザー名：${value}</td>
                      </tr>
                                `;
                        $(".user-table").append(html);
                    });
                })
                .fail((error) => {
                    console.log(error)
                })
        }, 3000);
    });
</script>
</body>
</html>
