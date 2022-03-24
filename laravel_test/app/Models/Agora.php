<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * @property mixed|string $hash_parameter
 * @method static HashCreate(Request $request)
 * @method static insert(array $array)
 * @method static StandByRoom()
 */
class Agora extends Model
{
    protected $table = "users_info";
    use HasFactory;

    public function scopeHashCreate($query, Request $request)
    {
        $room_key = DB::table("credentials")->select("app_id")->first();
        $parameter = $room_key->app_id . "," . $request->input("channel_name");
        $request->session()->put('agora_user', $request->input("email"));
        $request->session()->put($request->input("channel_name")."count", 0);
        $hash_parameter = md5($parameter);
        self::insert(["mail_address" => $request->input("email"), "channel_name" => $request->input("channel_name"), "change_strings_to_hash" => $hash_parameter]);
        return $hash_parameter;
    }

    public function scopeStandByRoom($query, Request $request, $id)
    {
        if (!$request->session()->exists('already')) {
            DB::table("admin_rooms")->where("id", $id)->increment("current_attendees");
        }
        $request->session()->put('already', true);
        return DB::table("admin_rooms")->where("id", $id)->first();
    }
}
