<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="/cliente/editar/{{$cliente->id}}" method="POST">
		
		@csrf
		@method('PUT') 

		<div class="mb-3">
			<label for="InputNome" class="form-label">Nome</label>
			<input name="nome" type="text" class="form-control" id="InputNome" aria-describedby="nomeHelp" value="{{ $cliente->nome }}" required>
			<div id="nomeHelp" class="form-text">Digita o nome completo.</div>
		</div>

		<div class="mb-3">
			<label for="InputCPF" class="form-label">CPF</label>
			<input name="cpf" type="text" class="form-control" id="InputCPFMask" aria-describedby="CPFHelp" value="{{ $cliente->cpf }}" required>
			<div id="CPFHelp" class="form-text">Ex.: 000.000.000-00</div>
		</div>
		
		<div class="mb-3">
			<label for="InputEmail1" class="form-label">Email</label>
			<input name="email" type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" value="{{ $cliente->email }}" required>
			<div id="emailHelp" class="form-text">Entre com um email válido.</div>
  		</div>

		<div class="mb-3">
			<label id="InputTelefone" for="InputTelefone" class="form-label">Telefone</label>
			<input name="telefone" type="text" class="form-control" id="InputTelefoneMask" aria-describedby="TelefoneHelp" value="{{ $cliente->telefone }}" required>
			<div id="TelefoneHelp" class="form-text">Ex.: (000) 000-0000</div>
  		</div>

		<div class="mb-3">
			<label for="InputEndereco" class="form-label">Endereço</label>
			<input name="endereco" type="text" class="form-control" id="InputEndereco" aria-describedby="enderecoHelp" value="{{ $cliente->endereco }}" required>
			<div id="enderecoHelp" class="form-text">Ex.: Rua 10, N° 365, Bairro Neblina.  </div>
  		</div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Status</label>			
			<select name="status" class="form-select" aria-describedby="statusHelp" required>                
                <option value="0" {{ $cliente->status == 0 ? 'selected':'' }}>Inativo</option>
                <option value="1" {{ $cliente->status == 1 ? 'selected':'' }}>Ativo</option>                
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
