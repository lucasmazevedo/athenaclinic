<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentoCaixa extends Model
{
    use HasFactory;
    // 0 = receita | 1 = despesa
    protected $tipos = array(
        '0' => ['id' => 0, 'text' => 'Receita', 'abbr' => 'C', 'color' => 'success'],
        '1' => ['id' => 1, 'text' => 'Despesa', 'abbr' => 'D', 'color' => 'danger'],
        '2' => ['id' => 2, 'text' => 'Desconto', 'abbr' => 'DESCONTO', 'color' => 'secondary'],
    );

    // 0 - Dinheiro // 1 - Pix // 2 - Cartão de Débito // 3 - Cartão de Crédito  // 4 - Transferência // 5 - Cheque // 6 - Boleto
    protected $formas = array(
        '0' => ['id' => 0, 'text' => 'Dinheiro', 'icon' => "din.png"],
        '1' => ['id' => 0, 'text' => 'Pix', 'icon' => 'pix.png'],
        '2' => ['id' => 0, 'text' => 'Cartão de Débito', 'icon' => 'cdeb.png'],
        '3' => ['id' => 0, 'text' => 'Cartão de Crédito', 'icon' => 'ccred.png'],
        '4' => ['id' => 0, 'text' => 'Transferência', 'icon' => 'transf.png'],
        '5' => ['id' => 0, 'text' => 'Cheque', 'icon' => 'cheque.png'],
        '6' => ['id' => 0, 'text' => 'Boleto', 'icon' => 'boleto.png'],
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTipoAttribute($value)
    {
        return $this->tipos[$value];
    }

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function caixa()
    {
        return $this->belongsTo(Caixa::class);
    }

    public function getFormaPagAttribute($value)
    {
        return $this->formas[$value];
    }
}
