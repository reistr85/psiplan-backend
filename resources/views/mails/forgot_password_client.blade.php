@component('mail::message')
    <h1>RECUPERAR A SUA SENHA É FÁCIL!</h1>
    <p style="text-align: justify">Basta clicar no link abaixo e seguir as instruções na página.</p>
    @component('mail::button', ['url' => $data['url']])
        Redefinir minha senha
    @endcomponent
@endcomponent
