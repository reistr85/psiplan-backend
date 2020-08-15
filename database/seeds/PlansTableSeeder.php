<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
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
            [
                'name' => 'GESTÃO BÁSICA',
                'description' => 'Este plano é para você que necessita apenas de uma gestão básica em seu consultório, seja ele um espaço físico ou virtual.',
                'price' => '20',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'GESTÃO ECONÔMICA',
                'description' => 'Este é para você, que além da gestão em seus atendimentos online ou presenciais, contará também com a visibilidade para captação de clientes, pagamento diretamente na plataforma, extrato de recebíveis, reconhecimento de clientes visíveis no site, atendimento de empresas parceiras e clientes clube Psiplan.',
                'price' => '30',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'GESTÃO PROFISSIONAL',
                'description' => 'Este plano lhe oferece uma Gestão completa! Visibilidade para todo o país, avaliação de clientes, seu perfil em nossa página principal do site, além de outros benefícios dos outros planos, você terá acesso a um cartão digital, ao qual poderá compartilhar em grupos de redes sociais. Esse plano lhe permitirá também ter um vídeo de apresentação pessoal em seu perfil, além de poder compartilhar fotos de seu consultório para quem quiser acessar, assim como um espaço para desenvolver seu próprio Blog.',
                'price' => '50',
                'is_is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        Plan::insert($data);
    }
}
