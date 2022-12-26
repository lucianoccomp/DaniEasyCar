
<table class="table table-bordered">

        <tr>
            <th>Data locação</th>
            <td>{{ date('d/m/Y', strtotime($locacao->datalocacao)) }}</td>
        </tr>
        <tr>
            <th>Data devolucao</th>
            <td>{{ date('d/m/Y', strtotime($locacao->datadevolucao)) }}</td>
        </tr>
        <tr>
            <th>Valor contratado</th>
            <td>{{ '$ '.number_format($locacao->valorcontratado, 2,".",",")  }}</td>
        </tr>
        <tr>
            <th>Valor adicional</th>
            <td>{{ '$ '.number_format($locacao->valoradicional, 2,".",",")  }}</td>
        </tr>
        <tr>
            <th>Valor desconto</th>
            <td>{{ '$ '.number_format($locacao->valordesconto, 2,".",",")  }}</td>
        </tr>
        <tr>
            <th>Valor total</th>
            <td>{{ '$ '.number_format($locacao->valortotal, 2,".",",")  }}</td>
        </tr>
        <tr>
            <th>Cliente</th>
            <td>{{ $locacao->cliente->nome }}</td>
        </tr>
        <tr>
            <th>Veículo</th>            
            <td>
                <img src="{{asset('storage/fotos/'.$locacao->veiculo->foto)}}"  height="200px" width="auto" alt="Italian Trulli">                
                <figcaption>{{ $locacao->veiculo->nome }}</figcaption>
            </td>
            
        </tr>
        <tr>
            <th>Status pagamento</th>
            <td style='{{ $locacao->status == 1 ? "color:red":"color:blue" }}'>{{ $locacao->statuspagamento == 1 ? "pago":"pendente" }}</td>
        </tr>
        <tr>
            <th>Status aluguel</th>
            <td style='{{ $locacao->status == 1 ? "color:blue":"color:red" }}'>{{ $locacao->statusaluguel == 1 ? "vencido":"à vencer" }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td style='{{ $locacao->status == 1 ? "color:blue":"color:red" }}'>{{ $locacao->status == 1 ? "Ativo":"Inativo" }}</td>
        </tr>
</table>
