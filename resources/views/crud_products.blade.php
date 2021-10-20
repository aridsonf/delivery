@extends('template.template')

@section('content')

@include('template.header')


<div class="col-8 m-auto">
    @csrf
<table class="table table-striped text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($product as $products)
        <tr>
            <th scope="row">{{$products->id}}</th>
            <td>{{$products->name}}</td>
            <td>{{$products->value}}</td>
            <td>
                <a href="{{url("crud_products/$products->id")}}">
                    <button class="btn btn-dark">Visualizar</button>
                </a>
                <a href="{{url("crud_products/$products->id/edit")}}">
                    <button class="btn btn-primary">Editar</button>
                </a>
                <a href="{{url("crud_products/$products->id")}}" class="js-del">
                    <button class="btn btn-danger" name="deleteProduct" id="deleteProduct">Deletar</button>
                </a>
            </td>
        </tr>   

    @endforeach
    
  </tbody>
</table>
    <div class="d-flex justify-content-center">
       {{$product->links("pagination::bootstrap-4")}}
    </div> 
</div>

<div class="text-center mt-3 mb-4">
    <a href="{{url('crud_products/create')}}">
        <button class="btn btn-success">Cadastrar</button>
    </a>
</div> 

<script src="{{url("assets/js/delete_product.js")}}"></script>


@endsection