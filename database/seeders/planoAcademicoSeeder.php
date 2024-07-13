<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class planoAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('plano_academico')->insert([
            'descricao' => 'Descrição 1',
            'data_inicio' => '2023-01-01',
            'data_fim' => '2023-02-01',
            'ativo' => true,
            'ano' => 2023,
            'periodo_intensivo' => 1,
            'periodo_extensivo' => 2,
            'pit_inicio' => now(),
            'pit_fim' => now()->addDays(30),
            'rit_inicio' => now()->addDays(31),
            'rit_fim' => now()->addDays(60),
        ]);

        DB::table('pit')->insert([
            'servidor_id' => 1,
            'plano_academico_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
