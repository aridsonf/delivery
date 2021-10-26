@extends('template.template')

@section('content')

@include('template.header')

<h2 class="text-center">Dados do produto </h2>

<div class="col-8 m-auto">
    Id: {{$product->id}}<br>
    Nome: {{$product->name}}<br>
    Descrição: {{$product->description}}<br>
    Preço: {{$product->value}}<br>  
    Quantidade em estoque: {{$product->stock}}<br> 
    
    <div class="mt-3 mb-4">
        <a href="{{url("crud_products/")}}" >
            <button class="btn btn-dark">Voltar</button>
        </a>
    </div>
</div>




@endsection()