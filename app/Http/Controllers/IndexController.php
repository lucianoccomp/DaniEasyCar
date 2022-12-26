<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locacao;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Receita;
use App\Models\Despesa;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function __construct() {
        $this->middleware('auth');

    }   
   
    public function index(){
       
        //soma de todas as depesas e receitas para o cálculo do fluxo de caixa
        $receitasTotais = Receita::orderBy('data', 'asc')->get()->toArray();
        $despesasTotais = Despesa::orderBy('data', 'asc')->get()->toArray();

        //soma das depesas e receitas mensais
        $ano = date("Y");
        $mes = date("m");

        $receitas = Receita::orderBy('data', 'asc')->whereYear('data', '=', $ano)->get()->toArray();
        $despesas = Despesa::orderBy('data', 'asc')->whereYear('data', '=', $ano)->get()->toArray();
        $locacoesAnual = Locacao::orderBy('datalocacao', 'asc')->whereYear('datalocacao', '=', $ano)->get()->toArray();  

        $totalDespesaArray = array("Jan"=>"0","Fev"=>"0","Mar"=>"0","Abr"=>"0","Maio"=>"0","Jun"=>"0","Jul"=>"0","Ago"=>"0","Set"=>"0","Out"=>"0","Nov"=>"0","Dez"=>"0");
        $totalReceitaArray = array("Jan"=>"0","Fev"=>"0","Mar"=>"0","Abr"=>"0","Maio"=>"0","Jun"=>"0","Jul"=>"0","Agos"=>"0","Set"=>"0","Out"=>"0","Nov"=>"0","Dez"=>"0");
        $totalLocacoesArray = array("Jan"=>"0","Fev"=>"0","Mar"=>"0","Abr"=>"0","Maio"=>"0","Jun"=>"0","Jul"=>"0","Agos"=>"0","Set"=>"0","Out"=>"0","Nov"=>"0","Dez"=>"0");

        foreach($receitas as $key=> $value){

            $mesReferencia = date("m", strtotime($value['data']));           

                if($mesReferencia==1){
                    $totalReceitaArray["Jan"] += $value["valor"];                
                }
                if($mesReferencia==2){
                    $totalReceitaArray["Fev"] += $value["valor"];                
                }
                if($mesReferencia==3){
                    $totalReceitaArray["Març"] += $value["valor"];                
                }
                if($mesReferencia==4){
                    $totalReceitaArray["Abr"] += $value["valor"];                
                }
                if($mesReferencia==5){
                    $totalReceitaArray["Mai"] += $value["valor"];                
                }
                if($mesReferencia==6){
                    $totalReceitaArray["Jun"] += $value["valor"];                                 
                }
                if($mesReferencia==7){
                    $totalReceitaArray["Julh"] += $value["valor"];                
                }
                if($mesReferencia==8){
                    $totalReceitaArray["Agos"] += $value["valor"];                
                }
                if($mesReferencia==9){
                    $totalReceitaArray["Set"] += $value["valor"];                
                }
                if($mesReferencia==10){
                    $totalReceitaArray["Out"] += $value["valor"];                
                }
                if($mesReferencia==11){
                    $totalReceitaArray["Nov"] += $value["valor"];                
                }
                if($mesReferencia==12){
                    $totalReceitaArray["Dez"] += $value["valor"];                
                }                              
        }        

       foreach($despesas as $key=> $value){

            $mesReferencia = date("m", strtotime($value['data']));                       

                if($mesReferencia==1){
                    $totalDespesaArray["Jan"] += $value["valorTotal"];                
                }
                if($mesReferencia==2){
                    $totalDespesaArray["Fev"] += $value["valorTotal"];                
                }
                if($mesReferencia==3){
                    $totalDespesaArray["Març"] += $value["valorTotal"];                
                }
                if($mesReferencia==4){
                    $totalDespesaArray["Abr"] += $value["valorTotal"];                
                }
                if($mesReferencia==5){
                    $totalDespesaArray["Mai"] += $value["valorTotal"];                
                }
                if($mesReferencia==6){
                    $totalDespesaArray["Jun"] += $value["valorTotal"];                                 
                }
                if($mesReferencia==7){
                    $totalDespesaArray["Julh"] += $value["valorTotal"];                
                }
                if($mesReferencia==8){
                    $totalDespesaArray["Agos"] += $value["valorTotal"];                
                }
                if($mesReferencia==9){
                    $totalDespesaArray["Set"] += $value["valorTotal"];                
                }
                if($mesReferencia==10){
                    $totalDespesaArray["Out"] += $value["valorTotal"];                
                }
                if($mesReferencia==11){
                    $totalDespesaArray["Nov"] += $value["valorTotal"];                    
                }
                if($mesReferencia==12){
                    $totalDespesaArray["Dez"] += $value["valorTotal"];                
                }                              
        }


        foreach($locacoesAnual as $key=> $value){

            $mesReferencia = date("m", strtotime($value['datalocacao']));                       

                if($mesReferencia==1){
                    $totalLocacoesArray["Jan"] += 1;                
                }
                if($mesReferencia==2){
                    $totalLocacoesArray["Fev"] += 1;                
                }
                if($mesReferencia==3){
                    $totalLocacoesArray["Març"] += 1;                
                }
                if($mesReferencia==4){
                    $totalLocacoesArray["Abr"] += 1;                
                }
                if($mesReferencia==5){
                    $totalLocacoesArray["Mai"] += 1;                
                }
                if($mesReferencia==6){
                    $totalLocacoesArray["Jun"] += 1;                                 
                }
                if($mesReferencia==7){
                    $totalLocacoesArray["Julh"] += 1;                
                }
                if($mesReferencia==8){
                    $totalLocacoesArray["Agos"] += 1;                
                }
                if($mesReferencia==9){
                    $totalLocacoesArray["Set"] += 1;                
                }
                if($mesReferencia==10){
                    $totalLocacoesArray["Out"] += 1;                
                }
                if($mesReferencia==11){
                    $totalLocacoesArray["Nov"] += 1;                    
                }
                if($mesReferencia==12){
                    $totalLocacoesArray["Dez"] += 1;                
                }                              
        }

        $totalLocacoesPendentes = Locacao::where('statuspagamento', "=",'0')
                                           ->whereMonth('datalocacao', $mes)->get()->count();

        $totalLocacoesAvencer = Locacao::where('statusaluguel', "=",'0')
                                         ->whereMonth("datalocacao", $mes)->get()->count();        

        $somaReceita = 0;
        $somaDespesa = 0;

        foreach($receitasTotais as $key=> $value){

            $somaReceita += $value["valor"]; 
        }

        foreach($despesasTotais as $key=> $value){
        
            $somaDespesa += $value["valorTotal"]; 
        }

        $fluxoCaixa = number_format(($somaReceita-$somaDespesa), 2);         

        $somaReceitaMensal = 0;
        $somaDespesaMensal = 0;

        foreach($receitas as $key=> $value){

            $month = date("m",strtotime($value["data"]));         

            if($month == $mes){
                $somaReceitaMensal += $value["valor"];                
            }                                                      
        }

        
        foreach($despesas as $key=> $value){

            $month = date("m",strtotime($value["data"]));           

            if($month == $mes){
                $somaDespesaMensal += $value["valorTotal"];                
            }                                              
        }


        $locacoes = Locacao::orderBy('datalocacao', 'asc')->with(['veiculo'])->with(['cliente']);
        $countVeiculos = Veiculo::get()->count();

        if(!empty($locacoes)){
        
            $locacoes = $locacoes->paginate(10);                
        }

        $mesBase = array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
        $mesExtenso = $mesBase[date("m")];

        return view('index', compact('mesExtenso','locacoes','somaDespesaMensal','somaReceitaMensal','fluxoCaixa','countVeiculos','totalDespesaArray','totalReceitaArray','totalLocacoesPendentes','totalLocacoesAvencer','totalLocacoesArray'));
    }
}
