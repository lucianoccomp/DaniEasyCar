<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="locacao/cadastrar" method="POST">
		
		@csrf 

		<input type="hidden" name="status" value="1" />
        <input type="hidden" name="statuspagamento" value="0" />
        <input type="hidden" name="statusaluguel" value="0" />

        <div class="mb-3">
			<label for="InputDataLocacao" class="form-label">Data da locação</label>            
			<input name="datalocacao" type="text" class="form-control" autocomplete="off" id="InputDataLocacao" aria-describedby="dataLocacaoHelp" required>            
            <div id="dataLocacaoHelp" class="form-text">Data da locação do veículo.</div>
  		</div>

        <div class="mb-3">
			<label for="InputDataDevolucao" class="form-label">Data da devolução</label>            
			<input name="datadevolucao" type="text" class="form-control" autocomplete="off" id="InputDataDevolucao" aria-describedby="dataDevolucaoHelp" required>            
            <div id="dataDevolucaoHelp" class="form-text">Data da devolução do veículo.</div>
  		</div>

		<div class="mb-3">
			<label for="InputValorContratado" class="form-label">Valor contratado</label>
			<input name="valorcontratado" type="text" class="form-control" autocomplete="off" id="InputValorContratado" aria-describedby="valorContratadoHelp" required>
			<div id="valorContratadoHelp" class="form-text">Digita o valor contratado.</div>
		</div>

		<div class="mb-3">
			<label for="InputValorAdicional" class="form-label">Valor adicional</label>
			<input name="valoradicional" type="text" class="form-control" autocomplete="off" id="InputValorAdicional" aria-describedby="ValorAdicionalHelp">
			<div id="ValorAdicionalHelp" class="form-text">Entre com algum valor adicional.</div>
		</div>

        <div class="mb-3">
			<label for="InputValorDesconto" class="form-label">Valor desconto</label>
			<input name="valordesconto" type="text" class="form-control" autocomplete="off" id="InputValorDesconto" aria-describedby="ValorDescontoHelp">
			<div id="ValorDescontoHelp" class="form-text">Entre com algum valor do desconto.</div>
		</div>

        <div class="mb-3">
			<label for="InputValorTotal" class="form-label">Valor total</label>
			<input name="valortotal" type="text" class="form-control" autocomplete="off" id="InputValorTotal" aria-describedby="ValorTotalHelp" required>
			<div id="ValorTotalHelp" class="form-text">Entre com o valor total.</div>
		</div>				

        <div class="mb-3">
			<div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Cliente</label>
			    <select id="inputGroupSelect01" name="cliente_id"  class="form-select" aria-label="Default select example" data-validation-required-message="Por favor, selecione um cliente." required>
                        <option value="">Escolha um cliente</option>                    
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                    @endforeach
                </select>			    
            </div>
  		</div>

        <div class="mb-3">
			<div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Veículo</label>
			    <select id="inputGroupSelect01" name="veiculo_id"  class="form-select" aria-label="Default select example" data-validation-required-message="Por favor, selecione um veículo." required>
                        <option value="">Escolha um veículo</option>                    
                    @foreach ($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}">{{$veiculo->nome}}</option>
                    @endforeach
                </select>			    
            </div>
  		</div>

		<div class="mb-3">
        	<button type="submit" class="btn btn-primary">Cadastrar</button>
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
