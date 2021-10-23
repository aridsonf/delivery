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

        return view('Delivery.crud_delivery', compact('deliverys'));
    }

    public function shopping()
    {
        $product = $this->objProduct->paginate(5);
        return view('Delivery.shopping_delivery', compact('product'));
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

    public function createDelivery()
    {
        $products = $this->objProduct->all();
        return view('Delivery.cart_delivery', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeRequestData(Request $request)
    {

        ModelRequestsData::create([
            'delivery_id' => 1,
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
    public function show($id)
    {
        $delivery = $this->objDelivery->find($id);
        $requests = $this->objRequestData->all();

        return view('Delivery.show_delivery', compact('delivery', 'requests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
