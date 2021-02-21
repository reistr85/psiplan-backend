<?php

use App\Models\Preference;
use Illuminate\Database\Seeder;

class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');

        $data=  [
            ['description' => '10 minutos antes da próxima consulta agendada.', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Agendamento de novas consultas', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Nova mensagem no chat', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Cancelamento de consultas', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Nova avaliação de cliente recebida', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Novidades da Psiplan', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Deseja receber as mesmas notificações por e-mail?', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['description' => 'Deseja receber as mesmas notificações por SMS?', 'is_active' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];
        Preference::insert($data);
    }
}
