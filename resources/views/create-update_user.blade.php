@extends('template.template')

@section('content')

@include('template.header')

<h2 class="text-center mb-3">@if(isset($user)) Editar @else Cadastrar @endif</h2> 

<div class="col-8 m-auto">
        
    

    @if(isset($user))
        <form name="formEditUser" id="formEditUser">
        <input type="hidden" id="user_id" value="{{$user->id}}">
        
    @else
        <form name="formCadUser" id="formCadUser">
    @endif
        @csrf

        <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBoxSuccess" role="alert">
        </div>
            
        <div class="text-centrer mt-4 mb-4 p-2 alert alert-danger d-none messageBoxError" role="alert">
        </div>

        
        <input class="form-control" type="text" name="name" id="name" placeholder="Nome:" value="{{$user->name ?? ''}}" required><br>
        <input class="form-control" type="text" name="email" id="email" placeholder="E-mail:" value="{{$user->email ?? ''}}" required><br>
        <input class="form-control" type="date" name="birth_date" id="birth_date" placeholder="Data de nascimento:" value="{{$user->birth_date ?? ''}}" required><br>
        <select class="form-select" aria-label="Default select example" id="access_lvl"  name="access_lvl">
                    @if (isset($user))
                        <option value="{{$user->access_lvl ?? ''}}" selected>
                            @if ($user->access_lvl == 1)
                                Cliente
                            @else
                                Funcionário
                            @endif
                        </option>
                        <option value="1">Cliente</option>
                        <option value="2">Funcionário</option>
                    @else
                        <option value="{{$user->name ?? ''}}" selected>Selecione um tipo de usuário</option>
                        <option value="1">Cliente</option>
                        <option value="2">Funcionário</option>
                    @endif
                    
        </select><br>
        @if (isset($user))
            <input class="form-control" type="password" name="password" id="password" placeholder="Nova senha:" value="" @if (isset($user)) @else required @endif><br>
            <div class="alert alert-info" role="alert">
                Para a criação de nova senha insira na caixa acima. Caso não deseje uma nova senha não, deixe em branco!
            </div>
        @else
            <input class="form-control" type="password" name="password" id="password" placeholder="Senha:" value="" required><br> 
        @endif
        <input class="btn btn-primary" type="submit" value="@if(isset($user)) Editar @else Cadastrar @endif">          
    </form>
    <div class="mt-3">
        <a href="{{url('list_users')}}" >
            <button class="btn btn-dark">Voltar</button>
        </a>
        </div>
</div>

<script src="{{url("assets/js/Users/create-update_users.js")}}"></script>

@endsection