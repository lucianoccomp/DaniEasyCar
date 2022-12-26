<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="despesa/cadastrar" method="POST">
		
		@csrf 

		<input type="hidden" name="status" value="1" />

		<div class="mb-3">
			<label for="InputDescricao" class="form-label">Descrição</label>
			<input name="descricao" type="text" class="form-control" autocomplete="off" id="InputDescricao" aria-describedby="descricaoHelp" required>
			<div id="descricaoHelp" class="form-text">Digita alguma descrição.</div>
		</div>

		<div class="mb-3">
			<label for="InputValorUnitario" class="form-label">Valor unitário</label>
			<input name="valorUnitario" type="text" class="form-control" autocomplete="off" id="InputValorUnitario" aria-describedby="ValorUnitarioHelp" required>
			<div id="ValorUnitarioHelp" class="form-text">Entre com algum valor da unidade.</div>
		</div>
		
		<div class="mb-3">
			<label for="InputQuantidade" class="form-label">Quantidade</label>
			<input id="InputQuantidade" name="quantidade" type="text" maxlength="10" class="form-control" autocomplete="off"  aria-describedby="quantidadeHelp" required>
			<div id="quantidadeHelp" class="form-text">Entre com a qualidade.</div>
  		</div>

		<div class="mb-3">
			<label for="InputTelefone" class="form-label">Valor total</label>
			<input name="valorTotal" type="text" class="form-control" autocomplete="off" id="InputValorTotal" aria-describedby="valorTotalHelp" required>
			<div id="valorTotalHelp" class="form-text">O valor total é o resultado de valor unitário x quantidade</div>
  		</div>

		<div class="mb-3">
			<label for="InputData" class="form-label">Data</label>            
			<input name="data" type="text" class="form-control" autocomplete="off" id="InputData" aria-describedby="dataHelp" required>            
            <div id="dataHelp" class="form-text">Data do cadastro da despesa.</div>
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

        $('#InputData').datepicker({
            autoclose: true,
            language: 'pt-BR',
            format: "dd/mm/yyyy"            
        });

        $("#InputValorUnitario").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});

        $("#InputValorTotal").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});
         

        const format = { 
	        minimumFractionDigits: 2, 
	        style: 'currency', 
	        currency: 'USD'
        }

        function calculoTotal() {

	        let valorUnitario = $('#InputValorUnitario').maskMoney('unmasked')[0];
	        let quantidade = parseFloat($('#InputQuantidade').val());

	        if(!isNaN(valorUnitario) && !isNaN(quantidade)){
		        $('#InputValorTotal').val((valorUnitario * quantidade).toLocaleString('en-US', format));
            }
	    }

        $(document).on('keyup', '#InputValorUnitario', calculoTotal);
        $(document).on('keyup', '#InputQuantidade', calculoTotal);

	</script>

</body>
</html>
