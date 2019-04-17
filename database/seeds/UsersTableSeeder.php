<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Opção 1
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'teste@admin.com',
            'password' => bcrypt('123456'),
        ]);
        // Opção 2
        factory(App\Entities\User::class, 2)->create();
    }
}
