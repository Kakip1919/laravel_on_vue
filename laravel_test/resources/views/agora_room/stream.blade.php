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
<form id="loginForm" enctype="multipart/form-data">
    @csrf
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
    <div class="row col l12 s12">
        <div class="row container col l12 s12 main-container">

            <div class="col" style="min-width: 150px; max-width: 443px">
                <div class="card" style="margin-top: 0px; margin-bottom: 0px;">
                    <div class="row card-content" style="margin-bottom: 0px; margin-top: 10px;">
                        <div class="input-field">
                            <label for="appId" class="active">App ID</label>
                            <input type="text" placeholder="App ID" name="appId">
                        </div>
                        <div class="input-field">
                            <label for="accountName" class="active">Account Name</label>
                            <input type="text" placeholder="account name" name="accountName">
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button type="button" class="btn btn-raised btn-primary waves-effect waves-light"
                                        id="login">LOGIN
                                </button>
                                <button class="btn btn-raised btn-primary waves-effect waves-light" id="logout">LOGOUT
                                </button>
                            </div>
                        </div>
                        <div class="input-field">
                            <label for="channelName" class="active">Channel Name</label>
                            <input type="text" placeholder="channel name" name="channelName">
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn btn-raised btn-primary waves-effect waves-light" id="join">JOIN
                                </button>
                                <button class="btn btn-raised btn-primary waves-effect waves-light" id="leave">LEAVE
                                </button>
                            </div>
                        </div>
                        <div class="input-field channel-padding">
                            <label for="channelMessage" class="active">Channel Message</label>
                            <input type="text" placeholder="channel message" name="channelMessage">
                            <button class="btn btn-raised btn-primary waves-effect waves-light custom-btn-pin"
                                    id="send_channel_message">SEND
                            </button>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-size: 20px; margin-right: 10px;">IMAGE</span>
                                <div id="agora-image">
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-size: 16px; margin-top: 7px;">channel</span>
                                <button class="btn btn-raised btn-primary waves-effect waves-light"
                                        id="send-channel-image">SEND
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s7 log-container" id="log">
            </div>
        </div>
    </div>

</form>
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
<script src="{{asset("js/rtm-client.js")}}"></script>
<script src="{{asset("js/index.js")}}"></script>
<script>

    {{--$(document).ready(function () {--}}
    {{--    let count = window.sessionStorage.getItem(["{{$ch_name}}" + 'count'])--}}
    {{--    setInterval(function () {--}}
    {{--        window.sessionStorage.setItem(["{{$ch_name}}" + 'count'], [count]);--}}
    {{--        count++;--}}
    {{--        console.log(count);--}}
    {{--    }, 1000);--}}
    {{--});--}}
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
    $("#file").on("change", function () {
        let file = document.getElementById("file").files[0]
        let form = new FormData();
        form.append("file", file)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/store_img',
            type: 'POST',
            data: form,
            processData: false,
            contentType: false,
            success: function (data) {
                $("#img").remove()
                $("#file").val("")
                $("#agora-image").append("<img src=/storage/"+data+" width=200px height=100px id=img>")
            },
            fail(error) {
                alert(error)
            }

        });
        return false;
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

