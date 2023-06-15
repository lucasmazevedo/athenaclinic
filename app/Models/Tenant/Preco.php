<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    use HasFactory;

    public function Procedimento()
    {
        return $this->belongsTo(Procedimento::class);
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class);
    }
}
