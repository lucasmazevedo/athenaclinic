<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Agendamento;
use App\Models\Tenant\Cid10;
use App\Models\Tenant\Documento;
use App\Models\Tenant\PacienteDocumentos;
use App\Models\Tenant\PacienteHistorico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PDF;

class AtendimentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function consulta($id)
    {
        $cid10 = Cid10::take(10)->get();
        $agendamento = Agendamento::findOrFail($id);
        if($agendamento->historico != null) {
            $historico = $agendamento->historico;
        } else {
            $historico = new PacienteHistorico();
            $historico->agendamento_id = $agendamento->id;
            $historico->save();
        }

        return view('tenant.atendimentos.consulta', compact('cid10', 'agendamento', 'historico'));
    }

    public function salvar_consulta(Request $request, $id)
    {
        $historico = PacienteHistorico::find($id);
        $historico->cid10_id = $request->get('cid10');
        $historico->queixa_principal = $request->get('tbQP');
        $historico->historico = $request->get('tbHF');
        $historico->obs = $request->get('tbOBS');
        $historico->update();
        return response()->json(['success' => 'Salvo...', 'data' => $id]);
    }

    public function documentos($id)
    {
        $modelos_doc = Documento::all();
        $documentos = PacienteDocumentos::where('agendamento_id', $id)->get();
        return response()->json(View::make('tenant.atendimentos.partials.documentos', compact('documentos', 'modelos_doc'))->render());
    }

    public function setDocumentos(Request $request, $id)
    {
        $modelos_doc = Documento::all();
        $documentos = PacienteDocumentos::where('agendamento_id', $id)->get();

        $doc = new PacienteDocumentos();
        $doc->titulo = $request->titulo;
        $doc->conteudo = $request->conteudo;
        $doc->agendamento_id = $id;
        $doc->save();


        $documentos = PacienteDocumentos::where('agendamento_id', $id)->get();
        return response()->json(View::make('tenant.atendimentos.partials.documentos_table', compact('documentos'))->render());
    }

    public function printDocumento($id)
    {
        $documento = PacienteDocumentos::findOrFail($id);
        $pdf = PDF::loadView('tenant.impressoes.documentos', ['data' => $documento])
        ->setPaper('a5')->setOrientation('portrait');
        return $pdf->inline('invoice.pdf');
    }


    public function getDocumentos($id)
    {
        $doc = Documento::find($id);
        return response()->json(['success' => 'Sucesso...', 'data' => $doc]);
    }

    public function captura()
    {
        return view('tenant.painel.index');
    }
}
