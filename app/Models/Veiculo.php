<?php

namespace APP\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Veiculo extends Model {

    use HasFactory;

    protected $table = 'veiculo';
    public $timestamps = false;

    protected $fillable =['id','nome','descricao','placa','idnumber','registrationvalid','precocompra','datacompra','precolocacaosemana','milhagem','foto','status'];

}
