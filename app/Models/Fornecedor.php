<?php

namespace APP\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornecedor extends Model {

    use HasFactory;

    protected $table = 'fornecedor';
    public $timestamps = false;

    protected $fillable = ['id','nomefornecedor','cpfcnpj','endereco','uf','email','telefone','nomecontato','status'];

}
