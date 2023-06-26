<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function display() {
        return view('tenant.painel.index');
    }

    public function chamarPainel() {
        // PublicEvent::dispatch(['AN-0021', 'Guichê 06']);
    }
}
