<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ModelProducts;

class ProductController extends Controller
{
    private $objProducts;

    public function __construct()
    {

        $this->objProducts = new ModelProducts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->objProducts->paginate(5);
        return view('Products.crud_products', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Products.create-update_products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cad = $this->objProducts->create([
            'name' => $request->name,
            'description' => $request->description,
            'value' => $request->value
        ]);
        if ($cad) {
            $store['success'] = true;
            $store['message'] = 'Cadastro realizado com sucesso!';
            echo json_encode($store);
            return;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->objProducts->find($id);
        return view('Products.show_products', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->objProducts->find($id);
        return view('Products.create-update_products', compact('product'));
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
        $this->objProducts->where(['id' => $id])->update([
            'name' => $request->name,
            'description' => $request->description,
            'value' => $request->value
        ]);
        $update['success'] = true;
        $update['message'] = 'Atualização realizada com sucesso!';
        echo json_encode($update);
        return;
        //return redirect('books');
        //return($upd)?"sim":"não";   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->objProducts->destroy($id);
            return ['stts' => 1, 'msg' => 'Produto deletado com sucesso!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }
}
