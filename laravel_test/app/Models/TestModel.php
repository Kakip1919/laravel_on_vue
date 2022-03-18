<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * @property mixed|string $hash_parameter
 * @method static HashCreate(Request $request)
 */
class TestModel extends Model
{
    protected $table = "tests";
    use HasFactory;

    public function scopeHashCreate($query, Request $request)
    {
        $room_key = DB::table("tests")->select("app_id", "token")->first();
        $parameter = $room_key->app_id . "," . $room_key->token . "," . $request->input("email");
        $hash_parameter = md5($parameter);
        DB::table("tests")->where("id", 1)->update(["mail_address" => $request->input("email"), "hash_parameter" => $hash_parameter]);
        return $hash_parameter;
    }

}
