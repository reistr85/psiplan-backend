@component('mail::message')
    <h1>Olá {{ $user['name'] }}!</h1>
    <p>Cadastro realizado com sucesso!</p>
    <p>Estamos felizes em poder lhe ajudar na escolha de um especialista em saúde mental.</p>
    <p>A partir de agora você poderá agendar e efetuar o pagamento de consultas na plataforma PSIPLAN BRASIL, assim como pagar pacote de consultas garantindo um desconto de até 15%.</p>
    <p>Faça sua consulta Online ou presencial. Todos os nossos profissionais são certificados pelo Conselho Federal de Psicologia (CFP), o que garante a segurança de seu atendimento e qualificação.</p>
    <p>Ahh e não esqueça de avaliar o profissional que lhe atendeu, a sua opinião é muito importante para nós! Disponibilizamos um perfil exclusivo para você, basta acessar com o seu e-mail e senha.</p>
    <p>Aproveite esta jornada de autoconhecimento!</p>
    @component('mail::button', ['url' => 'https://psiplan.mgetech.com.br'])
        Clique aqui
    @endcomponent
@endcomponent
