@component('mail::message')
    <h1>Olá {{ $user['name'] }}!</h1>
    <p>Seja bem vindo(a)!   </p>
    <p></p>
    <br />
    <p>Vamos começar? </p>
    <p>Aperte o botão abaixo, preencha o seu perfil e deixe o resto com a gente! </p>
    @component('mail::button', ['url' => 'https://psiplan.mgetech.com.br'])
        Clique aqui
    @endcomponent
@endcomponent
