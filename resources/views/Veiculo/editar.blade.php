<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="/veiculo/editar/{{$veiculo->id}}" method="POST" enctype="multipart/form-data">
		
    	@csrf
    	@method('PUT') 

		<div class="mb-3">
			<label for="InputNome" class="form-label">Nome</label>
			<input name="nome" type="text" class="form-control" id="InputNome" aria-describedby="nomeHelp" value="{{ $veiculo->nome }}" required>
			<div id="nomeHelp" class="form-text">Digita o nome completo.</div>
		</div>

		<div class="mb-3">
			<label for="InputDescricaoMask" class="form-label">Descrição</label>
			<input name="descricao" type="text" class="form-control" id="InputDescricaoMask" aria-describedby="descricaoHelp" value="{{ $veiculo->descricao }}" required>
			<div id="descricaoHelp" class="form-text">Descrição do veículo.</div>
		</div>
		
		<div class="mb-3">
			<label for="Inputplaca" class="form-label">Placa</label>
			<input name="placa" type="text" class="form-control" id="Inputplaca" aria-describedby="placaHelp" value="{{ $veiculo->placa }}" required>
			<div id="placaHelp" class="form-text">Entre com uma placa válida.</div>
  		</div>

		<div class="mb-3">
			<label id="InputIdNumber" for="InputIdNumber" class="form-label">Id Number</label>
			<input name="idnumber" type="text" class="form-control" id="InputIdNumberMask" aria-describedby="idNumberHelp" value="{{ $veiculo->idnumber }}" required>
			<div id="idNumberHelp" class="form-text">Ex.: Id de identificação do veículo.</div>
  		</div>

		<div class="mb-3">
			<label for="InputRegistrationValid" class="form-label">Registration Valid</label>
			<input name="registrationvalid" type="text" class="form-control" id="InputRegistrationValid" aria-describedby="registrationHelp" value="{{ $veiculo->registrationvalid }}" required>
			<div id="registrationHelp" class="form-text">Ex.: Data de validade do registro.</div>
  		</div>

          <div class="mb-3">
			<label for="InputPrecoCompra class="form-label">Preço de compra</label>
			<input name="precocompra" type="text" class="form-control" id="InputPrecoCompra" aria-describedby="precoCompraHelp" value="{{ $veiculo->precocompra }}" required>
			<div id="precoCompraHelp" class="form-text">Ex.: Rua 10, N° 365, Bairro Neblina.</div>
  		</div>
        
        <div class="mb-3">
			<label for="InputDataCompra" class="form-label">Data compra</label>
			<input name="datacompra" type="text" class="form-control" id="InputDataCompra" aria-describedby="dataCompraHelp" value="{{ $veiculo->datacompra }}" required>
			<div id="dataCompraHelp" class="form-text">Ex.: Data da compra do veículo.</div>
  		</div>

        <div class="mb-3">
			<label for="InputPrecoLocacaoSemana" class="form-label">Valor Locação por Semana</label>
			<input name="precolocacaosemana" type="text" class="form-control" id="InputPrecoLocacaoSemana" aria-describedby="locacaoSemanaHelp" value="{{ $veiculo->precolocacaosemana }}" required>
			<div id="locacaoSemanaHelp" class="form-text">Ex.: Valor da locação do veículo por semana. </div>
  		</div>

        <div class="mb-3">
			<label for="InputEndereco" class="form-label">Milhagem</label>
			<input name="milhagem" type="text" class="form-control" id="InputEndereco" aria-describedby="milhagemHelp" value="{{ $veiculo->milhagem }}" required>
			<div id="milhagemHelp" class="form-text">Ex.: Milhagem do veículo.</div>
  		</div>

          <div class="mb-3 text-center">
			<!-- <label for="InputFoto" class="form-label">Foto</label> -->
			<!-- <input name="foto" type="text" class="form-control" id="InputFoto" aria-describedby="fotoHelp" value="{{ $veiculo->foto }}" required> -->
            <img id="Foto" src="{{asset('storage/fotos/'.$veiculo->foto)}}" aria-describedby="fotoHelp"   height="200px" width="auto" alt="Italian Trulli" required>
			<div id="fotoHelp" class="form-text">Foto do veículo.</div>
			<input name="foto" type="file" class="form-control" id="InputFoto" aria-describedby="fotoHelpInput" value="{{ $veiculo->foto }}">
			<div id="fotoHelpInput" class="form-text"></div>
  		</div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupStatus">Status</label>
			<select id="inputGroupStatus" name="status" class="form-select" aria-describedby="statusHelp" required>                
                <option value="0" {{ $veiculo->status == 0 ? 'selected':'' }}>Inativo</option>
                <option value="1" {{ $veiculo->status == 1 ? 'selected':'' }}>Ativo</option>                
            </select>			
  		</div>

		<div class="mb-3">
        	<button type="submit" class="btn btn-primary">Atualizar</button>
		</div>
    </form>

	<script>
		$(document).ready(function(){
  			//$('#birth-date').mask('00/00/0000');
  			$('#InputTelefoneMask').mask('(000) 000-0000');			
			$('#InputCPFMask').mask('000.000.000-00');	
		});

	</script>


</body>
</html>
