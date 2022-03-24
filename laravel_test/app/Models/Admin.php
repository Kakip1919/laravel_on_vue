<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


/**
 * @method static Create_Channel()
 * @method static get()
 * @method static Index()
 * @method static where(string $string, $id)
 * @method static Remove_Channel()
 * @method static Channel_Status(Request $request)
 */
class Admin extends Model
{
    protected $table = "admin_rooms";
    use HasFactory;

    public function scopeIndex()
    {
        $admin_instance = self::get();
        if (!empty($admin_instance)) {
            return $admin_instance;
        }
        return [];
    }

    public function scopeCreate_Channel($query, Request $request)
    {
        $request->input("channel_name") === null ? $channel_name = date(now()) : $channel_name = $request->input("channel_name");
        $admin_instance = new Admin();
        $admin_instance->app_id = Credential::where("id", 1)->first()->app_id;
        $admin_instance->channel_name = $channel_name;
        $admin_instance->num_of_attendees = $request->input("num_of_attendees");
        $admin_instance->save();
    }

    public function scopeRemove_Channel($query, $id)
    {
        if (self::where("id", $id)->exists()) {
            self::where("id", $id)->delete();
        }
    }

    public function scopeConnect_Channel($query, $id)
    {
        if (self::where("id", $id)->exists()) {
            self::where("id", $id)->delete();
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function scopeChannel_Status($query, $cname)
    {
        $url = "https://api.agora.io/dev/v1/channel/user/340dc81b046b499eadf86073d24bbc34/" . $cname;
        $response = Http::withBasicAuth("5600f09a33484aa4aa38115572c5d6ae", "0a84e6b5bb5243cab70a3320a5ccb763")
            ->get($url);
        return ["api" => $response->json()["data"], "channel_name" => $cname];
    }
}
