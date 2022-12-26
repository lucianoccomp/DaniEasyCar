<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="receita/cadastrar" method="POST">
    
		@csrf 
		<input type="hidden" name="status" value="1" />

		<div class="mb-3">
			<label for="InputDescricao" class="form-label">Descrição</label>
			<input name="descricao" type="text" class="form-control" autocomplete="off" id="InputDescricao" aria-describedby="descricaoHelp" required>
			<div id="descricaoHelp" class="form-text">Digita alguma descrição.</div>
		</div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Veículo</label>
			<select name="veiculo_id"  class="form-select" aria-label="Default select example" data-validation-required-message="Por favor, selecione um estado." required>
                    <option value="">Escolha um veículo</option>                    
                @foreach ($veiculos as $veiculo)
                    <option value="{{$veiculo->id}}">{{$veiculo->nome}}</option>
                @endforeach
            </select>			
  		</div>

		<div class="mb-3">
			<label for="InputValor" class="form-label">Valor</label>
			<input name="valor" type="text" class="form-control" autocomplete="off" id="InputValor" aria-describedby="ValoroHelp" required>
			<div id="ValorUnitarioHelp" class="form-text">Entre com algum valor.</div>
		</div>		

		<div class="mb-3">
			<label for="InputData" class="form-label">Data</label>
			<input name="data" type="text" class="form-control" autocomplete="off" id="InputData" aria-describedby="dataHelp" required>            
            <div id="dataHelp" class="form-text">Data do cadastro da despesa.</div>
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

        $("#InputValor").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});        

	</script>

</body>
</html>
