<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Locacao;

class ClienteController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    public function index(){

        try{
         
            if(isset($_GET['filtro'])){

                $filtro = $_GET["filtro"];
                $clientes = Cliente::orderBy('nome', 'asc')
                                ->where("nome",'like', '%'.$filtro.'%')
                                ->orWhere("email",'like', '%'.$filtro.'%')
                                ->orWhere("cpf",'like', '%'.$filtro.'%')
                                ->orWhere("endereco",'like', '%'.$filtro.'%');
                                
            }else{

                $clientes = Cliente::orderBy('nome', 'asc');                
            }

            if(!empty($clientes)){

                $count = $clientes->count();
                $clientes = $clientes->paginate(10);                
            }  

            return view('cliente.index', compact('clientes','count'));

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function create(){

        return view("cliente.novo");
    }

    public function show(Cliente $cliente){
              
        $cliente = Cliente::find($cliente["id"]);
        
        if ($cliente) {
            return view('cliente.mostrar', compact('cliente'));
        }

        return redirect('clientes')->with('error','Cliente não encontrado para visualização');
    }

    public function edit(Cliente $cliente){


        $cliente = Cliente::find($cliente["id"]);        
 
        if ($cliente) {
            return view("cliente.editar", compact('cliente'));
        } 

        return redirect('clientes')->with('error','Cliente não encontrado para edição');

    }

    public function store(Request $request){

        try { 

            $validator = $request->validate([
                    'nome' => 'required',
                    'cpf' => 'required',
                    'email' => 'required',
                    'telefone' => 'required',
                    'endereco' => 'required',            
                    'status' => 'required'
                ]);
        
            //'password' => Hash::make($data['password']),
            $result = Cliente::create($request->all());

            if ($result) {
                return redirect('clientes')->with('success','Cliente cadastrado com sucesso.');
            }

            return redirect('clientes')->with('error','Error ao tentar cadastrar um novo cliente');

        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function update(Request $request, Cliente $cliente){

        
        //$customer = Customer::where('id', $id)->update($request->except('_token', '_method'));

        try {         
            
            $validator = $request->validate([
                'nome' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
                'status' => 'required'           
            ]);            

            $result = Cliente::where('id','=', $cliente->id)
                    ->update(['nome' => $request->post('nome'),
                             'cpf'=>$request->post('cpf'),
                             'email'=>$request->post('email'),
                             'telefone'=>$request->post('telefone'),
                             'endereco'=>$request->post('endereco'),
                             'status'=>$request->post('status')
                             ]
                        );

            if($result){
                return redirect('clientes')->with('success','Dados do Cliente atualizado com sucesso!');
            }
            
            return redirect('clientes')->with('error','Nenhum dado foi alterado!');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

    public function destroy(Cliente $cliente){

        try {

            $locacoes = Locacao::join('cliente','locacao.cliente_id','=','cliente.id')
                    ->where('cliente.id',$cliente->id);
            

            if($locacoes->count() > 0){
                return redirect('clientes')->with('error','Cliente não pode ser removido! Existem -- locações -- vinculadas a este cliente.');
            }
            

            $result = Cliente::where('id','=', $cliente->id)
                    ->where('status','=','0')
                    ->delete();

            if($result){

                return redirect('clientes')->with('success','Cliente removido com sucesso!');
            }

            return redirect('clientes')->with('error','Cliente não pode ser removido! Verifica se o status estar ativo.');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

}
