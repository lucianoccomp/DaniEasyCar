<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesa;
use App\Models\Veiculo;

class DespesaController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    public function index(){        

        if(isset($_GET['filtro'])){

            $filtro = $_GET["filtro"];

            if($_GET['filtro'] == "0" || $_GET['filtro'] == "1" ){
                
                 $despesas = Despesa::orderBy('data', 'asc')
                    ->Where("status", $filtro);                    
            }else{
                
                $despesas = Despesa::orderBy('data', 'asc')                    
                    ->join('veiculo','despesa.veiculo_id','=','veiculo.id')
                    ->where('veiculo.nome','like','%'.$filtro.'%')
                    ->select('despesa.*','veiculo.nome as nome_veiculo');
            }
        }

        if(isset($_GET['dataInicio']) && isset($_GET['dataFim'])) {

            $dataInicio = $_GET['dataInicio'];
            $dataFim = $_GET['dataFim'];

            $despesas = Despesa::orderBy('data', 'asc')->with(['veiculo'])
                            ->whereBetween('data',[$dataInicio,$dataFim]);
                            
        }

        if(!isset($_GET['filtro']) && !isset($_GET['dataInicio']) && !isset($_GET['dataFim'])){

            $despesas = Despesa::orderBy('data', 'asc')->with(['veiculo']);            
        }

        if(!empty($despesas)){

            $despesas = $despesas->paginate(10);
        }  

        return view('despesa.index', compact('despesas'));
    }


    public function create(){

        $veiculos = Veiculo::orderBy('nome', 'asc')->get();        

        return view("despesa.nova", compact('veiculos'));
    }


    public function show(Despesa $despesa){
        
        $despesa = Despesa::find($despesa["id"]);
        
        if ($despesa) {
            return view('despesa.mostrar', compact('despesa'));
        }

        return redirect('despesas')->with('error','Despesa não encontrada para visualização');
    }

    public function edit(Despesa $despesa){


        $despesa = Despesa::find($despesa["id"]);
        $veiculos = Veiculo::get();  
 
        if ($despesa) {
            return view("despesa.editar", compact('despesa'), compact('veiculos'));
        } 

        return redirect('despesas')->with('error','Despesa não encontrada para edição');

    }

    public function store(Request $request){

       try{ 

            $validator = $request->validate([
                    'descricao' => 'required',
                    'valorUnitario' => 'required',
                    'quantidade' => 'required',
                    'valorTotal' => 'required',
                    'data' => 'required',
                    'veiculo_id' => 'required',
                    'status' => 'required'
                ]);

            $request['data'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["data"])));
            $request["valorUnitario"] = str_replace("$","",$request["valorUnitario"]);            
            $request["valorUnitario"] = str_replace(",","",$request["valorUnitario"]);
            $request["valorTotal"] = str_replace("$","",$request["valorTotal"]);            
            $request["valorTotal"] = str_replace(",","",$request["valorTotal"]); 
                    
            $result = Despesa::create($request->all());

            if ($result) {
                return redirect('despesas')->with('success','Despesa cadastrada com sucesso.');
            }

            return redirect('despesas')->with('error','Error ao tentar cadastrar uma nova despesa');

        }catch (\Exception $e) {

            return $e->getMessage();
        }       
    }

    public function update(Request $request, Despesa $despesa){               

        try {

                $validator = $request->validate([
                    'descricao' => 'required',
                    'valorUnitario' => 'required',
                    'quantidade' => 'required',
                    'valorTotal' => 'required',
                    'data' => 'required',
                    'veiculo_id' => 'required',
                    'status' => 'required'
                ]);

        
            $request['data'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["data"])));
            $request["valorUnitario"] = str_replace("$","",$request["valorUnitario"]);            
            $request["valorUnitario"] = str_replace(",","",$request["valorUnitario"]);
            $request["valorTotal"] = str_replace("$","",$request["valorTotal"]);            
            $request["valorTotal"] = str_replace(",","",$request["valorTotal"]);


            $result = Despesa::where('id','=', $despesa->id)
                    ->update(['descricao' => $request->post('descricao'),
                             'valorUnitario'=>$request->post('valorUnitario'),
                             'quantidade'=>$request->post('quantidade'),
                             'valorTotal'=>$request->post('valorTotal'),
                             'data'=>$request->post('data'),
                             'veiculo_id'=>$request->post('veiculo_id'),
                             'status'=>$request->post('status')
                             ]
                        );


            if($result){
                return redirect('despesas')->with('success','Dados da depesa atualizado com sucesso!');
            }
            
            return redirect('despesas')->with('error','Nenhum dado foi alterado!');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }


    public function destroy(Despesa $despesa){

        try {  
            

            $result = Despesa::where('id','=', $despesa->id)
                    ->where('status','=','0')
                    ->delete();

            if($result){

                return redirect('despesas')->with('success','Despesa removida com sucesso!');
            }

            return redirect('despesas')->with('error','Despesa não pode ser removido! Verifica se o status estar ativo.');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

}
