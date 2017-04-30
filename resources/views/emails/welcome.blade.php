@component('mail::message')
# Introduction

Thanks for registration, {{ $user->name }}!

@component('mail::button', ['url' => 'https://laravel.com/docs'])
Start learning
@endcomponent

@component('mail::panel', ['url' => ''])
Some inspirational quote to go here !
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
