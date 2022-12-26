<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="/fornecedor/editar/{{$fornecedor->id}}" method="POST">
		
		@csrf
		@method('PUT') 

		<div class="mb-3">
			<label for="InputNome" class="form-label">Nome do fornecedor</label>
			<input name="nomefornecedor" type="text" class="form-control" id="InputNome" aria-describedby="nomeHelp" value="{{ $fornecedor->nomefornecedor }}" required>
			<div id="nomeHelp" class="form-text">Digita o nome completo.</div>
		</div>
       
		<div class="mb-3">
			<label for="InputCPF" class="form-label">CPF</label>
			<input name="cpfcnpj" type="text" class="form-control" id="InputCPFMask" aria-describedby="CPFHelp" value="{{ $fornecedor->cpfcnpj }}" required>
			<div id="CPFHelp" class="form-text">Ex.: 000.000.000-00</div>
		</div>
		
		<div class="mb-3">
			<label for="InputEndereco" class="form-label">Endereço</label>
			<input name="endereco" type="text" class="form-control" id="InputEndereco" aria-describedby="enderecoHelp" value="{{ $fornecedor->endereco }}" required>
			<div id="enderecoHelp" class="form-text">Entre com um endereço válido.</div>
  		</div>

		<div class="mb-3">
			<label id="InputUF" for="InputUF" class="form-label">UF</label>
			<input name="uf" type="text" class="form-control" aria-describedby="UFHelp" value="{{ $fornecedor->uf }}" required>
			<div id="UFHelp" class="form-text">Entre com o estado</div>
  		</div>

		<div class="mb-3">
			<label for="InputEmail" class="form-label">Email</label>
			<input name="email" type="text" class="form-control" id="InputEmail" aria-describedby="emailHelp" value="{{ $fornecedor->email }}" required>
			<div id="emailHelp" class="form-text"> Entre com o email válido.  </div>
  		</div>

        <div class="mb-3">
			<label for="Inputtelefone" class="form-label">Telefone</label>
			<input name="telefone" type="text" class="form-control" id="InputTelefoneMask" aria-describedby="telefoneHelp" value="{{ $fornecedor->telefone }}" required>
			<div id="telefoneHelp" class="form-text">Entre com o telefone válido.  </div>
  		</div>

          <div class="mb-3">
			<label for="InputNomecontato" class="form-label">Nome do contato</label>
			<input name="nomecontato" type="text" class="form-control" id="InputNomecontato" aria-describedby="nomecontatoHelp" value="{{ $fornecedor->nomecontato }}" required>
			<div id="nomecontatoHelp" class="form-text">Entre com o nome do contato.  </div>
  		</div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupStatus">Status</label>
            <select id="inputGroupStatus" name="status" class="form-select" aria-describedby="statusHelp" required>                
                <option value="0" {{ $fornecedor->status == 0 ? 'selected':'' }}>Inativo</option>
                <option value="1" {{ $fornecedor->status == 1 ? 'selected':'' }}>Ativo</option>                
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
