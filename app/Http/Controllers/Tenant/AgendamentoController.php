<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Agendamento;
use App\Models\Tenant\Caixa;
use App\Models\Tenant\MovimentoCaixa;
use App\Models\Tenant\Paciente;
use App\Models\Tenant\Preco;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AgendamentoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $agendamentos = Agendamento::whereDate('horario', '=', $request->get('data'))->OrderBy('horario', "ASC")->get();
            $data = Carbon::parse($request->get('data'))->format('d/m/Y');
            return response()->json(View::make('tenant.agendamentos.agendaTable', compact('data', 'agendamentos'))->render());
        }
        return view('tenant.agendamentos.index');
    }

    public function getPacientes(Request $request)
    {
        if ($request->ajax()) {
            $data = [];

            if ($request->has('q')) {
                $search = $request->q;
                $data = Paciente::select("id", "nome", "cpf", "dtnascimento")
                        ->where('nome', 'LIKE', "%$search%")
                        ->get();
            }
            return response()->json($data);
        }
    }

    public function getAgendamentos(Request $request)
    {
        if ($request->ajax()) {
            $datas = [];
            $agendamentos = Agendamento::select('horario')->get();
            foreach ($agendamentos as $a) {
                array_push($datas, Carbon::parse($a->horario)->format('m/d/Y'));
            }

            return $datas;
        }
    }

    public function create(Request $request)
    {
        // $pacientes = Paciente::all();
        // $medicos = User::where('user_type', 'medico_user')->orWhere('user_type', '=', 'profissional_user')->get();
        // $convenios = Convenio::all();
        // $procedimentos = Procedimento::where('tipo', '=', '1')->orWhere('tipo', '=', '2')->get();
        // return response()->json(View::make('backend.recepcao.agendaCreate', compact('pacientes', 'medicos', 'convenios', 'procedimentos'))->render());
    }
    public function createConsulta(Request $request)
    {
        // $pacientes = Paciente::all();
        // $medicos = User::where('user_type', 'medico_user')->get();
        // $convenios = Convenio::all();
        // $procedimentos = Procedimento::where('tipo', '=', '0')->get();
        // return response()->json(View::make('backend.recepcao.agendaCreateConsulta', compact('pacientes', 'medicos', 'convenios', 'procedimentos'))->render());
    }


    public function verificacao(Request $request)
    {
        $agenda = Agendamento::where('horario', $request->get('date'))->where('medico_id', $request->get('profissional'))->count();
        return response()->json(['success' => 'consulta realizada..', 'count' => $agenda]);
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'paciente' => 'required',
        //     'data_agenda' => 'required',
        //     'hora_agenda' => 'required',
        //     'profissional' => 'required',
        //     'convenio' => 'required',
        //     'procedimentos' => 'required',
        // ]);

        // $procedimentos = json_decode($request->get('procedimentos'));
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()->all()]);
        // }
        // $horario = Carbon::createFromFormat('d/m/Y', $request->get('data_agenda'))->format('Y-m-d') . " " .  $request->get('hora_agenda') . ":00 " ;
        // $model = new Agendamento();
        // $model->horario = $horario;
        // $model->paciente_id = $request->get('paciente');
        // $model->convenio_id = $request->get('convenio');
        // $model->medico_id = $request->get('profissional');
        // $model->tipo = $request->get('tipo');
        // $model->operador_id = Auth::user()->id;
        // $model->save();
        // $model->procedimentos()->sync($procedimentos);
        // return response()->json(['success' => 'Agendamento Realizado com sucesso!', 'data' => $model]);
    }

    public function storeConsulta(Request $request)
    {
        // dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'paciente' => 'required',
        //     'data_agenda' => 'required',
        //     'hora_agenda' => 'required',
        //     'profissional' => 'required',
        //     'convenio' => 'required',
        //     'procedimento' => 'required',
        // ]);

        // $procedimento = json_decode($request->get('procedimento'));
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()->all()]);
        // }
        // $horario = Carbon::createFromFormat('d/m/Y', $request->get('data_agenda'))->format('Y-m-d') . " " .  $request->get('hora_agenda') . ":00 " ;
        // $model = new Agendamento();
        // $model->horario = $horario;
        // $model->paciente_id = $request->get('paciente');
        // $model->convenio_id = $request->get('convenio');
        // $model->medico_id = $request->get('profissional');
        // $model->tipo = $request->get('tipo');
        // $model->operador_id = Auth::user()->id;
        // $model->save();
        // $model->procedimentos()->sync($procedimento);
        // return response()->json(['success' => 'Agendamento Realizado com sucesso!', 'data' => $model]);
    }
    public function show($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        return response()->json(View::make('tenant.agendamentos.detalhes', compact('agendamento'))->render());
    }

    public function pagamento($id)
    {
        $total = 0;
        $agendamento = Agendamento::findOrFail($id);
        foreach ($agendamento->procedimentos as $p) {
            $preco = Preco::with('convenio', 'procedimento')->where('procedimento_id', $p->id)->where('convenio_id', $agendamento->convenio_id)->get();
            $total = $total + $preco->first()->preco;
        }
        return response()->json(View::make('tenant.agendamentos.pagamento', compact('agendamento', 'total'))->render());
    }

    public function registraPagamento(Request $request, $id)
    {
        $caixa = Caixa::where('status', 0)->get();
        if ($caixa->count() <= 0) {
            return response()->json(['errors' => ['error' => 'Nenhum Caixa Aberto, por favor fazer abertura de caixa!']]);
        }

        $agendamento = Agendamento::findOrFail($id);
        $desconto = ($request->get('desconto')) ? number_format($this->onlyNumber($request->get('desconto'))/100, 2, '.', '') : 0.00;

        if ($agendamento->status_pagamento != 1) {
            $total = 0;
            $agendamento = Agendamento::findOrFail($id);
            foreach ($agendamento->procedimentos as $p) {
                $preco = Preco::with('convenio', 'procedimento')->where('procedimento_id', $p->id)->where('convenio_id', $agendamento->convenio_id)->get();
                $total = $total + $preco->first()->preco;
            }
            $totalConf = $total - $desconto;
            if ($request->get('total') != $totalConf) {
                return response()->json(['errors' => ['error' => 'O valor recebido não corresponde ao valor total...']]);
            }

            if ($request->get('desconto') > 0) {
                $pagamento = new MovimentoCaixa();
                $pagamento->caixa_id = $caixa->first()->id;
                $pagamento->tipo = 2;
                $pagamento->descricao = "Desconto Agendamento ID: ".$agendamento->id."";
                $pagamento->agendamento_id = $agendamento->id;
                $pagamento->formaPag = "0";
                $pagamento->valorPag = ($request->get('desconto')) ? number_format($this->onlyNumber($request->get('desconto'))/100, 2, '.', '') : 0.00;
                $pagamento->user_id = Auth::user()->id;
                $pagamento->save();
            }

            if ($request->get('din') > 0) {
                $pagamento = new MovimentoCaixa();
                $pagamento->caixa_id = $caixa->first()->id;
                $pagamento->tipo = 0;
                $pagamento->descricao = "Agendamento ID: ".$agendamento->id."";
                $pagamento->agendamento_id = $agendamento->id;
                $pagamento->formaPag = "0";
                $pagamento->valorPag = ($request->get('din')) ? number_format($this->onlyNumber($request->get('din'))/100, 2, '.', '') : 0.00;
                $pagamento->user_id = Auth::user()->id;
                $pagamento->save();
            }

            if ($request->get('pix') > 0) {
                $pagamento = new MovimentoCaixa();
                $pagamento->caixa_id = $caixa->first()->id;
                $pagamento->tipo = 0;
                $pagamento->descricao = "Agendamento ID: ".$agendamento->id."";
                $pagamento->agendamento_id = $agendamento->id;
                $pagamento->formaPag = "1";
                $pagamento->valorPag = ($request->get('pix')) ? number_format($this->onlyNumber($request->get('pix'))/100, 2, '.', '') : 0.00;
                $pagamento->user_id = Auth::user()->id;
                $pagamento->save();
            }

            if ($request->get('deb') > 0) {
                $pagamento = new MovimentoCaixa();
                $pagamento->caixa_id = $caixa->first()->id;
                $pagamento->tipo = 0;
                $pagamento->descricao = "Agendamento ID: ".$agendamento->id."";
                $pagamento->agendamento_id = $agendamento->id;
                $pagamento->formaPag = "2";
                $pagamento->valorPag = ($request->get('deb')) ? number_format($this->onlyNumber($request->get('deb'))/100, 2, '.', '') : 0.00;
                $pagamento->user_id = Auth::user()->id;
                $pagamento->save();
            }

            if ($request->get('cred') > 0) {
                $pagamento = new MovimentoCaixa();
                $pagamento->caixa_id = $caixa->first()->id;
                $pagamento->tipo = 0;
                $pagamento->descricao = "Agendamento ID: ".$agendamento->id."";
                $pagamento->agendamento_id = $agendamento->id;
                $pagamento->formaPag = "3";
                $pagamento->valorPag = ($request->get('cred')) ? number_format($this->onlyNumber($request->get('cred'))/100, 2, '.', '') : 0.00;
                $pagamento->user_id = Auth::user()->id;
                $pagamento->save();
            }

            if ($request->get('transf') > 0) {
                $pagamento = new MovimentoCaixa();
                $pagamento->caixa_id = $caixa->first()->id;
                $pagamento->tipo = 0;
                $pagamento->descricao = "Agendamento ID: ".$agendamento->id."";
                $pagamento->agendamento_id = $agendamento->id;
                $pagamento->formaPag = "4";
                $pagamento->valorPag = ($request->get('transf')) ? number_format($this->onlyNumber($request->get('transf'))/100, 2, '.', '') : 0.00;
                $pagamento->user_id = Auth::user()->id;
                $pagamento->save();
            }

            $agendamento->status_pagamento = 1;
            $agendamento->update();
            return response()->json(['success' => 'Recebimento registrado com sucesso!', 'data' => $pagamento]);
        } else {
            return response()->json(['errors' => ['error' => 'Operação não permitida...']]);
        }
    }

    public function printFicha($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $pdf = PDF::loadView('tenant.impressoes.ficha', ['data' => $agendamento]);
        return $pdf->inline('invoice.pdf');
    }

    public function printRecibo($id)
    {
        // $agendamento = Agendamento::findOrFail($id);
        // $mov = MovimentoCaixa::where('agendamento_id', $agendamento->id)->sum('valorPag');
        // $valorF = number_format(($mov), 0, '', '');
        // $valor = $this->valor_por_extenso($valorF);

        // $pdf = PDF::loadView('backend.impressoes.recibo', ['data' => $agendamento, 'valorE' => $valor]);
        // return $pdf->inline('recibo.pdf');
    }

    public function mudarStatus(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->status = $request->get('id');
        $agendamento->update();

        return response()->json(['success' => 'Recebimento registrado com sucesso!', 'data' => $agendamento]);
    }

    private function onlyNumber($value)
    {
        return preg_replace('/[^0-9]+/', '', $value);
    }


    public function espera(Request $request)
    {
        $agendamentos = Agendamento::with('procedimentos')
                        ->WhereNot('status', '=', '6')->WhereNot('status', '=', '3')->where('status_pagamento', '=', '1')
                        ->get();
        return view('tenant.agendamentos.espera', compact('agendamentos'));
    }

}
