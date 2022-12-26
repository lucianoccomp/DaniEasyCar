<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    public function index(){

        try{
           
            if(isset($_GET['filtro'])){

                $filtro = $_GET["filtro"];
                $fornecedores = Fornecedor::orderBy('nomefornecedor', 'asc')
                                ->where("nomefornecedor",'like', '%'.$filtro.'%')
                                ->orWhere("email",'like', '%'.$filtro.'%')
                                ->orWhere("cpfcnpj",'like', '%'.$filtro.'%')
                                ->orWhere("endereco",'like', '%'.$filtro.'%')
                                ->orWhere("uf",'like', '%'.$filtro.'%')
                                ->orWhere("nomecontato",'like', '%'.$filtro.'%');
                 
            }else{

                $fornecedores = Fornecedor::orderBy('nomefornecedor', 'asc');
            }

            if(!empty($fornecedores)){

                $fornecedores = $fornecedores->paginate(10);
            }  

            return view('fornecedor.index', compact('fornecedores'));

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function create(){

        return view("fornecedor.novo");
    }

    public function show(Fornecedor $fornecedor){        
        
        $fornecedor = Fornecedor::find($fornecedor["id"]);  

        if ($fornecedor) {
            return view('fornecedor.mostrar', compact('fornecedor'));
        }

        return redirect('fornecedores')->with('error','Fornecedor não encontrado para visualização');
    }

    public function edit(Fornecedor $fornecedor){


        $fornecedor = Fornecedor::find($fornecedor["id"]);        
 
        if ($fornecedor) {
            return view("fornecedor.editar", compact('fornecedor'));
        } 

        return redirect('fornecedores')->with('error','Fornecedor não encontrado para edição');

    }

    public function update(Request $request, Fornecedor $fornecedor){

        try {
            
            $validator = $request->validate([
                'nomefornecedor' => 'required',
                'cpfcnpj' => 'required',
                'endereco' => 'required',
                'uf' => 'required',
                'email' => 'required',
                'telefone' => 'required',
                'nomecontato' => 'required',                
                'status' => 'required'           
            ]);
          

            $result = Fornecedor::where('id','=', $fornecedor->id)
                    ->update(['nomefornecedor' => $request->post('nomefornecedor'),
                             'cpfcnpj'=>$request->post('cpfcnpj'),
                             'endereco'=>$request->post('endereco'),
                             'uf'=>$request->post('uf'),
                             'email'=>$request->post('email'),
                             'telefone'=>$request->post('telefone'),
                             'nomecontato'=>$request->post('nomecontato'),                             
                             'status'=>$request->post('status')
                             ]
                        );

            if($result){
                return redirect('fornecedores')->with('success','Dados do fornecedor atualizado com sucesso!');
            }
            
            return redirect('fornecedores')->with('error','Nenhum dado foi alterado!');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

    public function store(Request $request){

        try { 

             $validator = $request->validate([
                'nomefornecedor' => 'required',
                'cpfcnpj' => 'required',
                'endereco' => 'required',
                'uf' => 'required',
                'email' => 'required',
                'telefone' => 'required',
                'nomecontato' => 'required',                
                'status' => 'required'           
            ]);
        
            //'password' => Hash::make($data['password']),
            $result = Fornecedor::create($request->all());

            if ($result) {
                return redirect('fornecedores')->with('success','Fornecedor cadastrado com sucesso.');
            }

            return redirect('fornecedores')->with('error','Error ao tentar cadastrar um novo fornecedor');

        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function destroy(Fornecedor $fornecedor){

        try {              

            $result = Fornecedor::where('id','=', $fornecedor->id)
                    ->where('status','=','0')
                    ->delete();

            if($result){

                return redirect('fornecedores')->with('success','Fornecedor removido com sucesso!');
            }

            return redirect('fornecedores')->with('error','Fornecedor não pode ser removido! Verifica se o status estar ativo.');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

}
