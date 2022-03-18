<?php

namespace App\Http\Controllers;


use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function video_room($hash_key)
    {
        $room_key = DB::table("tests")->where("id", 1)->first();
        $db_key = $room_key->app_id . "," . $room_key->token . ",".$room_key->mail_address;
        if(md5($db_key) === $hash_key){
            return view("agora_room.welcome");
        }
        return App::abort(404);
    }

    public function config_room()
    {

        return view("agora_room.config_room");
    }

    public function hash_create(Request $request)
    {
        $hash_parameter = TestModel::HashCreate($request);
        return view("agora_room.hash_key", compact("hash_parameter"));
    }

    public function hash_key()
    {
        return view("agora_room.hash_key");
    }


}
