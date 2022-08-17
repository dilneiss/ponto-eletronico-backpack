<?php

use App\Models\Roles;
use Illuminate\Database\Seeder;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Roles::create([
            'name' => 'Administrador',
            'description' => 'Administrador',
        ]);

        Roles::create([
            'name' => 'Funcionário',
            'description' => 'Funcionário',
        ]);


    }
}
