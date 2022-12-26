<?php

namespace APP\Models;
use App\Models\Veiculo;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receita extends Model {

    use HasFactory;

    protected $table = 'receita';
    public $timestamps = false;

    protected $fillable =['id','descricao','veiculo_id','valor','data','status'];


    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

}
