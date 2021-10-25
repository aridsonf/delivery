@extends('template.template')

@section('content')

@include('template.header')


<div class="col-8 m-auto">
    @csrf
    
    <h2 class="text-center">Produtos</h2>

    <table class="table table-striped text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Preço</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    @foreach($product as $products)
        <tr>
            <th scope="row">{{$products->id}}</th>
            <td>{{$products->name}}</td>
            <td>R${{$products->value}}</td>
            <td>
                <div class="row">
                    <div class="col">
                        <a href="{{url("crud_products/$products->id")}}">
                            <button class="btn btn-dark">Visualizar</button>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{url("crud_products/$products->id/edit")}}">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                    </div>
                    <div class="col">
                        <form id="formDeleteProduct" name="formDeleteProduct">
                            @csrf
                            <input type="hidden" id="product_id" value="{{$products->id}}">
                            <input class="btn btn-danger" type="submit" name="deleteProduct" id="deleteProduct" value="Deletar">
                        </form>
                    </div>
                </div>
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

<script src="{{url("assets/js/Products/delete_product.js")}}"></script>


@endsection