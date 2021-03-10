@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
    <img src="https://psiplan.mgetech.com.br/dist/img/Logo-2.934fbbd1.png" alt="">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
    Por favor não responda esse e-mail, ele é gerado automaticamente.<br>© {{ date('Y') }} {{ config('app.name') }}. - A tecnologia a favor da sua saúde. <br>@lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
