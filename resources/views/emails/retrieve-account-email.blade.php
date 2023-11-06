@component('mail::message')
{{-- Greeting --}}
<h2 class="font-bold" style="font-size: 1.25rem">@lang('Hello!')</h2>


<p>
    You are receiving this email because we received a retrieve account request.
</p>

<p>
    The email address for your account is <b>{{ $user->email }}</b>
</p>

<p>
    If you did not request a retieve account link, no further action is required.
</p>

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif

@endcomponent
