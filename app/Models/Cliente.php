<?php

namespace APP\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model {

    use HasFactory;

    protected $table = 'cliente';
    public $timestamps = false;

    protected $fillable =['id','nome','cpf','email','telefone','endereco','status'];

}
