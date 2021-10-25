<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->access_lvl == 1) {
            $deliverys = $this->objDelivery->where('user_id', Auth::id())->paginate(5);
        } else {
            $deliverys = $this->objDelivery->paginate(5);
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

    public function editShopping()
    {
        $delivery = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();
        return view('Delivery.shopping_delivery', compact('delivery'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDeliveryData()
    {
        $products = $this->objProduct->all();
        return view('Delivery.create-update_delivery', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDelivery()
    {
        $cart = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();

        $cart->update([
            'status' => 1,
            'delivery_date' => date('Y-m-d H:i:s')
        ]);

        return
            ['stts' => 1, 'msg' => 'Atualização realizada com sucesso!'];
    }

    public function storeRequestData(Request $request)
    {
        $cart = $this->objDelivery->where('status', 0)->where('user_id', Auth::id())->first();
        ModelRequestsData::create([
            'delivery_id' => $cart->id,
            'product_id' => (int) $request->product_id,
            'product_quant' => $request->product_quant
        ]);

        return ['stts' => 1, 'msg' => 'Produto adicionado ao carrinho'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $requestdata = $this->objRequestData->find($id);
        $requestdata->update([
            'product_quant' => $request->product_quant
        ]);

        return ['stts' => 1, 'msg' => 'Produto atualizado!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRequestData($id)
    {
        try {
            $this->objRequestData->destroy($id);
            return ['stts' => 1, 'msg' => 'Usuário deletado com sucesso!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }
}
