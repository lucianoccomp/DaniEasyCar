<?php

namespace APP\Models;
use App\Models\Veiculo;
use App\Models\Cliente;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locacao extends Model {

    use HasFactory;

    protected $table = 'locacao';
    public $timestamps = false;

    protected $fillable =['id','datalocacao','datadevolucao','valorcontratado','valoradicional','valordesconto','valortotal','statuspagamento','statusaluguel','veiculo_id','cliente_id','status'];


    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
