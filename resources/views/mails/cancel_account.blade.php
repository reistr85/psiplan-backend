@component('mail::message')
    <h1>Olá {{ $data['name'] }}!</h1>
    <br><p>Atenciosamente,</p>
    <p style="text-align: justify">Equipe Psiplan Brasil</p>
    @component('mail::button', ['url' => env('APP_URL')])
        Clique aqui
    @endcomponent
@endcomponent
