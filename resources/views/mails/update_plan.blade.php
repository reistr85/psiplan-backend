@component('mail::message')
    <h1>Olá {{ $data['name'] }}!</h1>
    <br><p>Atenciosamente,</p>
    <p style="text-align: justify">Estamos aqui para lhe informar que seu PLANO FOI ALTERADO, e que esta alteração acarreta em mudanças nas funcionalidades do seu perfil profissional.</p><br>
    <p style="text-align: justify">A cobrança com o valor atualizado, se dará somente após 30 (trinta) dias da data de aquisição do plano vigente, ou seja, a cada alteração é obrigatório manter-se na categoria por um período de 30 (trinta) dias.</p><br>
    <p style="text-align: justify">Em caso de dúvidas solicitamos a leitura do termos de uso Psicólogos, localizado no Rodapé de nosso site.</p><br>
    <p style="text-align: justify">Aproveite o que temos a lhe oferecer e tenha excelentes atendimentos!</p><br>
    <p style="text-align: justify">Time Psiplan</p><br>
    @component('mail::button', ['url' => env('APP_URL')])
        Clique aqui
    @endcomponent
@endcomponent
