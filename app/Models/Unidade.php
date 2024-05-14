<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "nome",
        "nome_fantasia",
        "cnpj",
        "telefone_contato",
        "cep",
        "rua",
        "numero",
        "complemento",
        "bairro",
        "cidade",
        "estado"
    ];
}
