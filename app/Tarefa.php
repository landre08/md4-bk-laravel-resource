<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    // O Elo assume automaticamente que o nome da tabela no bd é o nome do model no plural, mas posso modificar assim:
    //protected $table = "minha_tarefa";


    // O Elo assume que a chave primária vai se chamar id no bd, mas posso modificar assim:
    //protected $primaryKey = "tarefa_id";

    // O Elo assume que a chave primária é auto increment, mas posso modifica assim:
    //public $incrementing = false;

    // Ele assume que o chave primária vai ser int, mas posso modificar assim:
    //protected $keyType = "string";

    // Automaticamente o Elo assum que eu vou ter os campos created_at e updated_at, mas posso dizer pra não assumir
    public $timestamps = false;

   // Eu posso modificar o nome padrão do createc_at e updated_at:
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    // Serve para dizer que esse campos podem ser usado para INSERT ou UPDATE em massa.
    protected $fillable = ['titulo'];
}
