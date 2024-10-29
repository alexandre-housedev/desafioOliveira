<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email','dasilvaferreira_a@yahoo.com.br')->first()){
            $userAdm = User::create([
                'name' => 'Alexandre Ferreira',
                'email' => 'dasilvaferreira_a@yahoo.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12])
            ]);
        }
    }
}
