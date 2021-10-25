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
    
      
    <div class="mt-3 mb-4 row">
        <div class='col-sm'>
            <a href="{{route("request.shopping")}}" >
                <button class="btn btn-dark">Adicionar produtos</button>
            </a>
        </div>
        {{-- <a href="{{route("request.shopping.update")}}" > --}}
        <div class='col-sm'>
            <a href="{{route("request.shopping.edit")}}">
                <button class="btn btn-primary">Atualizar pedido</button>
            </a>
        </div>
        @if ($delivery->status == 0)
            <div class='col-sm'>
                 <form id="formCreateDelivery" name="formCreateDelivery">
                    @csrf  
                    <input class="btn btn-success" type="submit" name="createDelivery" id="createDelivery" value="Confirmar pedido">
                </form>  
            </div>
        @endif
        
    </div>

    <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBoxSuccess" role="alert"></div>
            
    <div class="text-centrer mt-4 mb-4 p-2 alert alert-danger d-none messageBoxError" role="alert"></div>
</div>


<script src="{{url("assets/js/Delivery/create_delivery.js")}}"></script>

@endsection()