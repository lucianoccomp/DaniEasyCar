<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Locacao;
use App\Models\Despesa;
use App\Models\Receita;
use Illuminate\Support\Facades\Validator;

class VeiculoController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index(){

        try{

            if(isset($_GET['filtro'])){

                $filtro = $_GET["filtro"];
                $veiculos = Veiculo::orderBy('nome', 'asc')
                                ->where("nome",'like', '%'.$filtro.'%')
                                ->orWhere("descricao",'like', '%'.$filtro.'%')
                                ->orWhere("placa",'like', '%'.$filtro.'%')
                                ->orWhere("idnumber",'like', '%'.$filtro.'%');                                                        
                 
            }else{

                $veiculos = Veiculo::orderBy('nome', 'asc');
            }

            if(!empty($veiculos)) {

               $veiculos = $veiculos->paginate(10);
            }

        } catch (\Exception $e) {

            return $e->getMessage();
        }

        return view('veiculo.index', compact('veiculos'));
    }

    public function create(){

        return view("veiculo.novo");
    }

    public function show(Veiculo $veiculo){
        
        $veiculo = Veiculo::find($veiculo["id"]);  

        if ($veiculo) {
            return view('veiculo.mostrar', compact('veiculo'));
        }

        return redirect('veiculos')->with('error','Veículo não encontrado para visualização');
    }

    public function edit(Veiculo $veiculo){


        $veiculo = Veiculo::find($veiculo["id"]);        
 
        if ($veiculo) {
            return view("veiculo.editar", compact('veiculo'));
        } 

        return redirect('veiculos')->with('error','Veiculo não encontrado para edição');

    }

        

    public function store(Request $request){

        try {         

            $validator = $request->validate([
                    'nome' => 'required',
                    'descricao' => 'required',
                    'placa' => 'required',
                    'idnumber' => 'required',
                    'registrationvalid' => 'required',            
                    'precocompra' => 'required', 
                    'datacompra' => 'required', 
                    'precolocacaosemana' => 'required', 
                    'milhagem' => 'required', 
                    'foto' => 'required|image|mimes:png,jpg,jpeg|max:5048', 
                    'status' => 'required',
                ]);
            
            $requestData = $request->all();        
            
            $requestData['registrationvalid'] = date('Y-m-d', strtotime(str_replace('/', '-',$request->post("registrationvalid") ))); 
            $requestData['datacompra'] = date('Y-m-d', strtotime(str_replace('/', '-',$request->post("datacompra") )));        
            $requestData["precocompra"] = str_replace("$","",$requestData["precocompra"]);            
            $requestData["precocompra"] = str_replace(",","",$requestData["precocompra"]); 
            $requestData["precolocacaosemana"] = str_replace("$","",$requestData["precolocacaosemana"]);
            $requestData["precolocacaosemana"] = str_replace(",","",$requestData["precolocacaosemana"]);
            
           
            
            //Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('foto') && $request->file('foto')) {
                    
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
            
                // Recupera a extensão do arquivo
                $extension = $requestData["foto"]->extension();
            
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
            
                // Faz o upload:'
                $upload = $requestData['foto']->move(public_path('storage/fotos'), $nameFile);               
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/fotos/nomedinamicoarquivo.extensao
            
                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if ( !$upload )
                    return redirect()
                                ->back()
                                ->with('error', 'Falha ao carregar a foto do veículo.')
                                ->withInput();
                

                $requestData["foto"] = $nameFile;                
    
            }     
       

            $result = Veiculo::create($requestData);

            if ($result) {
                return redirect('veiculos')->with('success','Veículo cadastrado com sucesso.');
            }

            return redirect('veiculos')->with('error','Error ao tentar cadastrar um novo veículo');

        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function update(Request $request, Veiculo $veiculo){

        
        //$customer = Customer::where('id', $id)->update($request->except('_token', '_method'));

        try {                                

            $validator = Validator::make($request->all(), [
                'nome' => 'required', 
                'descricao' => 'required',
                'placa' => 'required',
                'idnumber' => 'required',
                'registrationvalid' => 'required',            
                'precocompra' => 'required', 
                'datacompra' => 'required', 
                'precolocacaosemana' => 'required', 
                'milhagem' => 'required',                 
                'status' => 'required'                           
            ]);
                              
            
            //Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;              
            
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('foto') && $request->file('foto') && $request['foto'] !="null") {
                    
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
            
                // Recupera a extensão do arquivo
                $extension = $request["foto"]->extension();
            
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
            
                // Faz o upload:                
                $upload = $request['foto']->move(public_path('storage/fotos'), $nameFile);  

                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/fotos/nomedinamicoarquivo.extensao               
                $abspath = $_SERVER['DOCUMENT_ROOT'];                
                
                unlink($abspath.'/storage/fotos/'.$veiculo->foto);
                $veiculo->foto =  $nameFile;
            }
            
            $request['registrationvalid'] = date('Y-m-d', strtotime(str_replace('/', '-',$request['registrationvalid']))); 
            $request['datacompra'] = date('Y-m-d', strtotime(str_replace('/', '-',$request['datacompra'] )));        
            $request['precocompra'] = str_replace("$","",$request['precocompra']);            
            $request['precocompra'] = str_replace(",","",$request['precocompra']); 
            $request['precolocacaosemana'] = str_replace("$","",$request['precolocacaosemana']);
            $request['precolocacaosemana'] = str_replace(",","",$request['precolocacaosemana']);            

            $result = Veiculo::where('id','=', $veiculo->id)
                    ->update(['nome' => $request['nome'],
                             'descricao'=>$request['descricao'],
                             'placa'=>$request['placa'],
                             'idnumber'=>$request['idnumber'],
                             'registrationvalid'=>$request['registrationvalid'],
                             'precolocacaosemana'=>$request['precolocacaosemana'],
                             'precocompra'=>$request['precocompra'],
                             'datacompra'=>$request['datacompra'],
                             'milhagem'=>$request['milhagem'],                             
                             'foto'=>$veiculo->foto,
                             'status'=>$request['status']
                             ]
                        );
            
            

            if($result){
                
                return redirect('veiculos')->with('success','Dados do veículo atualizado com sucesso!');
            }
            
            return redirect('veiculos')->with('error','Nenhum dado foi alterado!');

         } catch (\Exception $e) {

             return $e->getMessage();                      
         }
    }

    public function destroy(Veiculo $veiculo){

        try {

            $locacoes = Locacao::join('veiculo','locacao.veiculo_id','=','veiculo.id')
                    ->where('veiculo.id',$veiculo->id);
            

            if($locacoes->count() > 0){
                return redirect('veiculos')->with('error','Veículo não pode ser removido! Existem -- locações -- vinculadas a este veículo.');
            }

            $despesas = Despesa::join('veiculo','despesa.veiculo_id','=','veiculo.id')
                    ->where('veiculo.id',$veiculo->id);
            
            if($despesas->count() > 0){
                return redirect('veiculos')->with('error',"Veículo não pode ser removido! Existem -- despesas -- vinculadas a este veículo.");
            }

            $receitas = Receita::join('veiculo','receita.veiculo_id','=','veiculo.id')
                    ->where('veiculo.id',$veiculo->id);
            

            if($receitas->count() > 0){
                return redirect('veiculos')->with('error',"Veículo não pode ser removido! Existem -- receitas -- vinculadas a este veículo.");
            }

            
            $result = Veiculo::where('id','=', $veiculo->id)
                    ->where('status','=','0')
                    ->delete();

            if($result){

                $abspath = $_SERVER['DOCUMENT_ROOT'];
                
                unlink($abspath.'/storage/fotos/'.$veiculo->foto);

                return redirect('veiculos')->with('success','Veículo removido com sucesso!');
            }                       

            return redirect('veiculos')->with('error','Veículo não pode ser removido! Verifica se o status estar ativo.');

        } catch (\Exception $e) {

             return response()->json(['erro: ' => $e->getMessage()], 401);            
        }
    }

}

