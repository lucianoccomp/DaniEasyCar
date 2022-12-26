<!DOCTYPEhtml>
<html>
<head>	
</head>
<body>

	<form action="/fornecedor/cadastrar" method="POST">
		
		@csrf 

		<input type="hidden" name="status" value="1" />

		<div class="mb-3">
			<label for="InputNomeFornecedor" class="form-label">Nome do fornecedor</label>
			<input name="nomefornecedor" type="text" class="form-control" id="InputNomeFornecedor" aria-describedby="nomeHelp" autocomplete="off" required>
			<div id="nomeHelp" class="form-text">Digita o nome completo do fornecedor.</div>
		</div>

		<div class="mb-3">
			<label for="InputCPFCNPJ" class="form-label">CPF</label>
			<input name="cpfcnpj" type="text" class="form-control" id="InputCPFCNPJMask" aria-describedby="CPFHelp" autocomplete="off" required>
			<div id="CPFHelp" class="form-text">Ex.: 000.000.000-00</div>
		</div>

        <div class="mb-3">
			<label for="InputEndereco" class="form-label">Endereço</label>
			<input name="endereco" type="text" class="form-control" id="InputEndereco" aria-describedby="enderecoHelp" autocomplete="off"  required>
			<div id="enderecoHelp" class="form-text">Ex.: Rua 10, N° 365, Bairro Neblina.  </div>
  		</div>

        <div class="mb-3">
			<label for="InputUF" class="form-label">UF</label>
			<input name="uf" type="text" class="form-control" id="InputUF" aria-describedby="ufHelp" autocomplete="off" required>
			<div id="ufHelp" class="form-text">Ex.: New Yourk </div>
  		</div>
		
		<div class="mb-3">
			<label for="InputEmail1" class="form-label">Email</label>
			<input name="email" type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" autocomplete="off" required>
			<div id="emailHelp" class="form-text">Entre com um email válido.</div>
  		</div>

		<div class="mb-3">
			<label id="InputTelefone" for="InputTelefone" class="form-label">Telefone</label>
			<input name="telefone" type="text" class="form-control" id="InputTelefoneMask" aria-describedby="TelefoneHelp" autocomplete="off" required>
			<div id="TelefoneHelp" class="form-text">Ex.: (000) 000-0000</div>
  		</div>

        <div class="mb-3">
			<label id="InputNomeContato" for="InputNomeContato" class="form-label">Nome do contato</label>
			<input name="nomecontato" type="text" class="form-control" id="InputNomeContato" aria-describedby="nomeContatoHelp" autocomplete="off" required>
			<div id="nomeContatoHelp" class="form-text">Entre com o nome do contato completo.</div>
  		</div>	

		<div class="mb-3">
        	<button type="submit" class="btn btn-primary">Cadastrar</button>
		</div>
    </form>

	<script>
		$(document).ready(function(){
  			//$('#birth-date').mask('00/00/0000');
  			$('#InputTelefoneMask').mask('(000) 000-0000');			
			$('#InputCPFCNPJMask').mask('000.000.000-00');	
		});

	</script>


</body>
</html>
