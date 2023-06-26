<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteDocumentos extends Model
{
    use HasFactory;

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }
}
