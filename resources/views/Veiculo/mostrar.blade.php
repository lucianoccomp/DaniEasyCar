
<table class="table table-bordered">
    <tr>
        <th  class="text-start ">Nome</th>
        <td>{{ $veiculo->nome }}</td>
    </tr>
    <tr>
        <th class="text-start">Descrição</th>
        <td>{{ $veiculo->descricao }}</td>
    </tr>
    <tr>
        <th class="text-start">Placa</th>
        <td>{{ $veiculo->placa }}</td>
    </tr>
    <tr>
        <th class="text-start">Id Number</th>
        <td>{{ $veiculo->idnumber }}</td>
    </tr>
    <tr>
        <th class="text-start">Registration Valid</th>
        <td>{{ $veiculo->registrationvalid }}</td>
    </tr>
    <tr>
        <th class="text-start">Preço da compra</th>
        <td>{{ $veiculo->precocompra }}</td>
    </tr>
    <tr>
        <th class="text-start">Data da compra</th>
        <td>{{ $veiculo->datacompra }}</td>
    </tr>
    <tr>
        <th class="text-start">Milhagem</th>
        <td>{{ $veiculo->milhagem }}</td>
    </tr>
    <tr>
        <th class="text-start">Foto</th>        
        <td><img src="{{asset('storage/fotos/'.$veiculo->foto)}}"  height="200px" width="auto" alt="Italian Trulli"></td>        
    </tr>       
    <tr>
        <th class="text-start">status</th>
        <td>{{ $veiculo->status == 1 ? "Ativo":"Inativo" }}</td>
    </tr>
</table>
