@component('mail::message')
    <h1>Olá {{ $data['psychologist_name'] }}!</h1>
    <p>A experiência de primeira é um benefício que o profissional oferece à você, através de nossa plataforma, para conhecer o Psicólogo(a) em que deseja ser atendido, facilitando a sua tomada de decisão na contratação do serviço.</p>
    <p>Deixamos claro que esta  EXPERIÊNCIA DE PRIMEIRA ela não se enquadra em consulta de caráter TERAPÊUTICO, e sim uma anamnese (entrevista realizada pelo profissional) para saber um pouco sobre você.</p>
    <p>Ao realizar a solicitação, em até 48 horas, o profissional entrará em contato para confirmação de data e horário. Esse atendimento poderá ser Online ou Presencial, ficando a critério do(a) Psicólogo(a).</p>
    <p>O contato acontecerá por Telefone ou E-mail, portanto fique atento!</p>
    <br><p><b>Dados do Paciente:</b></p>
    <p>Nome: {{ $data['client_name'] }}</p>
    <p>E-mail: {{ $data['client_email'] }}</p>
    <p>Contato: {{ $data['client_phone'] }}</p>
    <br><p>Atenciosamente,</p>
    <p>Equipe Psiplan Brasil</p>
    @component('mail::button', ['url' => 'https://psiplan.mgetech.com.br/#/'])
        Clique aqui
    @endcomponent
@endcomponent
