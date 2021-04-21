@component('mail::message')
    <h1>Olá {{ $data['psychologist_name'] }}!</h1>
    <p style="text-align: justify">Lembramos que esta experiência oferecida ao cliente não trata-se de uma consulta terapêutica tradicional, e sim um contato mais próximo de seu futuro paciente.</p>
    <br><p style="text-align: justify">É a oportunidade que você terá de falar como funciona o seu trabalho, assim como escutar a demanda que o cliente traz. Esse primeiro contato é fundamental para que seu futuro paciente tenha segurança de querer contratar seus serviços em psicoterapia. Aproveite esse momento!</p>
    <br><p style="text-align: justify">Seu futuro paciente terá, a partir do horário de chegada deste e-mail, até 48 horas para receber seu comunicado via WhatsApp confirmando a data e o horário em que você realizará esse encontro, podendo ser presencial (Consultório) ou Online (Vídeo conferência). Caso não tenha a disponibilidade de horário, não hesite em mantê-lo informado de sua indisponibilidade. </p>
    <br><p style="text-align: justify">Abaixo seguem os dados da solicitação e tenham excelentes consultas!</p>
    <br><p><b>Dados do Paciente:</b></p>
    <p style="text-align: justify">Nome: {{ $data['client_name'] }}</p>
    <p style="text-align: justify">E-mail: {{ $data['client_email'] }}</p>
    <p style="text-align: justify">Contato: {{ $data['client_phone'] }}</p>
    <br><p>Atenciosamente,</p>
    <p style="text-align: justify">Equipe Psiplan Brasil</p>
    @component('mail::button', ['url' => env('APP_URL')])
        Clique aqui
    @endcomponent
@endcomponent
