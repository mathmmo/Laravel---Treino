@extends('templates.master')

@section('content')
    <body>
        <div class="dashboard">
            <div class="content">
                <div class="title m-b-md">
                    Bem vindo {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </body>
</html>
@endsection