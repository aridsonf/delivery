@extends('template.template')

@section('content')

@include('template.header')


<div class="col-8 m-auto">
    @csrf
    
    <h2 class="text-center">Produtos</h2>

    <table class="table table-striped text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Preço</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    @foreach($product as $products)
        <tr>
            <td scope="row">{{$products->name}}</td>
            <td>R${{$products->value}}</td>
            <td>   
                <form id="formAddProduct" name="formAddProduct">
                    @csrf
                    <input type="hidden" id="product_id" name="product_id" value="{{$products->id}}">
                    <div class="row">
                        <div class="col">                        
                            <input class="form-control w-50 mx-auto" type="number" id="product_quant" name="product_quant" step="1" value="0">
                        </div>
                        <div class="col">                        
                            <input class="btn btn-success" type="submit" name="addProduct" id="addProduct" value="Adicionar ao carrinho">
                        </div>
                    </div>
                </form>
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
    <a href="{{route("request.shopping")}}">
        <button class="btn btn-info">Visualizar Carrinho</button>
    </a>
</div>  

<script src="{{url("assets/js/Delivery/request_product.js")}}"></script>


@endsection