<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'mahasiswa',
                'guard_name' => 'web',
            ],
            [
                'name' => 'dosen',
                'guard_name' => 'web',
            ],
        ])->each(function($roles){
            Role::create($roles);
        });
    }
}
