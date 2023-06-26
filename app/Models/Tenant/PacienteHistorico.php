<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteHistorico extends Model
{
    use HasFactory;

    public function agenda()
    {
        return $this->belongsTo(Agendamento::class);
    }
}
