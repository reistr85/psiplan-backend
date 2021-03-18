@component('mail::message')
    <h1>Olá {{ $data['name'] }} como você está?</h1>
    <p style="text-align: justify">Estamos passando para avisar que seu agendamento foi confirmado com sucesso!</p>
    <p style="text-align: justify">Você pode ter acesso a mais informações, através de seu perfil acessando com o seu login e senha.</p>
    <br><p><b>Dados da consulta:</b></p>
    <p style="text-align: justify">Modalidade de atendimento: {{ $data['type_service'] }}</p>
    @if($data['type_service'] === 'Online')
    <p>Plataforma escolhida: {{ $data['video_platform'] }}</p>
    @endif
    <p style="text-align: justify">Data: {{ $data['date_query'] }}</p>
    <p style="text-align: justify">Hora: {{ $data['hour_query'] }}</p>
    <p style="text-align: justify">Psicólogo(a): {{ $data['psychologist_name'] }}</p>
    <p style="text-align: justify">Fale com o profissional {{ $data['psychologist_contact'] }}</p>
    @if($data['type_service'] === 'Presencial')
    <br><p><b>Endereço de atendimento:</b></p>
    <p style="text-align: justify">UF: {{ $data['state'] }}</p>
    <p style="text-align: justify">Cidade: {{ $data['city'] }}</p>
    <p style="text-align: justify">Bairro: {{ $data['neighborhood'] }}</p>
    <p style="text-align: justify">Endereço: {{ $data['street'] }} {{ $data['number'] }} {{ $data['complement'] }}</p>
    @endif
    <p style="text-align: justify">Informações importante:</p>
    <p style="text-align: justify">Para atendimento PRESENCIAL comparecer ao local de Consulta com 15 minutos de antecedência. E para atendimento ONLINE, estar online na plataforma escolhida 10 minutos antes.</p>
    <p style="text-align: justify">Para seu atendimento ONLINE siga as recomendações:</p>
    <p style="text-align: justify">• Esteja em um local que mantenha a sua privacidade;</p>
    <p style="text-align: justify">• Esteja em um local isento de barulho externo;</p>
    <p style="text-align: justify">• Esteja com uma vestimenta adequada para a consulta;</p>
    <p style="text-align: justify">• Esteja com uma rede wifi de boa qualidade;</p>
    <p style="text-align: justify">• Esteja com fone de ouvido com Microfone;</p>
    <p style="text-align: justify">• Seu dispositivo deve estar posicionado em um local em que sua imagem seja visível ao terapeuta (mostrando rosto e ombro, ângulo foto 3x4)</p>
    <p style="text-align: justify">Seu atraso, em ambas modalidades de consultas, acarreta na REDUÇÃO do seu tempo de atendimento. E o NÃO COMPARECIMENTO, não acarretará nenhum reembolso da consulta, visto que o profissional reservou aquele horário para você ( Favor verificar Política de cancelamento em <a href="https://psiplan.mgetech.com.br/#/termoscliente">"TERMOS DE USO"</a>)</p>
    <p style="text-align: justify">Tenha uma boa Sessão!</p>
    @component('mail::button', ['url' => 'https://psiplan.mgetech.com.br/#/login'])
        Clique aqui
    @endcomponent
@endcomponent
