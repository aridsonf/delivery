@extends('template.template')

@section('content')

@include('template.header')


<div class="col-8 m-auto">
    @csrf
    
    <h2 class="text-center">Produtos</h2>

    <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBoxSuccess" role="alert"></div>        
    <div class="text-centrer mt-4 mb-4 p-2 alert alert-danger d-none messageBoxError" role="alert"></div>

    <table class="table table-striped text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Preço</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>

        @if (isset($delivery))
            @php   
                $user  = $delivery->relUser;
                $itens = $delivery->relRequestData;
            @endphp
            @foreach($itens as $item)
                @php
                    $products = $item->find($item->id)->relProduct    
                @endphp
                <tr>
                    <td scope="row">{{$products->name}}</td>
                    <td>R${{$products->value}}</td>
                    <td>   
                        <form id="formAttRequestData" name="formAttRequestData">
                            @csrf
                            <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}">
                            <div class="row">
                                <div class="col">                        
                                    <input class="form-control w-50 mx-auto" type="number" id="product_quant" name="product_quant" step="1" value="{{$item->product_quant}}">
                                </div>
                                <div class="col">                        
                                    <input class="btn btn-success" type="submit" name="attProduct" id="attProduct" value="Atualizar produto">
                                </div>
                            </div>
                        </form>
                        <form id="formDelRequestData" name="formDelRequestData">
                            @csrf
                            <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}">
                            <input type="hidden" id="product_name" name="product_name" value="{{$products->name}}">
                            <input class="btn btn-danger" type="submit" name="delProduct" id="delproduct" value="Excluir produto">
                        </form>    
                    </td>
                </tr>   
            @endforeach
        @else
            @foreach($product as $products)
                <tr>
                    <td scope="row">{{$products->name}}</td>
                    <td>R${{$products->value}}</td>
                    <td>   
                        <form id="formAddRequestData" name="formAddRequestData">
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
        @endif
        
    
  </tbody>
</table>
    @if(isset($delivery))
    @else
        <div class="d-flex justify-content-center">
            {{$product->links("pagination::bootstrap-4")}}
        </div> 
    @endif
</div>

<div class="text-center mt-3 mb-4">
    <a href="{{route("request.show")}}">
        <button class="btn btn-info">Ver carrinho</button>
    </a>
</div>  

<script src="{{url("assets/js/Delivery/request_product.js")}}"></script>


@endsection