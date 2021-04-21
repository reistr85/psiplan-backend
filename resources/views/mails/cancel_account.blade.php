@component('mail::message')
    <h1>Ahh que pena!</h1>
    <p style="text-align: justify">Agradecemos por ter feito parte do grupo de especialistas de nossa plataforma de gestão Psiplan. </p><br>
    <p style="text-align: justify">Se você está efetuando o cancelamento antes do prazo de fidelidade de seu plano ter expirado, solicitamos fazer uma leitura da política de cancelamento no rodapé de nosso site em: “Especialistas / Termos de uso.”</p><br>
    <p style="text-align: justify">Caso esteja no período de experiência, você pode mudar para um plano que atenda as suas necessidades básicas pagando menos. Basta acessar nossa plataforma, conferir e contratar. Ficaremos felizes em mantê-lo(a) conosco!</p><br>
    <p style="text-align: justify">Faça como muitos profissionais que estão se diferenciando na maneira de se posicionar no mercado, oferecendo aos seus futuros clientes a oportunidade de marcarem e realizarem suas consultas com comodidade, a qualquer hora e em qualquer lugar.</p><br>
    <p style="text-align: justify">Se ainda assim deseja cancelar a sua assinatura, lamentamos muito e desejamos revê-lo(a) em breve. </p><br>
    <p style="text-align: justify">Equipe Psiplan Brasil.</p><br>
    @component('mail::button', ['url' => env('APP_URL')])
        Clique aqui
    @endcomponent
@endcomponent
