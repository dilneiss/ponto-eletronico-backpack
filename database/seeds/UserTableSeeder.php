<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Colaborador Dilnei',
            'email' => 'teste@colaborador.com',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Administrador Dilnei',
            'email' => 'teste@admin.com',
            'role_id' => '1',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
