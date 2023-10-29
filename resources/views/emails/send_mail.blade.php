@component('mail::message')
    Hello {{ $user->name }},

    {!! $user->send_message !!}

    Thanks, 
    {{ config('app.name') }}
@endcomponent