<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create multiple users, poderia ser feito de várias formas, incluindo factories
        // Mas nesse caso, será simplificado fazendo uma conexao direta com o banco de dados
        DB::table('users')->insert([
            [
                'username' => 'user_1@gmail.com',
                'password' => bcrypt('abc123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user_2@gmail.com',
                'password' => bcrypt('abc123'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user_3@gmail.com',
                'password' => bcrypt('abc123'),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);

    }
}
