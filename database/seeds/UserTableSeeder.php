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
            'cpf' => '06453765901',
            'birhdate' => '1988-10-12',
            'zip_code' => '',
            'address' => '',
            'address_number' => '',
            'district' => '',
            'complement' => '',
            'city' => '',
            'uf' => '',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Colaborador Dilnei 2',
            'email' => 'teste@colaborador.com2',
            'cpf' => '06453765902',
            'birhdate' => '1988-10-12',
            'zip_code' => '',
            'address' => '',
            'address_number' => '',
            'district' => '',
            'complement' => '',
            'city' => '',
            'uf' => '',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Colaborador Dilnei 3',
            'email' => 'teste@colaborador.com3',
            'cpf' => '06453765903',
            'birhdate' => '1988-10-12',
            'zip_code' => '',
            'address' => '',
            'address_number' => '',
            'district' => '',
            'complement' => '',
            'city' => '',
            'uf' => '',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Colaborador Dilnei 4',
            'email' => 'teste@colaborador.com4',
            'cpf' => '06453765904',
            'birhdate' => '1988-10-12',
            'zip_code' => '',
            'address' => '',
            'address_number' => '',
            'district' => '',
            'complement' => '',
            'city' => '',
            'uf' => '',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Administrador Dilnei',
            'email' => 'teste@admin.com',
            'cpf' => '91484114000',
            'birhdate' => '1988-10-12',
            'zip_code' => '',
            'address' => '',
            'address_number' => '',
            'district' => '',
            'complement' => '',
            'city' => '',
            'uf' => '',
            'role_id' => '1',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
