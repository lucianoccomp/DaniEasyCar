
<table class="table table-bordered">
        <tr>
            <th>Nome</th>
            <td>{{ $cliente->nome }}</td>
        </tr>
        <tr>
            <th>CPF</th>
            <td>{{ $cliente->cpf }}</td>
        </tr>
        <tr>
            <th>email</th>
            <td>{{ $cliente->email }}</td>
        </tr>
        <tr>
            <th>telefone</th>
            <td>{{ $cliente->telefone }}</td>
        </tr>
        <tr>
            <th>endereço</th>
            <td>{{ $cliente->endereco }}</td>
        </tr>
        <tr>
            <th>status</th>
            <td>{{ $cliente->status == 1 ? "Ativo":"Inativo" }}</td>
        </tr>
</table>
