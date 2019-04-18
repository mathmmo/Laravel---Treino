<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reembolso | Login</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/stylesheet.css')}}"> 
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">

    </head>
    <body>
        <div class="background"></div>
        <section id="view-content" class="login">
            <h1>Reembolsapp</h1>
            <h3>Nosso gerenciador de reembolsos</h3>

            {!! Form::open(['route'=>'login', 'method'=>'post']) !!}
            {{ csrf_field() }}
            <p>Realize o login</p>

            <label>
                {!! Form::text('username', null, ['class'=>'input', 'placeholder' => 'Usuário']) !!}
            </label>

            <label>
            {!! Form::password('password', [ 'placeholder' => 'Senha']) !!}
            </label>

            {!! Form::submit('Entrar',['class'=>'btn']) !!}

            {!! Form::close() !!}
        </section>
    </body>
</html>
