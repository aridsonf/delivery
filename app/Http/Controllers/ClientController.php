<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ClientController extends Controller
{

    private $objUsers;

    public function __construct()
    {
        $this->objUsers = new User;
    }

    public function index()
    {
        if (Auth::user()->access_lvl == 1) {
            return view('dashboard_client');
        } else {
            return view('dashboard_funcionario');
        }
    }

    public function listUsers()
    {
        $users = $this->objUsers->paginate(5);
        return view('crud_user', compact('users'));
    }

    public function validador($dados)
    {
        $rules = [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'access_lvl' => ['required', 'int',  'max:2', 'min:1'],
            'birth_date' => ['required', 'date'],
            'password' => ['required', 'min:4'],
        ];
        $messages = [
            'required' => 'O campo :attribute é obtrigatório!',
            'max:191' => 'O campo :attribute tem que conter no máximo 191 caracteres!',
            'min:4' => 'O campo :attribute tem que conter no mínimo caracteres!',
            'email.unique' => 'E-mail em uso, utilize outro email!',
        ];
        $custom = [
            'name' => 'name',
            'email' => 'e-mail',
            'access_lvl' => 'nível de acesso',
            'birth_date' => 'data de nascimento',
            'password' => 'senha'
        ];

        return Validator::make($dados, $rules, $messages, $custom);
    }

    public function create()
    {
        return view('create-update_user');
    }

    public function store(Request $request)
    {
        try {
            $validator = ClientController::validador($request->all());
            if ($validator->fails()) {
                return ['stts' => 0, 'msg' => 'Ocorreu um erro', 'erros' => $validator->errors()];
            } else {

                $new_user = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'access_lvl' => $request->access_lvl,
                    'birth_date' => $request->birth_date,
                    'password' => Hash::make($request->password),
                ];

                $user = User::create($new_user);

                return ['stts' => 1, 'msg' => 'Cadastro realizado com sucesso'];
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
    public function show()
    {
        return view('show_user');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('create-update_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            $update_user = [
                'name' => $request->name,
                'email' => $request->email,
                'access_lvl' => $request->access_lvl,
                'birth_date' => $request->birth_date
            ];

            if (!$request->password == '') {
                $update_user += [
                    'password' => Hash::make($request->password),
                ];
            } else {
                $update_user += [
                    'password' => $user->password,
                ];
            }

            $validator = ClientController::validador($update_user);

            if ($validator->fails()) {
                return ['stts' => 0, 'msg' => 'Ocorreu um erro', 'erros' => $validator->errors()];
            } else {
                $user->update($update_user);
                return ['stts' => 1, 'msg' => 'Atualização realizada com sucesso!'];
            }
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }

    public function destroy($id)
    {
        try {
            $this->objUsers->destroy($id);
            return ['stts' => 1, 'msg' => 'Usuário deletado com sucesso!'];
        } catch (\Throwable $th) {
            return ['stts' => 0, 'msg' => "Erro: " . $th->getMessage()];
        }
    }
}
