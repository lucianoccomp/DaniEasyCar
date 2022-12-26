<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="/despesa/editar/{{$despesa->id}}" method="POST">
		
    	@csrf
    	@method('PUT') 

		<div class="mb-3">
			<label for="InputDescricao" class="form-label">Descrição</label>
			<input name="descricao" type="text" class="form-control" id="InputDescricao" aria-describedby="descricaoHelp" value="{{ $despesa->descricao }}" required>
			<div id="descricaoHelp" class="form-text">Entre com a descrição da despesa.</div>
		</div>

		<div class="mb-3">
			<label for="InputValorUnitario" class="form-label">Valor unitário</label>
			<input name="valorUnitario" type="text" class="form-control" id="InputValorUnitario" aria-describedby="valorUnitarioHelp" value="{{ $despesa->valorUnitario }}" required>
			<div id="valorUnitarioHelp" class="form-text">Valor unitário da despesa.</div>
		</div>
		
		<div class="mb-3">
			<label for="Inputplaca" class="form-label">Quantidade</label>
			<input name="quantidade" type="text" class="form-control" id="InputQuantidade" aria-describedby="quantidadeHelp" value="{{ $despesa->quantidade }}" required>
			<div id="quantidadeHelp" class="form-text">Entre com a quantidade.</div>
  		</div>

		<div class="mb-3">
			<label for="InputValorTotal" class="form-label">Valor total</label>
			<input name="valorTotal" type="text" class="form-control" id="InputValorTotal" aria-describedby="valorTotalHelp" value="{{ $despesa->valorTotal }}" required>
			<div id="valorTotalHelp" class="form-text">O total é o resultado do valor unitário x quantidade</div>
  		</div>

		<div class="mb-3">
			<label for="InputData" class="form-label">Data</label>
			<input name="data" type="text" class="form-control" id="InputData" aria-describedby="datanHelp" value="{{ date('d/m/Y', strtotime($despesa->data)) }}" required>
			<div id="datanHelp" class="form-text"> Data do cadastro da despesa.</div>
  		</div>
         
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Veículo</label>
			<select id="inputGroupSelect01" name="veiculo_id"  class="form-select" aria-label="Default select example" data-validation-required-message="Por favor, selecione um veículo." required>
                    <option value="">Escolha um veículo</option>                    
                @foreach ($veiculos as $veiculo)                    
                    <option @if ($veiculo->id == $despesa->veiculo->id) selected @endif" value="{{$veiculo->id}}">{{$veiculo->nome}}</option>
                @endforeach
            </select>			
  		</div>      

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupStatus">Status</label>
			<select id="inputGroupStatus" name="status" class="form-select" aria-describedby="statusHelp" required>                
                <option value="0" {{ $despesa->status == 0 ? 'selected':'' }}>Inativo</option>
                <option value="1" {{ $despesa->status == 1 ? 'selected':'' }}>Ativo</option>                
            </select>			
  		</div>

		<div class="mb-3">
        	<button type="submit" class="btn btn-primary">Atualizar</button>
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
