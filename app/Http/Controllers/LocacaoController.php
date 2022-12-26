<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Locacao;

class LocacaoController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index(){        


        if(isset($_GET['dataInicio']) && isset($_GET['dataFim'])) {

            $dataInicio = $_GET['dataInicio'];
            $dataFim = $_GET['dataFim'];

            $locacoes = Locacao::orderBy('datalocacao', 'asc')
                            ->whereBetween('datalocacao',[$dataInicio,$dataFim]);            
        }

        if(isset($_GET['filtro'])){

            $filtro = $_GET["filtro"];

            if($_GET['filtro'] == "0" || $_GET['filtro'] == "1" ){
                
                 $locacoes = Locacao::orderBy('datalocacao', 'asc')
                    ->Where("statuspagamento", $filtro)
                    ->orWhere("statusaluguel", $filtro);               
            }else{
                
                $locacoes = Locacao::orderBy('datalocacao', 'asc')                    
                    ->join('veiculo','locacao.veiculo_id','=','veiculo.id')
                    ->where('veiculo.nome','like','%'.$filtro.'%')
                    ->select('locacao.*','veiculo.nome as nome_veiculo');
                                       
                if(empty($locacoes->get()->toArray())){
                    
                    $locacoes = Locacao::orderBy('datalocacao', 'asc')                    
                        ->join('cliente','locacao.cliente_id','=','cliente.id')
                        ->where('cliente.nome','like','%'.$filtro.'%')
                        ->select('locacao.*','cliente.nome as nome_cliente');                    
                }
            }
            
                                                                                                       
        }

        if(!isset($_GET['filtro']) && !isset($_GET['dataInicio']) && !isset($_GET['dataFim'])){
            
            $locacoes = Locacao::orderBy('datalocacao', 'asc')->with(['veiculo'])->with(['cliente']);            
        }

        if($locacoes){

            $locacoes = $locacoes->paginate(10);
        }  

        return view('locacao.index2', compact('locacoes'));
    }


    public function create(){

        $veiculos = Veiculo::orderBy('nome', 'asc')->get();
        $clientes = Cliente::orderBy('nome', 'asc')->get();

        return view("locacao.nova", compact('veiculos','clientes'));
    }

    public function show(Locacao $locacao){
        
        $locacao = Locacao::find($locacao["id"]);
        
        if ($locacao) {
            return view('locacao.mostrar', compact('locacao'));
        }

        return redirect('locacoes')->with('error','Locação não encontrada para visualização');
    }

    public function edit(Locacao $locacao){

        $locacao = Locacao::find($locacao["id"]);
        $veiculos = Veiculo::get();
        $clientes = Cliente::get();
 
        if ($locacao) {
            return view("locacao.editar", compact('locacao','veiculos','clientes'));
        } 

        return redirect('locacoes')->with('error','Locação não encontrada para edição');

    }

    public function store(Request $request){

       try{ 

            $validator = $request->validate([
                    'datalocacao' => 'required',
                    'datadevolucao' => 'required',
                    'valorcontratado' => 'required',                                                           
                    'valortotal' => 'required',
                    'statuspagamento' => 'required',
                    'statusaluguel' => 'required',
                    'veiculo_id' => 'required',
                    'cliente_id' => 'required',
                    'status' => 'required'
                ]);

            $request['datalocacao'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["datalocacao"])));
            $request['datadevolucao'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["datadevolucao"])));

            $request["valorcontratado"] = str_replace("$","",$request["valorcontratado"]);
            $request["valorcontratado"] = str_replace(",","",$request["valorcontratado"]);

            $request["valortotal"] = str_replace("$","",$request["valortotal"]);
            $request["valortotal"] = str_replace(",","",$request["valortotal"]);

            if(is_null($request["valoradicional"])){
                $request["valoradicional"] = 0;                
            }

            if(is_null($request["valordesconto"])){
                $request["valordesconto"] = 0;                
            }

            if(isset($request["valoradicional"])){
                $request["valoradicional"] = str_replace("$","",$request["valoradicional"]);
                $request["valoradicional"] = str_replace(",","",$request["valoradicional"]);            
            }

            if(isset($request["valordesconto"])){
                $request["valordesconto"] = str_replace("$","",$request["valordesconto"]);
                $request["valordesconto"] = str_replace(",","",$request["valordesconto"]);
            }


            $result = Locacao::create($request->all());

            if ($result) {
                return redirect('locacoes')->with('success','Locação cadastrada com sucesso.');
            }

            return redirect('locacoes')->with('error','Error ao tentar cadastrar uma nova locação');

        }catch (\Exception $e) {

            return $e->getMessage();
        }       
    }

    public function update(Request $request, Locacao $locacao){               

        try {
            
            $validator = $request->validate([
                'datalocacao' => 'required',
                'datadevolucao' => 'required',
                'valorcontratado' => 'required',                                                           
                'valortotal' => 'required',
                'statuspagamento' => 'required',
                'statusaluguel' => 'required',
                'veiculo_id' => 'required',
                'cliente_id' => 'required',
                'status' => 'required'
            ]);

            
            $request['datalocacao'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["datalocacao"])));
            $request['datadevolucao'] = date('Y-m-d', strtotime(str_replace('/', '-',$request["datadevolucao"])));

            $request["valorcontratado"] = str_replace("$","",$request["valorcontratado"]);
            $request["valorcontratado"] = str_replace(",","",$request["valorcontratado"]);

            $request["valortotal"] = str_replace("$","",$request["valortotal"]);
            $request["valortotal"] = str_replace(",","",$request["valortotal"]);

            if(is_null($request["valoradicional"])){
                $request["valoradicional"] = 0;                
            }

            if(is_null($request["valordesconto"])){
                $request["valordesconto"] = 0;                
            }

            if(isset($request["valoradicional"])){
                $request["valoradicional"] = str_replace("$","",$request["valoradicional"]);
                $request["valoradicional"] = str_replace(",","",$request["valoradicional"]);            
            }

            if(isset($request["valordesconto"])){
                $request["valordesconto"] = str_replace("$","",$request["valordesconto"]);
                $request["valordesconto"] = str_replace(",","",$request["valordesconto"]);
            }
            
            $result = Locacao::where('id','=', $locacao->id)
                    ->update(['datalocacao' => $request->post('datalocacao'),
                             'datadevolucao'=>$request->post('datadevolucao'),
                             'valorcontratado'=>$request->post('valorcontratado'),
                             'valoradicional'=>$request->post('valoradicional'),
                             'valordesconto'=>$request->post('valordesconto'),
                             'valortotal'=>$request->post('valortotal'),                             
                             'veiculo_id'=>$request->post('veiculo_id'),
                             'cliente_id'=>$request->post('cliente_id'),
                             'statuspagamento'=>$request->post('statuspagamento'),
                             'statusaluguel'=>$request->post('statusaluguel'),
                             'status'=>$request->post('status')
                             ]);

            
            if($result){
                return redirect('locacoes')->with('success','Dados da locação atualizado com sucesso!');
            }
            
            return redirect('locacoes')->with('error','Nenhum dado foi alterado!');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

    public function destroy(Locacao $locacao){

        try {  
            
            $result = Locacao::where('id','=', $locacao->id)
                    ->where('status','=','0')
                    ->delete();

            if($result){

                return redirect('locacoes')->with('success','Locação removida com sucesso!');
            }

            return redirect('locacoes')->with('error','Locação não pode ser removido! Verifica se o status estar ativo.');

        } catch (\Exception $e) {

            return $e->getMessage();            
        }
    }

}
