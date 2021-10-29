@extends('template.template')

@section('content')

@include('template.header')


<div class="col-8 m-auto">
    @csrf
<h2 class="text-center">Usuários</h2>
<table class="table table-striped text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Tipo de usuário</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td> @if ($user->access_lvl == 1) Cliente @else Funcionário @endif </td>
            <td>
                <div class="row">
                    <div class="col">
                        <a href="{{url("/edit_user/$user->id")}}">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                    </div>
                    <div class="col">
                        @if (Auth::id() == $user->id)
                        @else
                        <form id="formDeleteUser" name="formDeleteUser">
                            @csrf
                            <input type="hidden" id="user_id" value="{{$user->id}}">
                            <input class="btn btn-danger" type="submit" name="deleteUser" id="deleteUser" value="Deletar">
                        </form>
                        @endif
                    </div>
                </div>
            </td>
        </tr>   
    @endforeach
    
  </tbody>
</table>
    <div class="d-flex justify-content-center">
       {{$users->links("pagination::bootstrap-4")}}
    </div> 
</div>

<div class="text-center mt-3 mb-4">
    <a href="{{route("user.create")}}">
        <button class="btn btn-success">Cadastrar</button>
    </a>
</div> 

<script src="{{url("assets/js/Users/delete_users.js")}}"></script>

@endsection