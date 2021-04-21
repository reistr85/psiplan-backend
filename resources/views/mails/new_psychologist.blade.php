@component('mail::message')
    <h1>Olá Psicólogo(a) {{ $user['name'] }}!</h1>
    <p style="text-align: justify">Seja bem vindo(a)!   Preparado(a) para fazer parte da plataforma de gestão Psiplan Brasil?  </p>
    <p style="text-align: justify">Para que você se familiarize com a nossa plataforma, vamos lhe oferecer 7 dias de experiência, sem custos, para ajudar na gestão dos seus atendimentos, sejam eles presenciais ou online.</p>
    <p style="text-align: justify">  A partir de agora, além de economizar tempo, você não vai perder mais nenhum paciente!   Com o seu perfil profissional exclusivo em nossa plataforma, as pessoas que navegarem em nosso site na busca de profissionais poderão visualizar seu perfil e se tornarem futuros pacientes. </p>
    <p style="text-align: justify">O sucesso de um perfil em nossa plataforma vai de uma boa descrição sobre você, inserção de vídeos e fotos, e alguns benefícios que você poderá proporcionar aos seu futuro cliente, na configuração de seu painel.</p>
    <br />
    <p style="text-align: justify; font-weight: bold">Tutorial completo de acesso à Plataforma Psiplan. <a href="https://psiplan.s3-sa-east-1.amazonaws.com/documents/PSIPLAN.pdf" target="_blank">Clique aqui</a></p>
    <p>Vamos começar? </p>
    <p>Aperte o botão abaixo, preencha o seu perfil e deixe o resto com a gente! </p>
    @component('mail::button', ['url' => env('APP_URL')])
        Clique aqui
    @endcomponent
@endcomponent
