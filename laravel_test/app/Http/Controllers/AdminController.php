<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin_response = Admin::Index();
        return view("admin.index", compact("admin_response"));
    }

    public function create_channel(Request $request)
    {
        Admin::Create_Channel($request);
        return redirect("/admin")->with('flash_message', "チャンネルを発行しました。");
    }

    public function remove_channel($id)
    {
        Admin::Remove_Channel($id);
        return redirect("/admin")->with("flash_message", "チャンネルを削除しました。");
    }

    public function channel_status($cname)
    {
        $response = Admin::Channel_Status($cname);
        if ($response["api"]["channel_exist"]) {
            $user_count = $response["api"]["total"];
            $channel_exists = $response["api"]["channel_exist"];
            $channel_name = $response["channel_name"];
            return view("admin.channel_status", compact("channel_name", "channel_exists", "user_count"));
        }
        $channel_exists = "ユーザーがいません";
        return view("admin.channel_status", compact("channel_exists"));
    }

    public function connect_stream($id)
    {
        return view("admin.connect_stream");
    }
}
