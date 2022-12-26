
<table class="table table-bordered">
        <tr>
            <th>Descrição</th>
            <td>{{ $despesa->descricao }}</td>
        </tr>
        <tr>
            <th>Valor unitário</th>
            <td>{{ '$ '.number_format($despesa->valorUnitario, 2,".",",")  }}</td>
        </tr>
        <tr>
            <th>Quantidade</th>
            <td>{{ $despesa->quantidade }}</td>
        </tr>
        <tr>
            <th>Valor total</th>
            <td>{{ '$ '.number_format($despesa->valorTotal, 2,".",",")  }}</td>
        </tr>
        <tr>
            <th>data</th>
            <td>{{ date('d/m/Y', strtotime($despesa->data)) }}</td>
        </tr>
        <tr>
            <th>Veículo</th>            
            <td>
                <img src="{{asset('storage/fotos/'.$despesa->veiculo->foto)}}"  height="200px" width="auto" alt="Italian Trulli">                
                <figcaption>{{ $despesa->veiculo->nome }}</figcaption>
            </td>
            
        </tr>
        <tr>
            <th>status</th>
            <td>{{ $despesa->status == 1 ? "Ativo":"Inativo" }}</td>
        </tr>
</table>
