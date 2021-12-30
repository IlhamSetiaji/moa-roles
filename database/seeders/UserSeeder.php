<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'Ilham Setiaji',
                'username' => 'ilham',
                'email' => 'ilham@test.test',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Refinaldy Madras',
                'username' => 'refi',
                'email' => 'refinaldy@test.test',
                'password' => Hash::make('password'),
            ],
        ])->each(function($users){
            $user=User::create($users);
            $user->id === 1 ? $user->assignRole('mahasiswa') : '';
            $user->id === 2 ? $user->assignRole('dosen') : '';
        });
    }
}
