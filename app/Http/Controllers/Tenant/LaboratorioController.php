<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function coleta()
    {
        return view('tenant.laboratorio.coleta');
    }

    public function agenda()
    {
        return view('tenant.laboratorio.agenda');
    }

    public function relatorios()
    {
        return view('tenant.laboratorio.relatorios');
    }
}
