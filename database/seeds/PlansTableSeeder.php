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
                'pagarme_plan_id' => '541639',
                'name' => 'simple-tri',
                'label' => 'Plano Gestão Simples',
                'description' => 'Este plano é para profissionais que necessitam apenas de uma gestão básica em seu consultório, disponibilizando seu perfil profissional e agenda de atendimentos. Para este plano é essencial atendimento em um espaço físico.',
                'period' => 'tri',
                'price' => '93.20',
                'price_discount' => '93.20',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'pagarme_plan_id' => '541660',
                'name' => 'simple-sem',
                'label' => 'Plano Gestão Simples',
                'description' => 'Este plano é para profissionais que necessitam apenas de uma gestão básica em seu consultório, disponibilizando seu perfil profissional e agenda de atendimentos. Para este plano é essencial atendimento em um espaço físico.',
                'period' => 'sem',
                'price' => '93.20',
                'price_discount' => '69.90',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'pagarme_plan_id' => '541664',
                'name' => 'economic-tri',
                'label' => 'Plano Gestão Econômica',
                'description' => 'Este plano é para profissionais que necessitam de uma gestão mais completa. Além de disponibilizar seu perfil profissional e agenda de atendimentos, o  Psicólogo que aderir este plano poderá criar sua agenda para atendimentos Online e/ou presencial oferecendo ao cliente comodidade, conforto, e segurança  possibilitando ao usuário efetuar o pagamento de sua consulta diretamente na plataforma Psiplan  o que, de imediato, tem a sua sessão já confirmada.',
                'period' => 'tri',
                'price' => '153.20',
                'price_discount' => '153.20',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'pagarme_plan_id' => '541663',
                'name' => 'economic-sem',
                'label' => 'Plano Gestão Econômica',
                'description' => 'Este plano é para profissionais que necessitam de uma gestão mais completa. Além de disponibilizar seu perfil profissional e agenda de atendimentos, o  Psicólogo que aderir este plano poderá criar sua agenda para atendimentos Online e/ou presencial oferecendo ao cliente comodidade, conforto, e segurança  possibilitando ao usuário efetuar o pagamento de sua consulta diretamente na plataforma Psiplan  o que, de imediato, tem a sua sessão já confirmada.',
                'period' => 'sem',
                'price' => '153.20',
                'price_discount' => '114.90',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'pagarme_plan_id' => '541665',
                'name' => 'premium-tri',
                'label' => 'Plano Gestão Premium',
                'description' => 'Este plano é para profissionais que buscam uma gestão profissional. Além de disponibilizar seu perfil profissional e agenda de atendimentos, o Psicólogo que aderir este plano poderá criar sua agenda para atendimentos Online e/ou presencial, terá visibilidade para todo país, avaliação de clientes, e seu perfil em nossa página inicial do site proporcionando tráfego de pessoas em sua página, dentre outros benefícios, como pagamentos de consultas na própria plataforma oferecendo eficiência, agilidade, segurança e comodidade ao cliente. Este plano lhe permite  compartilhar fotos e vídeos de seu canal de Youtube, como elaborar precificação de pacotes de consultas, garantindo a fidelização de seu cliente por mais tempo. No Gestão Premium você poderá compartilhar seu link de perfil em suas redes sociais, aumentando ainda mais sua visibilidade, e reputação profissional.',
                'period' => 'tri',
                'price' => '173.20',
                'price_discount' => '173.20',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'pagarme_plan_id' => '541666',
                'name' => 'premium-sem',
                'label' => 'Plano Gestão Premium',
                'description' => 'Este plano é para profissionais que buscam uma gestão profissional. Além de disponibilizar seu perfil profissional e agenda de atendimentos, o Psicólogo que aderir este plano poderá criar sua agenda para atendimentos Online e/ou presencial, terá visibilidade para todo país, avaliação de clientes, e seu perfil em nossa página inicial do site proporcionando tráfego de pessoas em sua página, dentre outros benefícios, como pagamentos de consultas na própria plataforma oferecendo eficiência, agilidade, segurança e comodidade ao cliente. Este plano lhe permite  compartilhar fotos e vídeos de seu canal de Youtube, como elaborar precificação de pacotes de consultas, garantindo a fidelização de seu cliente por mais tempo. No Gestão Premium você poderá compartilhar seu link de perfil em suas redes sociais, aumentando ainda mais sua visibilidade, e reputação profissional.',
                'period' => 'sem',
                'price' => '153.20',
                'price_discount' => '129.90',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        Plan::insert($data);
    }
}
