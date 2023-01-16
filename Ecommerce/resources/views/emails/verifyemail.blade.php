<x-mail::message>

<x-mail::panel>
Email Verifivation
</x-mail::panel>

<x-mail::table>
|      Name         |      Email       |
|------------------ |------------------| 
|<p><b>{{ $user['name'] }}</b></p>| <p><b>{{$user['email']}}</b></p>|
</x-mail::table>

Click Here  To Verify Your Email Address: 
<a href="{{ url('api/register/verify',  $user['remember_token']) }}">Verify Email</a>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>