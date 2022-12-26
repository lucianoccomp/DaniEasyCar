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
                        <input name="filtro" type="text" class="form-control" placeholder=" Nome, email, CPF, endereco..." aria-label="Example text with button addon" aria-describedby="button-addon1">                    
                     </div>
                </form>
            </div>            
        </div>

        <div class="col-lg-7 mb-3">            
            <div class="text-end">
                <a value="Cadastrar um novo cliente" class="btn btn-success" id="linkModal" data-attr="cliente/novo" href="javascript:void(0)"> Cadastrar um novo cliente</a>
            </div>
        </div>
    </div>

    <table class="table-responsivel table-zebra">
        <thead>
            <tr>
                <th class="colNum" scope="col">#</th>
                <th class="nome" scope="col">Nome</th>
                <!--<th scope="col">CPF</th>
                <th scope="col">Email</th>-->
                <th scope="col">Telefone</th>
                <th class="nome" scope="col">Endereço</th>
                <th class="colNum" scope="col">status</th>
                <th scope="col" class="text-center" width="230px">Ação</th>
            </tr>
        <thead>
        <tbody>
            @if($clientes)
                @php $x = 1 @endphp
                @foreach ($clientes as $cliente)                    
                    <tr>
                        <td class="colNum" data-label="#" scope="row">{{ $x }}</td>
                        <td class="nome" data-label="nome" scope="row">
                            <p class="mb-1 nome-size"><b>{{ $cliente->nome }}</b></p>
                            <p>CPF: {{ $cliente->cpf }}<br>
                                Email: {{ $cliente->email }}</p>
                        </td>
                        <!--  <td data-label="cpf"></td>
                        <td data-label="email"></td>-->
                        <td data-label="telefone">{{ $cliente->telefone }}</td>
                        <td class="nome" data-label="endereco"> {{ $cliente->endereco }}</td>
                        <td class="colNum" data-label="status" style='{{ $cliente->status == 0 ? "color:red":"color:blue" }}'><b>{{ $cliente->status == 1 ? "Ativo":"Inativo" }}</b></td>
                        <td class="text-center">
                            <form action="cliente/{{$cliente->id}}" method="POST">
                                @csrf
                                @method('DELETE')    
                                <!-- <i class="fa-sharp fa-solid fa-eye"></i> -->
                                <a title="Visualizar" value="Dados do cliente" id="linkModal" data-bs-toggle="modal" data-attr="cliente/{{$cliente->id}}"  class="btn btn-warning btn-sm m-1 text-white" href="cliente/{{$cliente->id}}"><i class="bi bi-file-text text-white"></i></a>
            
                                <a title="Editar" value="Atualizar cliente" id="linkModal" class="btn btn-primary btn-sm m-1" data-attr="cliente/{{$cliente->id}}/edit" href="cliente/{{$cliente->id}}/edit"><i class="bi bi-pencil-square"></i></a>
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
            @if($clientes)  
                Resultados {{ $clientes->count() }} de {{ $clientes->total() }} ({{ $clientes->firstItem() }} à {{ $clientes->lastItem() }})
            @endif
        </div>

        <div class="col-lg-6 d-flex justify-content-end">
            @if($clientes)
                {!! $clientes->links() !!}
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
