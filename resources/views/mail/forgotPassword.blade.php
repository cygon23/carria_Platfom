<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Passowrd Email</title>
</head>

<body>
    <h1>Hellow {{ $mailData['user']->name }}</h1>
    <p> Click below to change password.</p>

    <a href="{{ route('password-reset.email', $mailData['token']) }}">Reset password</a>

    <p>Thanks..</p>
</body>

</html>
