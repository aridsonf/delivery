@extends('template.template')

@section('content')

@include('template.header')

<h2 class="text-center">Dados</h2>

<div class="col-8 m-auto">

    Id: {{Auth::id()}}<br>
    Nome: {{Auth::user()->name}}<br>
    E-mail: {{Auth::user()->email}}<br>   
    Data de nascimento: {{Auth::user()->birth_date}}<br>
    @if (Auth::user()->access_lvl == 1)
        Tipo de usuário: Cliente
    @else
        Tipo de usuário: Funcionário
    @endif
    
    <div class="mt-3 mb-4">
        <a href="{{route("dashboard")}}" >
            <button class="btn btn-dark">Início</button>
        </a>
    </div>
</div>




@endsection()