<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();
        DB::table('users')->insert([
                'name' => 'Nom1',
                'email' => 'email1@gmx.ch',
                'password' => Hash::make('password1'),
                'admin' => 1]);
        for ($i = 2; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => 'Nom' . $i,
                'email' => 'email' . $i . '@gmx.ch',
                'password' => Hash::make('password' . $i),
                'admin' => 0]);
        }
    }
}
