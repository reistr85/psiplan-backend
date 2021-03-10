@component('mail::message')
    <h1>Olá Psicólogo(a) {{ $data['name'] }} como você está?</h1>
    <p>Uma consulta foi confirmada com sucesso!</p>
    <p>Você pode ter acesso a mais informações, através de seu perfil acessando a sua área de GESTÃO.</p>
    <br><p><b>Dados da consulta:</b></p>
    <p>Modalidade de atendimento: {{ $data['type_service'] }}</p>
    @if($data['type_service'] === 'Online')
    <p>Plataforma escolhida: {{ $data['video_platform'] }}</p>
    @endif
    <p>Data: {{ $data['date_query'] }}</p>
    <p>Hora: {{ $data['hour_query'] }}</p>
    <p>Cliente: {{ $data['client_name'] }}</p>
    <p>Fale com o cliente {{ $data['client_contact'] }}</p>
    @if($data['type_service'] === 'Presencial')
    <br><p><b>Endereço de atendimento:</b></p>
    <p>UF: {{ $data['state'] }}</p>
    <p>Cidade: {{ $data['city'] }}</p>
    <p>Bairro: {{ $data['neighborhood'] }}</p>
    <p>Endereço: {{ $data['street'] }} {{ $data['number'] }} {{ $data['complement'] }}</p>
    @endif
    <p>Informações importante:</p>
    <p>Para atendimento PRESENCIAL comparecer ao local de Consulta com 15 minutos de antecedência. E para atendimento ONLINE, estar online na plataforma escolhida 10 minutos antes.</p>
    <p>Para seu atendimento ONLINE siga as recomendações:</p>
    <p>• Esteja em um local que mantenha a sua privacidade;</p>
    <p>• Esteja em um local isento de barulho externo;</p>
    <p>• Esteja com uma vestimenta adequada para a consulta;</p>
    <p>• Esteja com uma rede wifi de boa qualidade;</p>
    <p>• Esteja com fone de ouvido com Microfone;</p>
    <p>• Seu dispositivo deve estar posicionado em um local em que sua imagem seja visível ao terapeuta (mostrando rosto e ombro, ângulo foto 3x4)</p>
    <p>Seu atraso, em ambas modalidades de consultas, acarreta na REDUÇÃO do seu tempo de atendimento. E o NÃO COMPARECIMENTO, não acarretará nenhum reembolso da consulta, visto que o profissional reservou aquele horário para você ( Favor verificar Política de cancelamento em <a href="https://psiplan.mgetech.com.br/#/termosespecialistas">"TERMOS DE USO"</a>)</p>
    <p>Tenha uma boa Sessão!</p>
    @component('mail::button', ['url' => 'https://psiplan.mgetech.com.br/#/login'])
        Clique aqui
    @endcomponent
@endcomponent
