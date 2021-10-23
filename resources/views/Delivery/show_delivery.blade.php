@extends('template.template')

@section('content')

@include('template.header')

<h2 class="text-center">Dados do pedido</h1>

<div class="col-8 m-auto">
    @php
            $user  = $delivery->find($delivery->id)->relUser;
            $itens = $delivery->find($delivery->id)->relRequestData;
    @endphp

    Id: {{$delivery->id}}<br>
    Status: @if ($delivery->status == 1)
                Pedido em andamento
            @elseif ($delivery->status == 2)
                Atendido pelo estabelecimento
            @else 
                Encaminhado para o cliente
            @endif<br>
    Cliente: {{$user->name}}<br>
    Itens: <br>
    @foreach ($itens as $item)
        @php
            $product = $item->find($item->id)->relProduct    
        @endphp
        Nome: {{$product->name}} | Quantidade: {{$item->product_quant}}<br>
    @endforeach
    
    <div class="mt-3 mb-4">
        <a href="{{route("request.list")}}" >
            <button class="btn btn-dark">Voltar</button>
        </a>
    </div>
</div>




@endsection()