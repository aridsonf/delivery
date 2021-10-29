<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="col-8 m-auto">
    @php
            $user  = $delivery->find($delivery->id)->relUser;
            $itens = $delivery->find($delivery->id)->relRequestData;
    @endphp
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
</div>
</body>
</html>