@extends('template.template')

@section('content')

@include('template.header')


<div class="col-8 m-auto">
    @csrf
    
    <h2 class="text-center">Pedidos</h2>

    <table class="table table-striped text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Situação</th>
      <th scope="col">Cliente</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    @foreach($deliverys as $delivery)
        @if (!$delivery->status==0)  
            @php
                $user = $delivery->find($delivery->id)->relUser
            @endphp
            <tr>
                <th scope="row">{{$delivery->id}}</th>
                <td>@if ($delivery->status == 1)
                        Pedido aguardando confirmação
                    @elseif ($delivery->status == 2)
                        Atendido pelo estabelecimento
                    @else 
                        Encaminhado para o cliente
                    @endif
                </td>
                <td>{{$user->name}}</td>
                <td>
                    <a href="{{url("show_request/$delivery->id")}}">
                        <button class="btn btn-dark">Verificar pedido</button>
                    </a>
                    @if ((Auth::user()->access_lvl == 2 && $delivery->status <= 2) || (Auth::user()->access_lvl == 1 && $delivery->status == 1))
                        <form id="delDeliveryRequest" name="delDeliveryRequest">
                            @csrf
                            <input type="hidden" id="delivery_id" value="{{$delivery->id}}">
                            <input type="hidden" id="delivery_client_name" value="{{$user->name}}">
                            <input class="btn btn-danger" type="submit" name="deleteProduct" id="deleteProduct" value="Cancelar pedido">
                        </form>
                    @endif
                </td>
            </tr>   
        @endif
    @endforeach
    
  </tbody>
</table>
    {{-- <div class="d-flex justify-content-center">
       {{$deliverys->links("pagination::bootstrap-4")}}
    </div>  --}}
</div>
@if (Auth::user()->access_lvl == 1)
    <div class="text-center mt-3 mb-4">
        <a href="{{route("request.shopping")}}">
            <button class="btn btn-success">@if(isset($cart)) Ver carrinho @else Realizar pedido @endif</button>
        </a>
    </div>  
@endif

{{-- <script src="{{url("assets/js/Products/delete_product.js")}}"></script> --}}
<script src="{{url("assets/js/Delivery/request_delivery.js")}}"></script>



@endsection