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
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon1"><b><i class="bi bi-text-left"></i> Listar todos</b></button>  
                        <button class="btn btn-outline-secondary color1 text-white" type="submit" id="button-addon1"><i class="bi bi-search"></i> <b>Pesquisar</b></button>                        
                        <input name="filtro" type="text" class="form-control" placeholder=" Nome, descrição, placa, Id number..." aria-label="Example text with button addon" aria-describedby="button-addon1">                    
                     </div>
                </form>
            </div>            
        </div>
        <div class="col-lg-7 mb-3">            
            <div class="text-end">
                <a value="Cadastrar um novo veículo" class="btn btn-success" id="linkModal" data-attr="veiculo/novo" href="javascript:void(0)"> Cadastrar um novo veiculo</a>
            </div>
        </div>        
    </div>     

        <table class="table-responsivel table-zebra">
            <thead>
                <tr>
                    <th class="colNum" scope="col">#</th>
                    <th class="nome" scope="col">Veículo</th>
                    <!--<th scope="col">Descrição</th>
                    <th scope="col">Placa</th>-->
                    <th scope="col">Id number</th>
                    <th scope="col">Registration valid</th>
                    <th scope="col">Preço de compra</th>
                    <th class="colNum" scope="col">Status</th>                    
                    <th scope="col" class="text-center" width="280px">Ação</th>
                </tr>
            <thead>
            <tbody>
                @if($veiculos)
                    @php $x = 1 @endphp
                    @foreach ($veiculos as $veiculo)
                        <tr>
                            <td class="colNum" data-label="#" scope="row">{{ $x }}</td>                            
                            <td class="nome" data-label="nome" scope="row">
                            <p class="mb-1 nome-size"><b>{{ $veiculo->nome }}</b></p>
                            <p>Descrição: {{ $veiculo->descricao }}<br>
                               Placa: {{ $veiculo->placa }}</p>
                            </td>
                            <!--<td data-label="descricao">{{ $veiculo->descricao }}</td>
                            <td data-label="placa">{{ $veiculo->placa }}</td>-->
                            <td data-label="idnumber">{{ $veiculo->idnumber }}</td>
                            <td data-label="registrationvalid"> {{ date('d/m/Y', strtotime($veiculo->registrationvalid))  }}</td>
                            <td data-label="precocompra"> {{ '$ '.number_format($veiculo->precocompra, 2,".",",")  }}</td>
                            <td class="colNum" data-label="Status" style='{{ $veiculo->status == 0 ? "color:red":"color:blue" }}'><b>{{ $veiculo->status == 1 ? "Ativo":"Inativo" }}</b></td>                    
                            <td class="text-center">
                                <form action="veiculo/{{$veiculo->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')    
                          
                                    <a title="Visualizar" value="Dados do veículo" id="linkModal" data-bs-toggle="modal" data-attr="veiculo/{{$veiculo->id}}"  class="btn btn-warning btn-sm m-1" href="veiculo/{{$veiculo->ID}}"><i class="bi bi-file-text text-white"></i></a>
            
                                    <a title="Editar" value="Atualizar veículo" id="linkModal" class="btn btn-primary btn-sm m-1" data-attr="veiculo/{{$veiculo->id}}/edit" href="veiculo/{{$veiculo->id}}/edit"><i class="bi bi-pencil-square"></i></a>
                                    @can('admin')  
                                        <button title="Apagar" type="submit" class="btn btn-danger btn-sm m-1 "><i class="bi bi-trash"></i></button>
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
            @if($veiculos)  
                Resultados {{ $veiculos->count() }} de {{ $veiculos->total() }} ({{ $veiculos->firstItem() }} à {{ $veiculos->lastItem() }})
            @endif
        </div>

        <div class="col-lg-6 d-flex justify-content-end">
            @if($veiculos)
                {!! $veiculos->links() !!}
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

    </script>      

@endsection
