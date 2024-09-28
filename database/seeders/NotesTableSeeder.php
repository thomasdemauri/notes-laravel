<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([
            [
                'user_id' => 1,
                'title'   => 'Filmes bons',
                'text'    => 'Aqui estao uma lista de filmes bons...',
                'created_at' => date('Y-m-d H:i:s')
            ],
            // [
            //     'user_id' => 2,
            //     'title'   => 'Outro bloco de nota',
            //     'text'    => 'Amanhã é segunda e tenho que trabalhar',
            //     'created_at' => date('Y-m-d H:i:s')
            // ],
        ]); 
    }
}
