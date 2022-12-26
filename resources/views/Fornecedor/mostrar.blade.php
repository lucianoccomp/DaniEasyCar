
<table class="table table-bordered">
    <tr>
        <th  class="text-start ">Nome fornecedor</th>
        <td>{{ $fornecedor->nomefornecedor }}</td>
    </tr>
    <tr>
        <th class="text-start">CPF/CNPJ</th>
        <td>{{ $fornecedor->cpfcnpj }}</td>
    </tr>
    <tr>
        <th class="text-start">Endereço</th>
        <td>{{ $fornecedor->endereco }}</td>
    </tr>
    <tr>
        <th class="text-start">UF</th>
        <td>{{ $fornecedor->uf }}</td>
    </tr>
    <tr>
        <th class="text-start">Email</th>
        <td>{{ $fornecedor->email }}</td>
    </tr>
    <tr>
        <th class="text-start">Telefone</th>
        <td>{{ $fornecedor->telefone }}</td>
    </tr>
    <tr>
        <th class="text-start">Nome do Contato</th>
        <td>{{ $fornecedor->nomecontato }}</td>
    </tr>    
    <tr>
        <th class="text-start">status</th>
        <td>{{ $fornecedor->status == 1 ? "Ativo":"Inativo" }}</td>
    </tr>
</table>