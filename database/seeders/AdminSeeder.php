<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrateurs')->insert([
            'nom_prenom' => "Administrateur",
            'email' => "admin@cica2022.ci",
            'password' => Hash::make('password'),
            'api_token' => Str::random(60)
        ]);
    }
}
