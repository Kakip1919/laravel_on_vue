<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credentials')->insert([
            'project_name' => "No Credentials",
            'app_id' => "340dc81b046b499eadf86073d24bbc34",
            'token' => "",
        ]);
    }
}
