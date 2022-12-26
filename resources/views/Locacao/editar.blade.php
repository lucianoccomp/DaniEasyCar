<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="/locacao/editar/{{$locacao->id}}" method="POST">
		
    	@csrf
    	@method('PUT')

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Veículo</label>
			<select id="inputGroupSelect01" name="veiculo_id"  class="form-select" aria-label="Default select example" data-validation-required-message="Por favor, selecione um veículo." required>
                    <option value="">Escolha um veículo</option>                    
                @foreach ($veiculos as $veiculo)                
                    <option {!! $veiculo->id == $locacao->veiculo->id ? 'selected':'' !!} value="{{$veiculo->id}}">{{$veiculo->nome}}</option>
                @endforeach
            </select>			
  		</div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Cliente</label>
		    <select id="inputGroupSelect01" name="cliente_id"  class="form-select" aria-label="Default select example" data-validation-required-message="Por favor, selecione um cliente." required>
                    <option value="">Escolha um cliente</option>                    
                @foreach ($clientes as $cliente)                    
                    <option  {!! $cliente->id == $locacao->cliente->id ? 'selected':'' !!} value="{{$cliente->id}}">{{$cliente->nome}}</option>
                @endforeach
            </select>			
  	    </div>
        <div class="mb-3">
			<label for="InputDataLocacao" class="form-label">Data locação</label>
			<input name="datalocacao" type="text" class="form-control" id="InputDataLocacao" aria-describedby="dataLocacaoHelp" value="{{ date('d/m/Y', strtotime($locacao->datalocacao)) }}" required>
			<div id="datanLocacaoHelp" class="form-text"> Data da locação do veículo.</div>
  		</div>
        <div class="mb-3">
			<label for="InputDataDevolucao" class="form-label">Data devolução</label>
			<input name="datadevolucao" type="text" class="form-control" id="InputDataDevolucao" aria-describedby="datanDevolucaoHelp" value="{{ date('d/m/Y', strtotime($locacao->datadevolucao)) }}" required>
			<div id="datanDevolucaoHelp" class="form-text"> Data da devolução do veículo.</div>
  		</div>
        <div class="mb-3">
			<label for="InputValorContratado" class="form-label">Valor contratado</label>
			<input name="valorcontratado" type="text" class="form-control" id="InputValorContratado" aria-describedby="valorContratadoHelp" value="{{ $locacao->valorcontratado }}" required>
			<div id="valorContratadoHelp" class="form-text">Valor contratado.</div>
		</div>
        <div class="mb-3">
			<label for="InputValorAdicional" class="form-label">Valor adicional</label>
			<input name="valoradicional" type="text" class="form-control" id="InputValorAdicional" aria-describedby="valorAdicionalHelp" value="{{ $locacao->valoradicional }}" required>
			<div id="valorAdicionalHelp" class="form-text">Valor adicional.</div>
		</div>
        <div class="mb-3">
			<label for="InputValorDesconto" class="form-label">Valor desconto</label>
			<input name="valordesconto" type="text" class="form-control" id="InputValorDesconto" aria-describedby="valorDescontoHelp" value="{{ $locacao->valordesconto}}" required>
			<div id="valorDescontoHelp" class="form-text">Valor desconto.</div>
		</div>
        <div class="mb-3">
			<label for="InputValorTotal" class="form-label">Valor total</label>
			<input name="valortotal" type="text" class="form-control" id="InputValorTotal" aria-describedby="valorTotalHelp" value="{{ $locacao->valortotal }}" required>
			<div id="valorTotalHelp" class="form-text">O total é o resultado da soma do valor total mais o valor do adicional menos o desconto</div>
  		</div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupStatusPagamento">Status pagamento</label>
			<select id="inputGroupStatusPagamento" name="statuspagamento" class="form-select" aria-describedby="statusPagamentoHelp" required>                
                <option value="0" {{ $locacao->statuspagamento == 0 ? 'selected':'' }}>Pendente</option>
                <option value="1" {{ $locacao->statuspagamento == 1 ? 'selected':'' }}>Pago</option>                
            </select>			
  		</div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupStatusAluguel">Status aluguel</label>
			<select id="inputGroupStatusAluguel" name="statusaluguel" class="form-select" aria-describedby="statusAluguelHelp" required>                
                <option value="0" {{ $locacao->statuspagamento == 0 ? 'selected':'' }}>À vencer</option>
                <option value="1" {{ $locacao->statusaluguel == 1 ? 'selected':'' }}>Vencido</option>                
            </select>			
  		</div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupStatus">Status</label>
			<select id="inputGroupStatus" name="status" class="form-select" aria-describedby="statusHelp" required>                
                <option value="0" {{ $locacao->status == 0 ? 'selected':'' }}>Inativo</option>
                <option value="1" {{ $locacao->status == 1 ? 'selected':'' }}>Ativo</option>                
            </select>			
  		</div>
		<div class="mb-3">
        	<button type="submit" class="btn btn-primary">Atualizar</button>
		</div>
    </form>

	<script>

       $('#InputDataLocacao').datepicker({
            autoclose: true,
            language: 'pt-BR',
            format: "dd/mm/yyyy"            
        });

        $('#InputDataDevolucao').datepicker({
            autoclose: true,
            language: 'pt-BR',
            format: "dd/mm/yyyy"            
        });

        $("#InputValorContratado").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});

        $("#InputValorAdicional").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});

        $("#InputValorDesconto").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});


        $("#InputValorTotal").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});

        formato = "";

        formato = { 
	        minimumFractionDigits: 2, 
	        style: 'currency', 
	        currency: 'USD'
        }

        function calculoTotal() {

	        let valorContratado = $('#InputValorContratado').maskMoney('unmasked')[0];
            let valorAdicional= $('#InputValorAdicional').maskMoney('unmasked')[0];
            let valorDesconto = $('#InputValorDesconto').maskMoney('unmasked')[0];


	        if(!isNaN(valorContratado) && !isNaN(valorAdicional) && !isNaN(valorDesconto)){
		        $('#InputValorTotal').val(((valorContratado + valorAdicional) - valorDesconto).toLocaleString('en-US', formato));
            }
	    }

        $(document).on('keyup', '#InputValorContratado', calculoTotal);
        $(document).on('keyup', '#InputValorAdicional', calculoTotal);
        $(document).on('keyup', '#InputValorDesconto', calculoTotal);
      


        $('#InputDataDevolucao').on('change', function() {

            let dataLocacao = new Date($('#InputDataLocacao').val()); 
            let dataDevolucao = new Date($('#InputDataDevolucao').val());            

            if(dataLocacao >= dataDevolucao){
                alert("Datas locação e devolução inválidas! A data de devolução sempre será posterior à data de locação");
                $('#InputDataDevolucao').val("");
                $("#InputDataDevolucao").focus();
            }
            
        });

	</script>


</body>
</html>
