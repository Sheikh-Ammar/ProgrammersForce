<x-mail::message>
<h1>This Is Test Email</h1>
<p><b>Name: </b></p> <h3>{{$user['name']}}</h3>
&nbsp; 
<p><b>Email: </b></p> <h3>{{$user['email']}}</h3>

<x-mail::panel>
This is the panel content.
</x-mail::panel>

<x-mail::table>
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
</x-mail::table>

<x-mail::button :url="$url" color="success">
Home
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}---{{ "SAA | CORPORATION | 2022 " }}
</x-mail::message>
