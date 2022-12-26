<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;
use App\Models\Despesa;

class FluxoCaixaController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    public function index(){

        $receitasTotais = Receita::orderBy('data', 'asc')->get()->toArray();
        $despesasTotais = Despesa::orderBy('data', 'asc')->get()->toArray();

        $ano = date("Y");
        $mes = date("m");

        if(isset($_GET['dataInicio'])) {

            $dataInicioAno = date("Y", strtotime($_GET['dataInicio']));            
            $dataInicioMes = date("m", strtotime($_GET['dataInicio']));

            $ano = $dataInicioAno;
            $mes = $dataInicioMes;
        }        


        $receitas = Receita::orderBy('data', 'asc')->whereYear('data', '=', $ano)->get()->toArray();
        $despesas = Despesa::orderBy('data', 'asc')->whereYear('data', '=', $ano)->get()->toArray();
        

        $totalReceitasDespesasMensal = 0;
        $totalReceitasDespesasAnual = 0;        

        //Receitas
        $receitasMensal = [];
        $somaReceitaMensal = 0;
        $somaReceitaAnual = 0;
        $somaReceita = 0;

        //depesas
        $despesasMensal = [];
        $somaDespesaMensal = 0;
        $somaDespesaAnual = 0;
        $somaDespesa = 0;

        $fluxoCaixa = 0;
        $receitasDespesasMensal = [];  

        //soma de todas as receitas e despesas
        foreach($receitasTotais as $key=> $value){

            $somaReceita += $value["valor"]; 
        }

        foreach($despesasTotais as $key=> $value){
        
            $somaDespesa += $value["valorTotal"]; 
        }


        //soma das receitas e despesas mensais e anuais
        foreach($receitas as $key=> $value){

            $month = date("m",strtotime($value["data"]));
            $year = date("Y",strtotime($value["data"]));

            if($month == $mes){
                $somaReceitaMensal += $value["valor"];
                array_push($receitasMensal, ["id"=>$value["id"], "data"=>$value["data"], "valor"=>$value["valor"]]);                
            }

            if($year == $ano){
                $somaReceitaAnual += $value["valor"];
            }
                                          
        }
       

        foreach($despesas as $key=> $value){

            $month = date("m",strtotime($value["data"]));
            $year = date("Y",strtotime($value["data"]));

            if($month == $mes){
                $somaDespesaMensal += $value["valorTotal"];
                array_push($despesasMensal, ["id"=>$value["id"], "data"=>$value["data"],"valor"=>$value["valorTotal"]]);                
            }

            if($year == $ano){
                $somaDespesaAnual += $value["valorTotal"];
            }                                        
        }

        
    $totalReceitasDespesasMensal = number_format(($somaReceitaMensal-$somaDespesaMensal), 2);

    $totalReceitasDespesasAnual = number_format(($somaReceitaAnual-$somaDespesaAnual), 2);

    $fluxoCaixa = number_format(($somaReceita-$somaDespesa), 2);       
                       

        return view("FluxoCaixa.index2", compact('totalReceitasDespesasMensal','totalReceitasDespesasAnual','receitasMensal','somaReceitaMensal','despesasMensal','somaDespesaMensal','fluxoCaixa'));
         

    }

    public function date_compare($a, $b){

        $t1 = strtotime($a['datetime']);
        $t2 = strtotime($b['datetime']);

        return $t1 - $t2;
    } 

}
