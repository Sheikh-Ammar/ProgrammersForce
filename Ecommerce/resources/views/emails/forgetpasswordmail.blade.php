<x-mail::message>

<x-mail::panel>
Foregt Password Reset
</x-mail::panel>

{{ $token }}

Click Here  To Reset Your Password: 
<a href="{{ url('api/reset-forget-password', $token) }}">Reset Password</a>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
