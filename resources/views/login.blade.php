@extends('template.template')

@section('content')

<div class="col-8 m-auto mt-3">

    <h1 class="mb-3 fw-normal text-center">DELIVERY</h1>
    <h3 class="mb-3 fw-normal text-center">Entrar no sistema</h3>


    <form class="form-signin" name="formLogin" id="formLogin">
        @csrf
        
        <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBoxSuccess" role="alert">
        </div>

        <div class="text-centrer mt-4 mb-4 p-2 alert alert-danger d-none messageBoxError" role="alert">
        </div>
        
        <div class="form-floating mb-2">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            <label for="email">E-mail</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Senha</label>
        </div><br>

        <input class="btn btn btn-primary" type="submit" value="Entrar">          
    </form>

</div>

<script src="{{url("assets/js/Users/login.js")}}"></script>


@endsection