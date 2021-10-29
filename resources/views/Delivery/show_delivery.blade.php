@extends('template.template')

@section('content')

@include('template.header')

<h2 class="text-center">Dados do pedido</h1>

<div class="col-8 m-auto">
    @php
            $user  = $delivery->find($delivery->id)->relUser;
            $itens = $delivery->find($delivery->id)->relRequestData;
    @endphp
    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary btn-sm" href="{{url("/create_delivery_pdf/$delivery->id")}}">Criar PDF da página</a>
    </div>
    Id: {{$delivery->id}}<br>
    Status: @if ($delivery->status == 1)
                Pedido aguardando confirmação
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
        Nome: {{$product->name}} | Quantidade: {{$item->product_quant}}@if($delivery->status == 1) | Quantidade atualmente a ser atendida: {{$item->product_quant_delivered}}<br> @elseif($delivery->status > 1)  | Quantidade atendida: {{$item->product_quant_delivered}}<br> @endif
    @endforeach
    
      
    <div class="mt-3 mb-4 row">

        @if ($delivery->status == 0)
            <div class='col-sm'>
                <a href="{{route("request.shopping")}}" >
                    <button class="btn btn-dark">Adicionar produtos</button>
                </a>
            </div>
            <div class='col-sm'>
                <a href="{{url("/edit_request/$user->id")}}">
                    <button class="btn btn-primary">Atualizar pedido</button>
                </a>
            </div>
            <div class='col-sm'>
                 <form id="formCreateDelivery" name="formCreateDelivery">
                    @csrf  
                    <input class="btn btn-success" type="submit" name="createDelivery" id="createDelivery" value="Confirmar pedido">
                </form>  
            </div>
        @else
            <div class='col-sm'>
                <a href="{{route("request.list")}}" >
                    <button class="btn btn-dark">Voltar</button>
                </a>
            </div>
            @if (Auth::user()->access_lvl == 2 && $delivery->status <= 1)
                <div class='col-sm'>
                    <a href="{{url("/edit_request/$delivery->id")}}">
                       <button class="btn btn-primary">Escolher quantidade</button>
                    </a>
                </div>
                <div class='col-sm'>
                    <form name="attDeliveryRequest" id="attDeliveryRequest">
                        @csrf
                        <input type="hidden" id="delivery_id" value="{{$delivery->id}}">
                        <input type="submit" class="btn btn-success" value="Aceitar pedido">
                    </form>
                </div>
            @endif
            @if (Auth::user()->access_lvl == 2 && $delivery->status == 2)
                <div class='col-sm'>
                    <form name="attDeliveryRequest" id="attDeliveryRequest">
                        @csrf
                        <input type="hidden" id="delivery_id" value="{{$delivery->id}}">
                        <input type="submit" class="btn btn-success" value="Enviar pedido">
                    </form>
                </div>
            @endif
            @if(((Auth::user()->access_lvl) == 2 && ($delivery->status <= 2)) || ((Auth::user()->access_lvl == 1) && ($delivery->status <= 1)))
                <div class='col-sm'>
                    <form name="delDeliveryRequest" id="delDeliveryRequest">
                        @csrf
                        <input type="hidden" id="delivery_client_name" value="{{$user->name}}">
                        <input type="hidden" id="delivery_id" value="{{$delivery->id}}">
                        <input type="submit" class="btn btn-danger" value="Cancelar pedido">
                    </form>
                </div>  
            @endif
        @endif
        
    </div>

    <div class="text-centrer mt-4 mb-4 p-2 alert alert-success d-none messageBoxSuccess" role="alert"></div>      
    <div class="text-centrer mt-4 mb-4 p-2 alert alert-danger d-none messageBoxError" role="alert"></div>
</div>

<script src="{{url("assets/js/Delivery/request_delivery.js")}}"></script>
<script src="{{url("assets/js/Delivery/create_delivery.js")}}"></script>


@endsection()