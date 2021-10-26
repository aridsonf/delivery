<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    ModelDeliveryRequests,
    ModelRequestsData,
    ModelProducts,
    User
};

class DeliveryController extends Controller
{
    private $objDelivery;
    private $objUser;
    private $objProduct;
    private $objRequestData;

    public function __construct()
    {
        $this->objDelivery = new ModelDeliveryRequests;
        $this->objProduct = new ModelProducts;
        $this->objUser = new User;
        $this->objRequestData = new ModelRequestsData;
    }

    public function index()
    {
        if (Auth::user()->access_lvl == 1) {
            $deliverys = $this->objDelivery->where('user_id', Auth::id())->get();
        } else {
            $deliverys = $this->objDelivery->all();
        }

        $cart = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();
        if ($cart) {
            return view('Delivery.crud_delivery', compact('deliverys', 'cart'));
        } else {
            return view('Delivery.crud_delivery', compact('deliverys'));
        }
    }

    public function shopping()
    {
        $cart = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();
        if ($cart) {
        } else {
            ModelDeliveryRequests::create([
                'status' => 0,
                'user_id' => Auth::id(),
                'delivery_date' => '0000-00-00'
            ]);
        }
        $product = $this->objProduct->paginate(5);
        return view('Delivery.shopping_delivery', compact('product'));
    }

    public function editShopping($id)
    {
        if (Auth::user()->access_lvl == 1) {
            $delivery = $this->objDelivery->where('status', 0)->where('user_id', $id)->first();
        } else {
            $delivery = $this->objDelivery->find($id);
        }

        return view('Delivery.shopping_delivery', compact('delivery'));
    }

    public function createDeliveryData()
    {
        $products = $this->objProduct->all();
        return view('Delivery.create-update_delivery', compact('products'));
    }

    public function storeDelivery()
    {
        try {
            $cart = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();

            $cart->update([
                'status' => 1,
                //'delivery_date' => date('Y-m-d H:i:s')
            ]);

            return
                ['stts' => 1, 'msg' => 'Pedido realizada com sucesso!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }

    public function storeRequestData(Request $request)
    {
        try {
            $cart = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();
            ModelRequestsData::create([
                'delivery_id' => $cart->id,
                'product_id' => (int) $request->product_id,
                'product_quant' => $request->product_quant,
                'product_quant_delivered' => 0
            ]);

            return ['stts' => 1, 'msg' => 'Produto adicionado ao carrinho'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }

    public function showDeliverys($id)
    {
        $delivery = $this->objDelivery->find($id);
        $requests = $this->objRequestData->all();

        return view('Delivery.show_delivery', compact('delivery', 'requests'));
    }

    public function showUserDelivery()
    {
        $delivery = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();
        $requests = $this->objRequestData->all();

        return view('Delivery.show_delivery', compact('delivery', 'requests'));
    }

    public function updateRequestData(Request $request, $id)
    {
        try {
            $requestdata = $this->objRequestData->find($id);
            $requestdata->update([
                'product_quant' => $request->product_quant
            ]);

            return ['stts' => 1, 'msg' => 'Produto atualizado!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }

    public function updateRequestDataDelivered(Request $request, $id)
    {
        try {
            $requestdata = $this->objRequestData->find($id);
            $product = $requestdata->relProduct;

            $requestdataval = Validator::make(
                $request->all(),
                ['product_quant_delivered' => ['required', 'numeric', 'min:0', 'max:' . $requestdata->product_quant]]
            );

            if ($requestdataval->fails()) {
                return ['stts' => 0, 'msg' => "Quantidade atendida de " . $product->name . " tem que ser maior ou igual que 0, e menor ou igual que " . $requestdata->product_quant . "!"];
            }
            //return dd($requestdataval);
            $requestdata->update([
                'product_quant_delivered' => $request->product_quant_delivered
            ]);

            return ['stts' => 1, 'msg' => 'Produto atualizado com quantidade atendida de ' . $request->product_quant_delivered . '!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }

    public function updateDeliveryStatus($id)
    {
        try {
            $cart = $this->objDelivery->find($id);

            if ($cart->status == 1) {
                $cart->update([
                    'status' => 2,
                ]);

                return ['stts' => 1, 'msg' => 'Situação atualizada com sucesso!'];
            } else {
                $cart->update([
                    'status' => 3,
                    'delivery_date' => date('Y-m-d H:i:s')
                ]);

                return ['stts' => 1, 'msg' => 'Produto encaminhado!'];
            }
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }

    public function destroyRequestData($id)
    {
        try {
            $this->objRequestData->destroy($id);
            return ['stts' => 1, 'msg' => 'Usuário deletado com sucesso!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }

    public function destroyDelivery($id)
    {
        try {
            $delivery = $this->objDelivery->find($id);
            $datas = $delivery->relRequestData;
            foreach ($datas as $data) {
                $data->destroy($data->id);
            }
            $delivery->destroy($delivery->id);

            return ['stts' => 1, 'msg' => 'Usuário deletado com sucesso!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }
}
