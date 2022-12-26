@extends('../layout')

@section('content')

    <div class="row">        
        <div class="text-center">
            <span><b>DESPESAS</b></span>
        </div>        
    </div>

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

        <div class="col-lg-4 mb-0">
            <div class="text-start">
                <form method="get" > 
                    <div class="input-group mb-3">
                        <a class="btn btn-outline-secondary" href="/despesas" id="button-addon1"><b><i class="bi bi-text-left"></i> Listar todos</b></a>  
                        <button class="btn btn-outline-secondary color1 text-white" type="submit" id="button-addon1"><i class="bi bi-search"></i> <b>Pesquisar</b></button>                        
                        <input name="filtro" type="text" class="form-control" placeholder="Veiculo, status ..." aria-label="Example text with button addon" aria-describedby="button-addon1">                    
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
            
        <div class="col-lg-4 mb-3">        
            <div class="text-end">
                <a value="Cadastrar uma nova despesa" class="btn btn-success" id="linkModal" data-attr="despesa/nova" href="javascript:void(0)"> Cadastrar uma nova despesa</a>
            </div>
        </div>
    </div>    

    <table class="table-responsivel table-zebra">
        <thead>
            <tr>
                <th class="colNum" scope="col">#</th>
                <th class="nome" scope="col">Descrição</th>
                <th scope="col">Veículo</th>
                <th scope="col">Valor unitário</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor total</th>
                <th scope="col">Data</th>                                    
                <th class="colNum" scope="col">Status</th>
                <th scope="col" class="text-center" width="280px">Ação</th>
            </tr>
        <thead>
        <tbody>
            @if($despesas)
                @php $x = 1 @endphp
                @foreach ($despesas as $despesa)
                    <tr>
                        <td class="colNum" data-label="#" scope="row">{{ $x }}</td>
                        <td class="nome" data-label="descricao" scope="row"><b>{{ $despesa->descricao }}</b></td>
                        <td data-label="veiculo">{{ $despesa->veiculo->nome }}</td>                                                       
                        <td data-label="valor">{{ '$ '.number_format($despesa->valorUnitario, 2,".",",")  }}</td>
                        <td data-label="valor">{{ $despesa->quantidade }}</td>
                        <td data-label="valor">{{ '$ '.number_format($despesa->valorTotal, 2,".",",")  }}</td>
                        <td data-label="data">{{ date('d/m/Y', strtotime($despesa->data)) }}</td>                        
                        <td class="colNum" data-label="status" style='{{ $despesa->status == 0 ? "color:red":"color:blue" }}'><b>{{ $despesa->status == 1 ? "Ativo":"Inativo" }}</b></td>
                        <td class="text-center">
                            <form action="despesa/{{$despesa->id}}" method="POST">
                                @csrf
                                @method('DELETE')    
                                <!-- <i class="fa-sharp fa-solid fa-eye"></i> -->
                                <a title="Visualizar" value="Dados da despesa" id="linkModal" data-bs-toggle="modal" data-attr="despesa/{{$despesa->id}}"  class="btn btn-warning btn-sm m-1 text-white" href="despesa/{{$despesa->id}}"><i class="bi bi-file-text text-white"></i></a>
            
                                <a title="Editar" value="Atualizar despesa" id="linkModal" class="btn btn-primary btn-sm m-1" data-attr="despesa/{{$despesa->id}}/edit" href="despesa/{{$despesa->id}}/edit"><i class="bi bi-pencil-square"></i></a>
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
            @if($despesas)  
                Resultados {{ $despesas->count() }} de {{ $despesas->total() }} ({{ $despesas->firstItem() }} à {{ $despesas->lastItem() }})
            @endif
        </div>

        <div class="col-lg-6 d-flex justify-content-end">
            @if($despesas)
                {!! $despesas->links() !!}
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
