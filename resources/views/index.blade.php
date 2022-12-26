@extends('../layout')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="row mt-3 ">
         <div class="col-sm-2 text-center">
            <div class="card bg-success ps-2 pt-3 mt-4">          
                <div class="card-body">                    
                    <h6 class="card-title text-white"><b>Total das Despesas</b></h6>
                    <p class="card-text"><h3><i class="text-white ps-2"><b>$ {{ $somaDespesaMensal }}</i></h3></b></p>
                    <p class="text-white"><b>Mês de {{ $mesExtenso }}</b></p>
                </div>
            </div>
            <div style="background-color:#d3eaf2;" class="card mt-3 mb-2">          
                <div class="card-body">
                    <h6 style="color:#145369;" class="card-title"><b>FLUXO DE CAIXA</b></h6>
                    <p class="card-text"><h5><i style="color:#145369;" class="ps-0"><b>$ {{ $fluxoCaixa }}</i></h5></b></p>                    
                </div>
            </div>
        </div>

        <div class="col-sm-2 text-center">
            <div class="card bg-primary ps-2 pt-3 mt-4">          
                <div class="card-body justify-content-center">
                    <h6 class="card-title text-white"><b>Total das Receitas</b></h6>
                    <p class="card-text"><h3><i class="text-white ps-2"><b>$ {{ $somaReceitaMensal }}</i></h3></b></p>
                    <p class="text-white"><b>Mês de {{ $mesExtenso }}</b></p>
                </div>
            </div>
            <div style="background-color:#d3eaf2;" class="card mt-3 mb-3">          
                <div class="card-body">
                    <h6 class="card-title text-black"><b style="color:#145369;">Nº VEÍCULOS</b></h6>                    
                    <p class="card-text"><h5><i style="color:#145369;" class="ps-0"><b>{{ $countVeiculos }} automóveis</i></h5></b></p> 
                </div>
            </div>
        </div>

        <div class="col-sm-8 text-center">
            <h5>Locações vencidas</h5>
            <table class="table-responsivel table-zebra">
                <thead>
                    <tr>
                        <th class="colNum" scope="col">#</th>
                        <th class="nome" scope="col">Veículo</th>                        
                        <th class="nome" scope="col">Cliente</th>
                        <th scope="col">Datas</th>
                        <th scope="col">Status</th>
                    </tr>
                <thead>
                <tbody>
                    @if($locacoes)
                        @php $x = 1 @endphp
                        @foreach ($locacoes as $locacao)
                             @if($locacao->datadevolucao >= date('Y-m-d') && $locacao->statusaluguel == 0)
                                <tr>
                                    <td class="colNum" data-label="#" scope="row">{{ $x }}</td>
                                    <td class="nome" data-label="nome" scope="row">
                                        <p class="mb-1 nome-size"><b>{{ $locacao->veiculo->nome }}</b></p>                           
                                    </td>                                
                                    <td class="nome" data-label="Cliente">{{ $locacao->cliente->nome }}</td>
                                    <td class="text-end" data-label="Data locação">
                                        <b>Locação:</b> <span class="ms-1"> {{ date('d/m/Y', strtotime($locacao->datalocacao)) }}</span><br>
                                        <b>Devolução:</b><span class="ms-1"> {{ date('d/m/Y', strtotime($locacao->datadevolucao)) }}</span>
                                    </td>
                                    <td data-label="Status">                                   
                                        <span><b class='text-danger text-small'>aluguel vencido!</b></span>                                    
                                    </td>
                                </tr>
                                @php $x += 1 @endphp
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>  
    </div>

    <div class="row mt-4 ">
         <div class="col-sm-6 text-center">
            <canvas id="despesasChart"></canvas>
            <script>
                const ctxDespesas = document.getElementById('despesasChart');

                  var despesas =  {{ Js::from($totalDespesaArray) }};             

                var myChart = new Chart(ctxDespesas, {
                    type: 'bar',
                    data: {
                      //labels: ['Jan', 'Fev', 'Març', 'Abril', 'Mai', 'Jun','Julh','Ago','Set','Out','Nov','Dez'],
                      datasets: [{
                        label: '$ Despesas',
                        data: despesas,
                        backgroundColor: ["#36a2eb"],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      plugins: {
                            tooltip: {
                               callbacks: {
                                    label: function(t,d) {                                        
                                        var xLabel = "Despesas";
                                        var yLabel = '$ ' + t.parsed["y"].toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                        return xLabel + ': ' + yLabel;
                                    }
                                }
                            },
                            legend: {
                                labels: {
                                    font: {
                                        style: '',
                                        weight: '700',
                                        size:'16'
                                    }
                                }
                            },
                            title: {
                            display: true,
                            text: 'Despesas mensais - '+{{ date("Y") }},
                            font: {
                                style: '',
                                weight: '800',
                                size:'16'
                                }
                          }
                         
                        },

                    scales: {
                        y: {
                            ticks: {
                                beginAtZero: true,
                                callback: function(value, index, despesas) {
                                    if (parseInt(value) >= 1000) {
                                        return '$ ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return '$ ' + value;
                                    }
                                }
                            }
                        }
                        }                      
                    }
                  });
            </script>
         </div>
         <div class="col-sm-6 text-center">
            <canvas class="ms-4" id="receitasChart"></canvas>
            <script>                
                const ctxReceitas = document.getElementById('receitasChart');

                var receitas =  {{ Js::from($totalReceitaArray) }};

                var myChart =    new Chart(ctxReceitas, {
                    type: 'bar',
                    data: {
                      //labels: ["Jan", "Fev","Mar","Abr","Maio","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                      datasets: [{
                        label: '$ Receitas',
                        data: receitas,
                        borderColor: '#e24354',
                        backgroundColor: ["#e24354"], 
                        borderWidth: 1                        
                      }]
                    },
                    options: {
                       plugins: {
                            tooltip: {
                               callbacks: {
                                    label: function(t,d) {                                        
                                        var xLabel = "Receitas";
                                        var yLabel = '$ ' + t.parsed["y"].toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                        return xLabel + ': ' + yLabel;
                                    }
                                }
                            },
                            legend: {
                                labels: {
                                    font: {
                                        style: '',
                                        weight: '600',
                                        size:'16'
                                    }
                                }
                            },
                            title: {
                            display: true,
                            text: 'Receitas mensais - '+{{ date("Y") }},
                            font: {
                                style: '',
                                weight: '800',
                                size:'16'
                                }
                          },
                        },
                      scales: {                     
                           y: {
                                ticks: {
                                    beginAtZero: true,
                                    callback: function(value, index, despesas) {
                                        if (parseInt(value) >= 1000) {
                                            return '$ ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        } else {
                                            return '$ ' + value;
                                        }
                                    }
                                }
                            }
                      }                     
                    }
                  });
            </script>
         </div>
    </div>

    <div class="row mt-3 mt-5 ">
         <div class="col-sm-6 text-center">
         <canvas class="ms-4" height="400" id="myLocacoesStatus"></canvas>
            <script>                
                var ctx = document.getElementById("myLocacoesStatus");
                var mesExt =  {{ Js::from($mesExtenso) }};
                var locacoesPendentes =  {{ Js::from($totalLocacoesPendentes) }};
                var locacoesAvencer =  {{ Js::from($totalLocacoesAvencer) }};
                
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Pagamenos pendentes", "Aluguês a vencer"],
                        datasets: [{
                            label: '# Quantidade',
                            data: [locacoesPendentes, locacoesAvencer],
                            backgroundColor: ["#e24354","#36a2eb"],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                          legend: {
                            position: 'top',
                            labels: {
                                    font: {
                                        style: '',
                                        weight: '600',
                                        size:'15'
                                    }
                                }
                          },                           
                          title: {
                            display: true,
                            text: 'Locações status - '+mesExt,
                            font: {
                                style: '',
                                weight: '800',
                                size:'16'
                                }
                          },
                          scales: {                     
                            y: {
                              beginAtZero: true,                              
                            }                            
                          }      
                        }
                      }
                });              
            </script>

         </div>
         <div class="col-sm-6 text-center">
             <canvas class="ms-4" height="400" id="myLocacoes"></canvas>
                <script>                
                    var ctx = document.getElementById("myLocacoes");
                    var locacoes =  {{ Js::from($totalLocacoesArray) }};
                    
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {                        
                            //labels: ["Jan", "Fev","Mar","Abr","Maio","Jun","Jul","Ago","Set","Out","Nov","Dez"],
                            datasets: [{
                                label: '#quantitativo',
                                data: locacoes,                                                        
                            }]                            
                        },
                        backgroundColor: ["#e24354"],

                        options: {                            
                            responsive: true,
                            maintainAspectRatio: false,                            

                            plugins: {
                                legend: {
                                position: 'top',
                                labels: {
                                        font: {
                                            style: '',
                                            weight: '600',
                                            size:'15'
                                        }
                                }                                
                            },
                            title: {
                                display: true,
                                text: 'Nº de locaçoes - '+{{ date("Y") }},
                                font: {
                                    style: '',
                                    weight: '800',
                                    size:'16'
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                        max: 100,                                        
                                }
                            },
                        }
                    });              
                </script>
         </div>
    </div>
@endsection
