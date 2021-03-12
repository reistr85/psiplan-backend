@component('mail::message')
    <h1>Olá {{ $data['name'] }} tudo bem?</h1>
    <p>Sua consulta foi cancelada, mas não se preocupe!</p>
    <p>A Psiplan gerou um VOUCHER no valor de sua consulta, para que você possa acessar o perfil do profissional e realizar o agendamento de uma nova data.</p>
    <p>Ao confirmar a data do agendamento, você deverá fazer a utilização do VOUCHER como forma de pagamento, garantindo assim a confirmação de sua consulta.</p>
    <p>Caso deseje realizar o REEMBOLSO do valor pago, será descontado um valor de 8% referente as taxas administrativas e operacionais da transação.</p>
    <br><p><b>Atenção</b></p>
    <ul>
        <li>Solicitação de reembolso através do CHAT na sua plataforma;</li>
        <li>Solicitação deverá ser feita 48 horas antes da data da consulta;</li>
        <li>Solicitação realizada após a data da consulta, o valor investido não será reembolsado, devido ao dano causado ao profissional que disponibilizou um horário para você. Solicitamos a leitura do “Termos de uso”, modalidade Cliente.</li>
    </ul>
    <br><p>Atenciosamente,</p>
    <p>Equipe Psiplan Brasil.</p>
    @component('mail::button', ['url' => 'https://psiplan.mgetech.com.br/#/login'])
        Clique aqui
    @endcomponent
@endcomponent
