@extends('../layout')

@section('content')

    @if ($message = Session::get('success'))
        <div class="row" id="success-alert">
            <div class="alert alert-success" role="alert">
                <b>{{ $message }}</b>
            </div>
        </div>
    @endif
    @if ($error = Session::get('error'))
        <div class="row" id="error-alert">
            <div class="alert alert-danger">
                <b>{{ $error }}</b>
            </div>
      </div>
    @endif

    <div class="row mt-4">
        <div class="col-lg-5 mb-0">
            <div class="text-start">
                <form method="get" > 
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-secondary" href="/locacoes" id="button-addon1"><b><i class="bi bi-text-left"></i> Listar todos</b></a>  
                        <button class="btn btn-outline-secondary color1 text-white" type="submit" id="button-addon1"><i class="bi bi-search"></i> <b>Pesquisar</b></button>                        
                        <input name="filtro" type="text" class="form-control" placeholder=" Veiculo, cliente, status pagamento, status aluguel..." aria-label="Example text with button addon" aria-describedby="button-addon1">                    
                     </div>
                </form>
            </div>            
        </div>
        
        <div class="col-lg-4 d-flex justify-content-end">
            <form id="formLoc" method="get" class="row" >
                <div style="width:210px;" class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><b>De</b></span>                
                    <input type="date" name="dataInicio" class="form-control"  placeholder="{{ date('d/m/Y') }}" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div style="width:215px;" class="input-group mb-3 ms-3">                
                    <span class="input-group-text" id="basic-addon2"><b>Até</b></span>
                    <input id="inputDateFinal" type="date" name="dataFim"  class="form-control" placeholder="{{ date('d/m/Y') }}" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </form>
        </div>       

        <div class="col-lg-3 mb-3">             
            <div class="text-end">
                <a value="Cadastrar uma nova locacao" class="btn btn-success" id="linkModal" data-attr="locacao/nova" href="javascript:void(0)"> Cadastrar uma nova locação.</a>
            </div>
        </div>
    </div>
       

    <table class="table-responsivel table-zebra">
        <thead>
            <tr>
                <th class="colNum" scope="col">#</th>
                <th class="nome" scope="col">Veículo</th>
                <th class="nome" scope="col">Cliente</th>
                <th class="nome" scope="col">Datas </th>              
                <th class="nome" scope="col">Valores</th>
                <th scope="col">Valor total</th>                
                <th scope="col">Status </th>                
                <th scope="col" class="text-center" width="280px">Ação</th>
            </tr>
        <thead>
        <tbody>
            @if($locacoes)
                @php $x = 1 @endphp
                @foreach ($locacoes as $locacao)
                    <tr>
                        <td class="colNum" data-label="#" scope="row">{{ $x }}</td>
                        <td class='nome nome-size' data-label="veiculo"><b>{{ $locacao->veiculo->nome }}</b></td>
                        <td class="nome nome-size" data-label="cliente"><b>{{ $locacao->cliente->nome }}</b></td>

                        <!--<td data-label="datalocacao">{{ date('d/m/Y', strtotime($locacao->datalocacao)) }}</td>
                        <td data-label="datadevolucao">{{ date('d/m/Y', strtotime($locacao->datadevolucao)) }}</td>-->

                        <td class="nome" data-label="datas" scope="row">                            
                            <p>
                                <b>Locação:</b> <span class="ms-1"> {{ date('d/m/Y', strtotime($locacao->datalocacao)) }}</span><br>
                                <b>Devolução:</b><span class="ms-1"> {{ date('d/m/Y', strtotime($locacao->datadevolucao)) }}</span>
                                @if($locacao->datadevolucao >= date('Y-m-d') && $locacao->statusaluguel == 0)
                                    <span>Atenção: <b class='text-danger text-small'>aluguel vencido!</b></span>
                                @endif
                            </p>
                        </td>

                        <td class="nome" data-label="datas" scope="row">                            
                            <p>
                                <b>Contratado:</b><span class="ms-1"> {{ '$ '.number_format($locacao->valorcontratado, 2,".",",")  }}</span><br>
                                <small class="text-small">(+) Adicional:</small> <span class="ms-1">{{ '$ '.number_format($locacao->valoradicional, 2,".",",")  }}</span><br>
                                <small class='text-smal'>( - ) Desconto:</small> <span class="ms-1">{{ '$ '.number_format($locacao->valordesconto, 2,".",",")  }}</span>
                            </p>
                        </td>                        

                        <td data-label="valortotal">{{ '$ '.number_format($locacao->valortotal, 2,".",",")  }}</td>                                               

                        <td class="nome" data-label="datas" scope="row">
                            <p>
                                
                                <span ><b>Pagamento:</b></span> <b class="ms-1" style='{{ $locacao->statuspagamento == 0 ? "color:red":"color:blue" }}'>{{ $locacao->statuspagamento == 0 ? "pendente":"pago" }}</b><br>
                                <span><b>Aluguel:</b></span> <b class="ms-1" style='{{ $locacao->statusaluguel == 0 ? "color:blue":"color:red" }}'>{{ $locacao->statusaluguel == 0 ? "à vencer":"vencido" }}</b><br>
                                 Pode excluir: <b class="ms-2" style='{{ $locacao->status == 0 ? "color:red":"color:blue" }}'> {{ $locacao->status == 1 ? "Não":"Sim" }}</b>
                            </p>
                        </td>
                        
                        <td class="text-center">
                            <form action="locacao/{{$locacao->id}}" method="POST">
                                @csrf
                                @method('DELETE')    
                                <!-- <i class="fa-sharp fa-solid fa-eye"></i> -->
                                <a title="Visualizar" value="Dados da locação" id="linkModal" data-bs-toggle="modal" data-attr="locacao/{{$locacao->id}}"  class="btn btn-warning btn-sm m-1 text-white" href="locacao/{{$locacao->id}}"><i class="bi bi-file-text text-white"></i></a>
            
                                <a title="Editar" value="Atualizar locação" id="linkModal" class="btn btn-primary btn-sm m-1" data-attr="locacao/{{$locacao->id}}/edit" href="locacao/{{$locacao->id}}/edit"><i class="bi bi-pencil-square"></i></a>

                                @can('admin')  
                                <button title="Apagar" type="submit" class="btn btn-danger btn-sm m-1"><i class="bi bi-trash"></i></button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                    @php $x += 1 @endphp
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div style="background-color: #414c8c; color:white;" class="modal-header">
                <h5 id="titleModal" class="modal-title" id="exampleModal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="smallBody">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>            
            </div>
            </div>
        </div>
    </div>

    <div class="row my-2">        
        <div class="col-lg-6 mb-0">
            @if($locacoes)  
                Resultados {{ $locacoes->count() }} de {{ $locacoes->total() }} ({{ $locacoes->firstItem() }} à {{ $locacoes->lastItem() }})
            @endif
        </div>

        <div class="col-lg-6 d-flex justify-content-end">
            @if($locacoes)
                {!! $locacoes->links() !!}
            @endif
        </div>
    </div>

    <script>
            // display a modal (small modal)
            $(document).on('click', '#linkModal', function(event) {
                event.preventDefault();
                let href = $(this).attr('data-attr');   
                let title = $(this).attr('value');
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    // return the result
                    success: function(result) {
                        $('#Modal').modal("show");
                        $('#titleModal').html(title).show()
                        $('#smallBody').html(result).show();
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Pagína " + href + " não pode abrir. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            });
        
            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                $("#success-alert").slideUp(500);
            });

            $("#error-alert").fadeTo(5000, 500).slideUp(500, function(){
                $("#error-alert").slideUp(500);
            });

            $("#inputDateFinal").blur(function() {
                $("#formLoc").submit();
            });

    </script>      

@endsection
