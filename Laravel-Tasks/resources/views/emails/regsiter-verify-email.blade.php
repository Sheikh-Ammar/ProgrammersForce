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
<a href="{{ url('api/register/verify',  $verify['token']) }}">Verify Email</a>

In case If Click Button Not Work Copy Given Below Link:
<a href={{$url}}{{ $verify['token'] }}>{{$url}}{{ $verify['token'] }}</a>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
