<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (session()->has('status'))
    <p> <strong>{{ session('status') }}</strong></p>
    @endif
    <h1>Your Email is not verified</h1>
</body>
</html>