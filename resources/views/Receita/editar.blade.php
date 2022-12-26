<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="/receita/editar/{{$receita->id}}" method="POST">
		
    	@csrf
    	@method('PUT') 

		<div class="mb-3">
			<label for="InputDescricao" class="form-label">Descrição</label>
			<input name="descricao" type="text" class="form-control" id="InputDescricao" aria-describedby="descricaoHelp" value="{{ $receita->descricao }}" required>
			<div id="descricaoHelp" class="form-text">Entre com a descrição da despesa.</div>
		</div>

        <div class="input-group mb-3">        
            <label class="input-group-text" for="inputGroupSelect01">Veículo</label>			
			<select id="inputGroupSelect01" name="veiculo_id"  class="form-select" aria-label="Default select example" data-validation-required-message="Por favor, selecione um veículo." required>
                    <option value="">Escolha um veículo</option>                    
                @foreach ($veiculos as $veiculo)
                    
                    <option @if ($veiculo->id == $receita->veiculo->id) selected @endif" value="{{$veiculo->id}}">{{$veiculo->nome}}</option>
                @endforeach
            </select>			
  		</div>  

		<div class="mb-3">
			<label for="InputValor" class="form-label">Valor</label>
			<input name="valor" type="text" class="form-control" id="InputValor" aria-describedby="valorHelp" value="{{ $receita->valor}}" required>
			<div id="valorHelp" class="form-text">Valor da receita.</div>
		</div>		

		<div class="mb-3">
			<label for="InputData" class="form-label">Data</label>
			<input name="data" type="text" class="form-control" id="InputData" aria-describedby="datanHelp" value="{{ date('d/m/Y', strtotime($receita->data)) }}" required>
			<div id="datanHelp" class="form-text"> Data do cadastro da despesa.</div>
  		</div>                    

        <div class="input-group mb-3">            
			<label class="input-group-text" for="inputGroupStatus">Status</label>
			<select id="inputGroupStatus" name="status" class="form-select" aria-describedby="statusHelp" required>                
                <option value="0" {{ $receita->status == 0 ? 'selected':'' }}>Inativo</option>
                <option value="1" {{ $receita->status == 1 ? 'selected':'' }}>Ativo</option>                
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

        $("#InputValor").maskMoney({
				prefix: "$ ",
				decimal: ".",
				thousands: ","
     	});        

	</script>

</body>
</html>
