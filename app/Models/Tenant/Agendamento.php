<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class);
    }

    public function procedimentos()
    {
        return $this->belongsToMany(
            Procedimento::class,
            'agendamento_procedimentos',
            'agendamento_id',
            'procedimento_id'
        );
    }

    protected $statuses = array(
        '0' => ['id' => 0, 'text' => 'Agendado', 'color' => 'dark'],
        '1' => ['id' => 1, 'text' => 'Confirmado', 'color' => 'primary'],
        '2' => ['id' => 2, 'text' => 'Esperando', 'color' => 'warning'],
        '3' => ['id' => 3, 'text' => 'Cancelado', 'color' => 'danger'],
        '4' => ['id' => 4, 'text' => 'Não Compareceu', 'color' => 'pink'],
        '5' => ['id' => 5, 'text' => 'Em Atendimento', 'color' => 'teal'],
        '6' => ['id' => 6, 'text' => 'Finalizado', 'color' => 'success'],
    );

    protected $statuspags = array(
        '0' => ['id' => 0, 'text' => 'A Receber', 'color' => 'danger'],
        '1' => ['id' => 1, 'text' => 'Pago', 'color' => 'success'],
    );

    public function getStatusAttribute($value)
    {
        return $this->statuses[$value];
    }

    public function getStatusPagamentoAttribute($value)
    {
        return $this->statuspags[$value];
    }

    public function profissional()
    {
        return $this->belongsTo(Medico::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function historico()
    {
        return $this->hasOne(PacienteHistorico::class);
    }

    public function documentos()
    {
        return $this->hasOne(PacienteDocumentos::class);
    }

    // public function imagens()
    // {
    //     return $this->hasMany(Captura::class);
    // }
}
