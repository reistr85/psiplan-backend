@component('mail::message')
    <h1>Olá {{ $data['name'] }}!</h1>
    <br><p>Atenciosamente,</p>
    <p style="text-align: justify">Você acabou de realizar o pagamento PACOTE DE CONSULTAS, mais um benefício que o seu Psicólogo(a) oferece á você: Descontos de até 15% na compra de 4 consultas.</p><br>
    <p style="text-align: justify">E como você é importante para nós, saiba que estamos sempre lhe acompanhando. Vimos também que a sua primeira consulta encontra-se confirmada!</p><br>
    <p style="text-align: justify">Diante isso, queremos informar que você possui outros 3 (três) cupons que servirão como modalidade de pagamento em seus próximos atendimentos, que deverão serem utilizados em até 30 (trinta) dias a partir da PRIMEIRA CONSULTA, com o mesmo PROFISSIONAL, não sendo permitido o endosso a outro.</p><br>
    <p style="text-align: justify">Em caso da NÃO utilização dos cupons, ao solicitar reembolso serão cobradas taxas da transação.</p><br>
    <p style="text-align: justify">Em caso da NÃO utilização dos cupons, ao solicitar reembolso serão cobradas taxas da transação.</p><br>
    <p style="text-align: justify">NÃO FICA PERMITIDO usar o cupom como CRÉDITO para consultas com outros profissionais.</p><br>
    <p style="text-align: justify">Tenha acesso aos seus cupons em seu portal. Basta acessar com o seu login!</p><br>
    <p style="text-align: justify">Tenha excelentes atendimentos!</p><br>
    <p style="text-align: justify">Time Psiplan</p><br>
    @component('mail::button', ['url' => env('APP_URL')])
        Clique aqui
    @endcomponent
@endcomponent
