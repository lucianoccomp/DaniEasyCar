
<table class="table table-bordered">
        <tr>
            <th>Descrição</th>
            <td>{{ $receita->descricao }}</td>
        </tr>
        <tr>
            <th>Veículo</th>            
            <td>
                <img src="{{asset('storage/fotos/'.$receita->veiculo->foto)}}"  height="200px" width="auto" alt="Veículo">                
                <figcaption>{{ $receita->veiculo->nome }}</figcaption>
            </td>            
        </tr>
        <tr>
            <th>Valor</th>
            <td>{{ '$ '.number_format($receita->valor, 2,".",",")  }}</td>
        </tr>        
        
        <tr>
            <th>data</th>
            <td>{{ date('d/m/Y', strtotime($receita->data)) }}</td>
        </tr>        
        <tr>
            <th>status</th>
            <td>{{ $receita->status == 1 ? "Ativo":"Inativo" }}</td>
        </tr>
</table>
