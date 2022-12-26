<?php

namespace APP\Models;
use App\Models\Veiculo;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Despesa extends Model {

    use HasFactory;

    protected $table = 'despesa';
    public $timestamps = false;

    protected $fillable =['id','descricao','valorUnitario','quantidade','valorTotal','data','veiculo_id','status'];


    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

}
