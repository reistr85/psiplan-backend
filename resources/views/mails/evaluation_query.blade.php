@component('mail::message')
    <h1>Olá {{ $data['name'] }}!</h1>
    <br><p>Atenciosamente,</p>
    <p style="text-align: justify">Gostaria de agradecer pela confiança e espero vê-lo(a) em breve!</p><br>
    <p style="text-align: justify">A sua avaliação é muito importante para o meu desenvolvimento profissional, e para fazer isso é muito simples:</p><br>
    <p style="text-align: justify">Acesse o seu perfil, clique em AVALIAR e pronto! Ou pode fazer por aqui mesmo, basta clicar neste ícone abaixo.</p><br>
    @component('mail::button', ['url' => env('APP_URL').'/#/login'])
        Avaliar
    @endcomponent
@endcomponent
