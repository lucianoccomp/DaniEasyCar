<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form class="needs-validation"  action="/veiculo/cadastrar" method="POST" enctype="multipart/form-data">	
		
		@csrf 

		<input type="hidden" name="status" value="1" />

		<div class="mb-3">
			<label for="InputNome" class="form-label">Nome</label>
			<input name="nome" type="text" class="form-control" id="InputNome" aria-describedby="nomeHelp" autocomplete="off" required>
			<div id="nomeHelp" class="form-text">Ex.: Gol G4 CHEVROLET</div>
		</div>				

		<div class="mb-3">
			<label for="InputDescricao" class="form-label">Descrição</label>			
			<input name="descricao" type="text" class="form-control" id="InputDescricao" aria-describedby="descricaoHelp" autocomplete="off" required>
			<div id="descricaoHelp" class="form-text">Ex.: entre com a descricão do veículo</div>							
		</div>
		
		<div class="mb-3">
			<label for="InputPlaca" class="form-label">Placa</label>
			<input name="placa" type="text" class="form-control" id="InputPlaca" aria-describedby="placaHelp" autocomplete="off" required>
			<div id="placaHelp" class="form-text">Entre com uma placa válida.</div>
  		</div>

		<div class="mb-3">
			<label id="InputIdNumberMask" for="InputIdNumber" class="form-label">ID Number</label>
			<input name="idnumber" type="text" class="form-control" id="InputIdNumberMask" aria-describedby="IdNumberHelp" autocomplete="off" required>
			<div id="IdNumberHelp" class="form-text">Ex.: (000) 000-0000</div>
  		</div>

		<div class="mb-3">
			<label for="InputRegistrationValid" class="form-label">Registration Valid</label>
			<input name="registrationvalid" type="text" class="form-control" id="InputRegistrationValid" aria-describedby="registrationValidHelp" autocomplete="off" required>
			<div id="registrationValidHelp" class="form-text">Ex.: Data de validade do registro do veículo. </div>
  		</div>

        <div class="mb-3">
			<label for="InputPrecoCompraMask" class="form-label">Preço de Compra</label>
			<input name="precocompra" type="text" class="form-control" id="InputPrecoCompraMask" aria-describedby="InputPrecoCompraHelp" autocomplete="off" required>
			<div id="InputPrecoCompraHelp" class="form-text">Ex.: Valor do veículo comprado. </div>
  		</div>

        <div class="mb-3">
			<label for="InputDataCompra" class="form-label">Data da compra</label>
			<input name="datacompra" type="text" class="form-control" id="InputDataCompra" aria-describedby="InputDataCompraHelp" autocomplete="off" required>
			<div id="InputDataCompraHelp" class="form-text">Ex.: Data em que o veículo foi comprado. </div>
  		</div>

          <div class="mb-3">
			<label for="InputprecolocacaosemanaMask" class="form-label">Preço da locação</label>
			<input name="precolocacaosemana" type="text" class="form-control" id="InputprecolocacaosemanaMask" aria-describedby="InputprecolocacaosemanaHelp" autocomplete="off" required>
			<div id="InputprecolocacaosemanaHelp" class="form-text">Ex.: Entre com o preço da locação por semana. </div>
  		</div>

        <div class="mb-3">
			<label for="InputMilhagem" class="form-label">Milhagem</label>
			<input name="milhagem" type="text" maxlength="10" class="form-control" id="InputMilhagem" aria-describedby="InputMilhagemHelp" autocomplete="off" required>
			<div id="InputMilhagemHelp" class="form-text">Ex.: Milhagem do veículo. </div>
  		</div>

        <div class="mb-3">
            <label for="inputFoto" class="form-label">Carregar foto do veículo</label>
            <input name="foto" class="form-control" type="file" id="inputFoto" aria-describedby="InputFotoHelp" autocomplete="off" required>
            <div id="InputFotoHelp" class="form-text">Escolha uma foto para o veículo. </div>
        </div>

		<div class="mb-3">
        	<button type="submit" class="btn btn-primary">Cadastrar</button>
		</div>
    </form>

	<script>
		$(document).ready(function(){  			
			$('InputMilhagem').mask('0000000000');
			
			$("#InputPrecoCompraMask").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     		});
			 
			 $("#InputprecolocacaosemanaMask").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     		});

        $('#InputDataCompra').datepicker({
            autoclose: true,
            language: 'pt-BR',
            format: "dd/mm/yyyy"            
        });

        $('#InputRegistrationValid').datepicker({
            autoclose: true,
            language: 'pt-BR',
            format: "dd/mm/yyyy"            
        });


		});       
	</script>
</body>
</html>
