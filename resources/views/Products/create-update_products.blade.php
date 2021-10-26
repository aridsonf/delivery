@extends('template.template')

@section('content')

@include('template.header')

<h2 class="text-center">@if(isset($product)) Editar Produto @else Cadastrar Produto @endif</h2>

<div class="col-8 m-auto">
        
    <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBoxSuccess" role="alert"></div>        
    <div class="text-centrer mt-4 mb-4 p-2 alert alert-danger d-none messageBoxError" role="alert"></div>
    

    @if(isset($product))
        <form name="formEditProduct" id="formEditProduct">
        <input type="hidden" id="product_id" value="{{$product->id}}">
        
    @else
        <form name="formCadProduct" id="formCadProduct">
    @endif
        @csrf
        
        <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBox" role="alert">
        </div>
        
        <input class="form-control" type="text" name="name" id="name" placeholder="Nome do produto:" value="{{$product->name ?? ''}}" required><br>
        <input class="form-control" type="text" name="description" id="description" placeholder="Descrição:" value="{{$product->description ?? ''}}" required><br>
        <input class="form-control" type="number" step="0.01" name="value" id="value" placeholder="Preço:" value="{{$product->value ?? ''}}" required><br>
        <input class="btn btn-primary" type="submit" value="@if(isset($product)) Editar @else Cadastrar @endif">          
    </form>
    <div class="mt-3">
        <a href="{{url('crud_products')}}" >
            <button class="btn btn-dark">Voltar</button>
        </a>
        </div>
</div>

<script src="{{url("assets/js/Products/create-update_products.js")}}"></script>

@endsection