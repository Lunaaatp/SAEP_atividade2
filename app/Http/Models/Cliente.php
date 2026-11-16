<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'cpf' => 'encrypted',
        ];
    }

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'id_cliente', 'id_cliente');
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'id_cliente', 'id_cliente');
    }
}