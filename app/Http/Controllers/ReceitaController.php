<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;
use App\Models\Veiculo;

class ReceitaController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    public function index(){

        if(isset($_GET['filtro'])){

            $filtro = $_GET["filtro"];

            if($_GET['filtro'] == "0" || $_GET['filtro'] == "1" ){
                
                 $receitas = Receita::orderBy('data', 'asc')
                    ->Where("status", $filtro);                    
            }else{
                
                $receitas = Receita::orderBy('data', 'asc')                    
                    ->join('veiculo','receita.veiculo_id','=','veiculo.id')
                    ->where('veiculo.nome','like','%'.$filtro.'%')
                    ->select('receita.*','veiculo.nome as nome_veiculo');
            }
        }

        if(isset($_GET['dataInicio']) && isset($_GET['dataFim'])) {

            $dataInicio = $_GET['dataInicio'];
            $dataFim = $_GET['dataFim'];

            $receitas = Receita::orderBy('data', 'asc')->with(['veiculo'])
                            ->whereBetween('data',[$dataInicio,$dataFim]);

        }

        if(!isset($_GET['filtro']) && !isset($_GET['dataInicio']) && !isset($_GET['dataFim'])){

            $receitas = Receita::orderBy('data', 'asc')->with(['veiculo']);            
        }

        if(!empty($receitas)){

            $receitas = $receitas->paginate(10);

        }  

        return view('receita.index', compact('receitas'));
    }

    public function create(){

        $veiculos = Veiculo::orderBy('nome', 'asc')->get();        

        return view("receita.nova", compact('veiculos'));
    }

    public function show(Receita $receita){
        
        $receita = Receita::find($receita["id"]);
        
        if ($receita) {
            return view('receita.mostrar', compact('receita'));
        }

        return redirect('receitas')->with('error','Receita não encontrada para visualização');
    }

    public function edit(Receita $receita){


        $receita = Receita::find($receita["id"]);
        $veiculos = Veiculo::get();  
 
        if ($receita) {
            return view("receita.editar", compact('receita'), compact('veiculos'));
        } 

        return redirect('receitas')->with('error','Receita não encontrada para edição');

    }

    public function store(Request $request){

       try{ 

            $validator = $request->validate([
                    'descricao' => 'required',
                    'veiculo_id' => 'required',
                    'valor' => 'required',                                       
                    'data' => 'required',                    
                    'status' => 'required'
                ]);

            $request['data'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["data"])));
            $request["valor"] = str_replace("$","",$request["valor"]);            
            $request["valor"] = str_replace(",","",$request["valor"]);
                    
            $result = Receita::create($request->all());

            if ($result) {
                return redirect('receitas')->with('success','Receita cadastrada com sucesso.');
            }

            return redirect('receitas')->with('error','Error ao tentar cadastrar uma nova receita');

        }catch (\Exception $e) {

            return $e->getMessage();
        }       
    }

    public function update(Request $request, Receita $receita){               

        try {

                $validator = $request->validate([
                    'descricao' => 'required',
                    'veiculo_id' => 'required',
                    'valor' => 'required',                                       
                    'data' => 'required',                    
                    'status' => 'required'
                ]);

        
            $request['data'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["data"])));
            $request["valor"] = str_replace("$","",$request["valor"]);            
            $request["valor"] = str_replace(",","",$request["valor"]);


            $result = Receita::where('id','=', $receita->id)
                    ->update(['descricao' => $request->post('descricao'),
                              'veiculo_id'=>$request->post('veiculo_id'),
                             'valor'=>$request->post('valor'),                             
                             'data'=>$request->post('data'),                             
                             'status'=>$request->post('status')
                             ]
                        );


            if($result){
                return redirect('receitas')->with('success','Dados da receita atualizado com sucesso!');
            }
            
            return redirect('receitas')->with('error','Nenhum dado foi alterado!');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

    public function destroy(Receita $receita){

        try {  
            

            $result = Receita::where('id','=', $receita->id)
                    ->where('status','=','0')
                    ->delete();

            if($result){

                return redirect('receitas')->with('success','Receita removida com sucesso!');
            }

            return redirect('receitas')->with('error','Receita não pode ser removido! Verifica se o status estar ativo.');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }



 }
