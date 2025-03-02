<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoituresTableSeeder extends Seeder
{
    private function randColor() {
        $color = ["rouge", "bleue", "verte", "noire", "blanche"];
        return $color[rand(0, count($color)-1)];
    }

    private function randType() {
        $type = ["break", "limousine", "SUV", "sport", "berline"];
        return $type[rand(0, count($type)-1)];
    }

    private function randMarque() {
        $marque = ["Toyota", "Seat", "BMW", "Audi", "Ferrari"];
        return $marque[rand(0, count($marque)-1)];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('voitures')->delete();
        for ($i = 1; $i <= 10; $i++) {
            DB::table('voitures')->insert([
                'marque' => $this->randMarque(),
                'type' => $this->randType(),
                'couleur' => $this->randColor(),
                'cylindree' => rand(1, 3) . ',' . rand(0,9),
                'user_id' => rand(1, 10)
            ]);
        }
    }
}
