<x-mail::message>
Hi, {{$user['name']}}
It I Notify To You That SomeOne Visit Your Profile.
For more information visit our website.

<x-mail::button :url="$url">
Visit Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
