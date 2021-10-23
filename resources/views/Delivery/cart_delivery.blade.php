@extends('template.template')

@section('content')

@include('template.header')

<h2 class="text-center">@if(isset($delivery)) Editar @else Realizar pedido @endif</h2>

<div class="col-8 m-auto">
        
    

    @if(isset($delivery))
        <form name="formEditProduct" id="formEditProduct">
        
    @else
        <form name="formCadProduct" id="formCadProduct">
    @endif
        @csrf
        
        <input type="hidden" id="product_id" value="{{Auth::id()}}">
        <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBox" role="alert">
        </div>
        @foreach($products as $product)
            <div class="row">
                <div class="col-8">
                    <label for="product_quant">Produto: {{$product->name}} - Preço: R${{$product->value}}</label>
                </div>
                <div class="col">
                    <input type="number" id="product_quant" name="product_quant" class="form-control" placeholder="Quantidade">
                </div>
            </div>
        @endforeach
        <br>
        <input class="btn btn-primary" type="submit" value="@if(isset($delivery)) Editar pedido @else Realizar pedido @endif">          
    </form>
    <div class="mt-3">
        <a href="{{route('request.list')}}" >
            <button class="btn btn-dark">Voltar</button>
        </a>
        </div>
</div>

<script src="{{url("assets/js/Products/create-update_products.js")}}"></script>

@endsection