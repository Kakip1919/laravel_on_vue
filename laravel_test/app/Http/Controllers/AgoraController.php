<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\Agora;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class AgoraController extends Controller
{

    public function stream(Request $request, $hash_key)
    {
        $room_key = DB::table("credentials")->where("id", 1)->first();
        $user_info = DB::table("users_info")->where("change_strings_to_hash", $hash_key)->where("mail_address", $request->session()->get("agora_user"))->first();
        $max_users = DB::table("admin_rooms")->where("channel_name", $user_info->channel_name)->first();
        $admin = Admin::where("channel_name", $user_info->channel_name)->first();

        if ($admin->current_attendees < $max_users->num_of_attendees) {
            $request->session()->put('auth_user', true);
            return redirect()->route('agora_room.stand_by_room', ['id' => $admin->id]);
        }
        $client = new Client();
        $response = $client->request("GET", "https://api.agora.io/dev/v1/channel/user/$room_key->app_id/$user_info->channel_name", [
            "auth" => [
                "5600f09a33484aa4aa38115572c5d6ae",
                "0a84e6b5bb5243cab70a3320a5ccb763"
            ]
        ]);
        $posts = json_decode($response->getBody(),true);
        $user_list = $posts["data"];
        $db_key = $room_key->app_id . "," . $user_info->channel_name;
        if (md5($db_key) === $hash_key && $request->session()->get("auth_user") === true) {
            $ch_name = $admin->channel_name;
            return view("agora_room.stream", compact("ch_name", "user_list"));
        }
        return App::abort(404);
    }

    public function channel_detail($id)
    {
        $channel = Admin::where("id", $id)->first();
        return view("agora_room.channel_detail", compact("channel"));
    }

    public function hash_create(Request $request)
    {
        $request->session()->flush();
        $hash_parameter = Agora::HashCreate($request);
        return view("agora_room.display_hashkey", compact("hash_parameter"));
    }

    public function display_hash()
    {
        return view("agora_room.display_hashkey");
    }

    public function index()
    {
        $rooms_data = Admin::get();
        return view("agora_room.index", compact("rooms_data"));
    }

    public function stand_by_room($id, Request $request)
    {
        $response = Agora::StandByRoom($request, $id);
        $room_key = DB::table("credentials")->where("id", 1)->first();
        $email = $request->session()->get("agora_user");
        $user_info = DB::table("users_info")->where("mail_address", $email)->first();
        $hash_key = md5($room_key->app_id . "," . $user_info->channel_name);
        return view("agora_room.stand_by_room", compact("response", "hash_key"));
    }

    public function get_api($channel_name)
    {
        $room_key = DB::table("credentials")->where("id", 1)->first();
        $client = new Client();
        $response = $client->request("GET", "https://api.agora.io/dev/v1/channel/user/$room_key->app_id/$channel_name", [
            "auth" => [
                "5600f09a33484aa4aa38115572c5d6ae",
                "0a84e6b5bb5243cab70a3320a5ccb763"
            ]
        ]);
        $posts = json_decode($response->getBody(),true);
        return $posts["data"];
    }
}
