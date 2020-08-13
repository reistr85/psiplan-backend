<?php

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');

        $data = [
            ['description' => 'Anorexia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Ansiedade', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Aprendizagem', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'TDAH', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Autismo', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Auto-conhecimento', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Autoestima', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Burnout', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Bordeline', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Bulimia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Câncer', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Casais', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Compulsão alimentar', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Compulsão por compras', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Conflito familiar', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Conflito amoroso', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Vícios em jogos', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Dependência química', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Dependência química', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Dislexia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Drogas', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Endividamento', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Esquizofrenia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Fobia', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Medo', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Síndrome do pânico', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Morte e luto', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Obesidade', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Estresse', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Estresse pós-traumáti', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Sexualidade', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Cirurgia bariátrica', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Desenvolvimento pessoal', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Atendimento infantil', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Atendimento para idosos', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Feminicídio', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Emagrecimento', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'LGBT', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Relacionamentos afetivos', 'active' => 0, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        Specialty::insert($data);
    }
}
