@extends('../layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                    <span><b>FLUXO DE CAIXA</b></span>
             </div>
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
        <div class="col-lg-8 d-flex justify-content-end">
            <form id="formLoc" method="get" class="row" >
                <div style="width:270px;" class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><b>Data</b></span>                
                    <input id="inputDateFinal" type="month" name="dataInicio" class="form-control" min="2022-01" max="2042-01" placeholder="{{ date('m') }}" aria-label="Username" aria-describedby="basic-addon1">
                </div>               
                <div style="width:200px;" class="input-group mb-3 ms-0">
                    <a class="btn btn-outline-secondary" href="/fluxocaixa" id="button-addon1"><b><i class="bi bi-text-left"></i> Listar mês atual</b></a>
                </div>
            </form>
        </div>
   </div>


   <div class="row">
        <div class="col">            
            <table class="table-responsivel  table-zebra">
                <thead>
                    <tr>
                        <td scope="col" colspan="3">
                           <b>Receitas Mensais</b>
                        </td>
                    </tr>
                    </tr>
                        <th>#</th>
                        <th scope="col" >Data</th>
                        <th scope="col">Receitas</th>                                                         
                    </tr>
                </thead>
                <tbody>
                    <tr class="ocultar">
                         <td data-label="RECEITAS MENSAIS" colspan="3">-----</td>
                    </tr>
                   
                    @if($receitasMensal)
                        @php $x = 1 @endphp
                        @foreach ($receitasMensal as $registro=>$item)                                                                               
                            <tr>
                                <td data-label="#">{{ $x }}</td>
                                <td data-label="Data" scope="row"><a title="Visualizar" value="Dados da receita" id="linkModal" class="noLink" data-bs-toggle="modal" data-attr="receita/ {{ $item["id"] }}" href="receita/{{ $item["id"] }}"><i class="bi bi-box-arrow-in-up-right"></i> {{ date('d/m/Y', strtotime($item["data"])) }}</a></td>
                                <td data-label="Receitas">$ {{ $item["valor"] }}</td>                               
                            </tr>
                            @php $x += 1 @endphp
                        @endforeach
                    @endif
                    <tr>
                        <td>-</td>
                        <td><b>Total:</b></td>
                        <td><b><h5 class="text-success">$ {{number_format($somaReceitaMensal,2)}}</b></td>
                    </tr>
                </tbody>
                <tfoot   
                </tfoot>
            </table>
        </div>

        <div class="col">
            <table class="table-responsivel  table-zebra">
                <thead>
                    <tr>
                        <td colspan="3">
                            <b>Despesas Mensais</b>
                        </td>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th scope="col" >Data</th>
                        <th scope="col">Despesas</th>                                                         
                    </tr>
                <thead>
                <tbody>
                    <tr class="ocultar">
                         <td data-label="DESPESAS MENSAIS" colspan="3">-----</td>
                    </tr>

                     @if($despesasMensal)
                        @php $y = 1 @endphp
                        @foreach ($despesasMensal as $registro=>$item)                                                                               
                            <tr>
                                <td data-label="#">{{ $y }}</td>
                                <td data-label="Data" scope="row"><a title="Visualizar" value="Dados da Despesa" id="linkModal" class="noLink" data-bs-toggle="modal" data-attr="despesa/ {{ $item["id"] }}" href="despesa/{{ $item["id"] }}"><i class="bi bi-box-arrow-in-up-right"></i> {{ date('d/m/Y', strtotime($item["data"])) }}</a></td>
                                <td data-label="Despesas">$ {{ $item["valor"] }}</td>                                                                                                
                            </tr>
                             @php $y += 1 @endphp
                        @endforeach
                    @endif
                    <tr>
                        <td>-</td>
                        <td><b>Total:</b></td>
                        <td><b><h5 class="text-danger">$ {{number_format($somaDespesaMensal,2)}}</b></td>
                    </tr>
                </tbody>           
            </table>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-3 mt-2">
        <div class="col text-center">
            <div class="card border-top-red">         
                <div class="card-body">
                <h6 class="card-title">Saldo mensal</h6>
                <p class="card-text"><b><h5 class="text-danger">$ {{ $totalReceitasDespesasMensal }}</h5></b></p>
                </div>
            </div>
        </div>

        <div class="col text-center">
            <div class="card border-top-green">          
              <div class="card-body">
                <h6 class="card-title">Saldo anual</h6>
                <p class="card-text"><b><h5 class="text-success">$ {{ $totalReceitasDespesasAnual }}</h5></b></p>
              </div>
            </div>
        </div>

        <div class="col text-center">
            <div class="card border-top-blue">          
              <div class="card-body">
                <h6 class="card-title">Fluxo de caixa</h6>
                <p class="card-text"><b><h5 class="text-primary"> $ {{ $fluxoCaixa }} </h5></b></p>
              </div>
            </div>
        </div>
    </div>

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

    <div class="d-flex">
  
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

