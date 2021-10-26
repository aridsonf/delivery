<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ModelProducts;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $objProducts;

    public function __construct()
    {
        $this->objProducts = new ModelProducts;
    }

    public function index()
    {
        $product = $this->objProducts->paginate(5);
        return view('Products.crud_products', compact('product'));
    }

    public function create()
    {
        return view('Products.create-update_products');
    }

    public function validador($dados)
    {
        $rules = [
            'name' => ['required', 'string', 'max:191'],
            'description' => ['required', 'string', 'max:191'],
            'value' => ['required', 'numeric', 'min:0']
        ];
        $messages = [
            'required' => 'O campo :attribute é obtrigatório!',
            'max:191' => 'O campo :attribute tem que conter no máximo 191 caracteres!',
            'numeric' => 'O campo :attribute tem que ser um número!',
            'value.min:0' => 'O valor tem que ser maior do que 0!',
            'double' => 'E-mail em uso, utilize outro email!',
        ];
        $custom = [
            'name' => 'nome',
            'description' => 'descrição',
            'value' => 'preço'
        ];

        return Validator::make($dados, $rules, $messages, $custom);
    }

    public function store(Request $request)
    {
        try {
            $val = ProductController::validador($request->all());
            if ($val->fails()) {
                return ['stts' => 0, 'msg' => 'Ocorreu um erro', 'erros' => $val->errors()];
            } else {
                $cad = $this->objProducts->create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'value' => $request->value
                ]);
                if ($cad) {
                    return ['stts' => 1, 'msg' => 'Produto cadastrado com sucesso!'];;
                }
            }
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
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
        try {
            $this->objProducts->where(['id' => $id])->update([
                'name' => $request->name,
                'description' => $request->description,
                'value' => $request->value
            ]);

            return ['stts' => 1, 'msg' => 'Produto atualizado com sucesso!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
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
