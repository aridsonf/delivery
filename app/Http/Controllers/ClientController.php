<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Lang;
use App\Models\User;

class ClientController extends Controller
{

    private $objClients;

    public function __construct(){
        $this->objUsers = new User;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->access_lvl == 1){
            return view('dashboard_client');
        }else{
            return view('dashboard_funcionario');
        }
    }

    public function listUsers(){

        $users = $this->objUsers->paginate(5);
        return view('crud_user', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-update_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
                
            $new_user = [
                'name'=>$request->name,
                'email'=>$request->email,
                'access_lvl'=>$request->access_lvl,
                'birth_date'=>$request->birth_date,
                'password'=>Hash::make($request->password),
            ];

            $request->validate([
                'name' => ['required', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
                'access_lvl' => ['required', 'int',  'max:2', 'min:1'],
                'birth_date' => ['required', 'date'],
                'password' => ['required'],
            ],
            [
                'email.unique' => 'E-mail em uso, utilize outro email!',
            ]);

            $user = User::create($new_user);

            return ['stts'=>1,'msg'=>'Cadastro realizado com sucesso'];

        } catch (\Throwable $th) {
            return ['stts'=>0,'msg'=>"Erro: ".$th->getMessage()];
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('create-update_user', compact('user'));
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
