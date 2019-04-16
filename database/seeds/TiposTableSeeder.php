<?php

use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'name' => 'Almoço',
        ]);

        factory(App\Tipo::class, 5)->create();
    }
}
