<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Agendamento;
use Illuminate\Http\Request;
use App\Models\Tenant\Caixa;
use App\Models\Tenant\Convenio;
use App\Models\Tenant\MovimentoCaixa;
use App\Models\Tenant\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class CaixaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Caixa::select('*')->orderBy('created_at', 'DESC');
            return DataTables::of($model)
                    ->addIndexColumn()
                    ->editColumn('id', function ($row) {
                        return '<span class="badge bg-light border-start border-width-3 text-body rounded-start-0 border-dark">'. $row->id .'</span>';
                    })
                    ->editColumn('saldo_inicial', function ($row) {
                        return "R$ " . str_replace('.', ',', $row->saldo_inicial);
                    })
                    ->editColumn('user', function ($row) {
                        return $row->user->profile->nome;
                    })
                    ->editColumn('abertura', function ($row) {
                        return Carbon::parse($row->dtabertura)->format('d/m/Y');
                    })
                    ->editColumn('fechamento', function ($row) {
                        if ($row->status == 0) {
                            return '<span class="badge bg-success bg-opacity-20 text-info">ABERTO</span>';
                        } else {
                            return Carbon::parse($row->dtabertura)->format('d/m/Y');
                        }
                    })
                    ->editColumn('entradas', function ($row) {
                        $movimentoC = MovimentoCaixa::where('caixa_id', $row->id);
                        $totalReceitas = $movimentoC->where('tipo', 0)->sum('valorPag');
                        return "R$ " . number_format($totalReceitas, 2, ',', '.');
                    })
                    ->editColumn('saidas', function ($row) {
                        $movimentoC = MovimentoCaixa::where('caixa_id', $row->id);
                        $totalDespesas = $movimentoC->where('tipo', 1)->sum('valorPag');
                        return "R$ " . number_format($totalDespesas, 2, ',', '.');
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d/m/Y') . " às " . Carbon::parse($row->created_at)->format('H:i');
                    })
                    ->addColumn('action', function ($row) {
                        //<a href="javascript:void()" data-href="'. route('caixas.abrir', $row->id) .'" class="btn btn-icon btn-sm btn-danger btn_delete"><i class="ph-x-circle"></i></a>'
                        $btn = "";
                        $btn .= '
                        <a id="" href="'. route('caixas.movimento', $row->id) .'" class="btn btn-icon btn-sm btn-secondary"><i class="fas fa-list"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id', 'fechamento'])
                    ->make(true);
        }
        return view('tenant.caixas.index');
    }


    public function movimento(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = MovimentoCaixa::with('agendamento')->Where('caixa_id', $id)->select('*')->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d/m/Y');
                    })
                    ->editColumn('descricao', function ($row) {
                        if($row->agendamento_id)
                        {
                            return $row->descricao . " - " . $row->agendamento->paciente->nome;
                        }else{
                            return $row->descricao;
                        }

                    })
                    ->editColumn('forma', function ($row) {
                        $img = global_asset('/assets/images/formasPag/'.$row->formaPag['icon'].'');
                        return '<img width="18" src="'. $img .'">  '. $row->formaPag['text'];
                    })
                    ->editColumn('userLan', function ($row) {
                        return "";
                    })
                    ->editColumn('valorPag', function ($row) {
                        return "R$ " . str_replace('.', ',', $row->valorPag) . " <span class='badge badge-sm badge-". $row->tipo['color'] ." rounded-pill'>" .$row->tipo['abbr'] . "</span>";
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '
                        <a href="javascript:void()" data-href="'. route('caixas.destroyMovimento', $row->id) .'" class="btn btn-icon btn-sm btn-danger btn_delete"><i class="fas fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id', 'valorPag', 'forma'])
                    ->make(true);
        }
        $model = Caixa::findOrFail($id);

        $movimentoReceita = MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0);
        $di_re = 0.0;
        $pi_re = 0.0;
        $cd_re = 0.0;
        $cc_re = 0.0;
        $tr_re = 0.0;
        $cq_re = 0.0;
        $bo_re = 0.0;

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0)->where('formaPag', 0)->get() as $dinheiro_r) {
            $di_re = $di_re + floatval($dinheiro_r->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0)->where('formaPag', 1)->get() as $pix_r) {
            $pi_re = $pi_re + floatval($pix_r->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0)->where('formaPag', 2)->get() as $cartaodeb_r) {
            $cd_re = $cd_re + floatval($cartaodeb_r->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0)->where('formaPag', 3)->get() as $cartaocred_r) {
            $cc_re = $cc_re + floatval($cartaocred_r->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0)->where('formaPag', 4)->get() as $transferencia_r) {
            $tr_re = $tr_re + floatval($transferencia_r->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0)->where('formaPag', 5)->get() as $cheque_r) {
            $cq_re = $cq_re + floatval($cheque_r->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 0)->where('formaPag', 6)->get() as $boleto_r) {
            $bo_re = $bo_re + floatval($boleto_r->valorPag);
        }

        $totalRF = $di_re + $pi_re + $cd_re + $cc_re + $tr_re + $cq_re + $bo_re;
        $totalR = "R$ " . number_format($totalRF, 2, ',', '.');

        $movimentoDespesa = MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1);
        $di_de = 0.0;
        $pi_de = 0.0;
        $cd_de = 0.0;
        $cc_de = 0.0;
        $tr_de = 0.0;
        $cq_de = 0.0;
        $bo_de = 0.0;


        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1)->where('formaPag', 0)->get() as $dinheiro_d) {
            $di_de = $di_de + floatval($dinheiro_d->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1)->where('formaPag', 1)->get() as $pix_d) {
            $pi_de = $pi_de + floatval($pix_d->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1)->where('formaPag', 2)->get() as $cartaodeb_d) {
            $cd_de = $cd_de + floatval($cartaodeb_d->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1)->where('formaPag', 3)->get() as $cartaocred_d) {
            $cc_de = $cc_de + floatval($cartaocred_d->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1)->where('formaPag', 4)->get() as $transferencia_d) {
            $tr_de = $tr_de + floatval($transferencia_d->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1)->where('formaPag', 5)->get() as $cheque_d) {
            $cq_de = $cq_de + floatval($cheque_d->valorPag);
        }

        foreach (MovimentoCaixa::where('caixa_id', $id)->where('tipo', 1)->where('formaPag', 6)->get() as $boleto_d) {
            $bo_de = $bo_de + floatval($boleto_d->valorPag);
        }



        $totalDF = $di_de + $pi_de + $cd_de + $cc_de + $tr_de + $cq_de + $bo_de;
        $totalD = "R$ " . number_format($totalDF, 2, ',', '.');

        $di_d = "R$ " . number_format($di_de, 2, ',', '.');
        $pi_d = "R$ " . number_format($pi_de, 2, ',', '.');
        $cd_d = "R$ " . number_format($cd_de, 2, ',', '.');
        $cc_d = "R$ " . number_format($cc_de, 2, ',', '.');
        $tr_d = "R$ " . number_format($tr_de, 2, ',', '.');
        $cq_d = "R$ " . number_format($cq_de, 2, ',', '.');
        $bo_d = "R$ " . number_format($bo_de, 2, ',', '.');

        $di_r = "R$ " . number_format($di_re, 2, ',', '.');
        $pi_r = "R$ " . number_format($pi_re, 2, ',', '.');
        $cd_r = "R$ " . number_format($cd_re, 2, ',', '.');
        $cc_r = "R$ " . number_format($cc_re, 2, ',', '.');
        $tr_r = "R$ " . number_format($tr_re, 2, ',', '.');
        $cq_r = "R$ " . number_format($cq_re, 2, ',', '.');
        $bo_r = "R$ " . number_format($bo_re, 2, ',', '.');

        $saldoCF = $totalRF - $totalDF;
        $saldoC = "R$ " . number_format($saldoCF, 2, ',', '.');


        return view('tenant.caixas.movimento', compact("model", 'saldoC', 'totalR', 'totalD', 'di_r', 'pi_r', 'cd_r', 'cc_r', 'tr_r', 'cq_r', 'bo_r', 'di_d', 'pi_d', 'cd_d', 'cc_d', 'tr_d', 'cq_d', 'bo_d', ));
    }
    public function abrirCaixa()
    {
        return response()->json(View::make('tenant.caixas.abrirCaixa')->render());
    }

    public function fecharCaixa()
    {
        $caixaA = Caixa::where('status', 0)->first();
        $movimentoC = MovimentoCaixa::where('caixa_id', $caixaA->id);
        $movimentoCd = MovimentoCaixa::where('caixa_id', $caixaA->id);
        $totalReceitas = $movimentoC->where('tipo', 0)->sum('valorPag');
        $totalDespesas = $movimentoCd->where('tipo', 1)->sum('valorPag');
        $totalGeral = $totalReceitas - $totalDespesas;

        $totalGeral = "R$ " . number_format($totalGeral, 2, ',', '.');

        // 0 - Dinheiro // 1 - Pix // 2 - Cartão de Débito // 3 - Cartão de Crédito  // 4 - Transferência // 5 - Cheque // 6 - Boleto
        $dinR = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 0)->where('tipo', '0')->sum('valorPag');
        $dinD = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 0)->where('tipo', '1')->sum('valorPag');
        $pixR = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 1)->where('tipo', '0')->sum('valorPag');
        $pixD = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 1)->where('tipo', '1')->sum('valorPag');
        $debR = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 2)->where('tipo', '0')->sum('valorPag');
        $debD = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 2)->where('tipo', '1')->sum('valorPag');
        $credR = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 3)->where('tipo', '0')->sum('valorPag');
        $credD = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 3)->where('tipo', '1')->sum('valorPag');
        $transfR = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 4)->where('tipo', '0')->sum('valorPag');
        $transfD = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 4)->where('tipo', '1')->sum('valorPag');
        $cheqR = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 5)->where('tipo', '0')->sum('valorPag');
        $cheqD = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 5)->where('tipo', '1')->sum('valorPag');
        $bolR  = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 6)->where('tipo', '0')->sum('valorPag');
        $bolD  = MovimentoCaixa::where('caixa_id', $caixaA->id)->where('formaPag', 6)->where('tipo', '1')->sum('valorPag');


        return response()->json(View::make('tenant.caixas.fecharCaixa', compact('caixaA', 'totalGeral', 'dinR', 'dinD', 'pixR', 'pixD', 'debR', 'debD', 'credR', 'credD', 'transfR', 'transfD', 'cheqR', 'cheqD', 'bolR', 'bolD'))->render());
    }

    public function processaFechamentoCaixa(Request $request)
    {
        $caixaA = Caixa::where('status', 0)->first();
        $caixaA->dtfechamento = Carbon::now();
        $caixaA->status = 1;
        $caixaA->update();
        return response()->json(['success' => 'Caixa fechado com sucesso!', 'data' => $caixaA]);
    }

    public function processaCaixa(Request $request)
    {
        $caixa = new Caixa();
        $caixa->saldo_inicial = number_format($this->onlyNumber($request->get('saldoInicial'))/100, 2, '.', '');
        $caixa->dtabertura = Carbon::now();
        $caixa->user_id = Auth::user()->id;
        $caixa->save();
        $movimento = new MovimentoCaixa();
        $movimento->caixa_id = $caixa->id;
        $movimento->tipo = 0;
        $movimento->descricao = "SALDO INICIAL ABERTURA DO CAIXA";
        $movimento->formaPag = 0;
        $movimento->valorPag = $caixa->saldo_inicial;
        $movimento->user_id = $caixa->user_id;
        $movimento->save();

        return response()->json(['success' => 'Caixa aberto com sucesso!', 'data' => $caixa]);
    }

    public function destroyMovimento($id)
    {
        $movimento = MovimentoCaixa::findOrFail($id);
        $movimento->delete();
        return response()->json(['success' => 'Cancelamento de entrada efetuado com!', 'data' => $movimento]);
    }

    public function lancarMovimento($id)
    {
        $caixaA = Caixa::findOrFail($id);
        return view('tenant.caixas.novoRegistro', compact('caixaA'));
    }

    public function processaMovimento(Request $request, $id)
    {
        $caixaA = Caixa::findOrFail($id);
        $movimento = new MovimentoCaixa();
        $movimento->caixa_id = $caixaA->id;
        $movimento->tipo = $request->get('tipo');
        $movimento->descricao = $request->get('descricao');
        $movimento->formaPag = $request->get('formaPag');
        $movimento->valorPag = number_format($this->onlyNumber($request->get('valor'))/100, 2, '.', '');
        $movimento->user_id = Auth::user()->id;
        $movimento->save();
        return response()->json(['success' => 'Lançamento efetuado com sucesso!', 'data' => $movimento]);
    }

    private function onlyNumber($value)
    {
        return preg_replace('/[^0-9]+/', '', $value);
    }

    public function relatorio(Request $request)
    {
        if($request->get('datainicio')) {
            $dtInicio = Carbon::createFromFormat('d/m/Y', $request->get('datainicio'))->startOfDay();
        } else {
            $dtInicio = Carbon::now();
        }

        if($request->get('datafim')) {
            $dtFim = Carbon::createFromFormat('d/m/Y', $request->get('datafim'))->endOfDay();
        } else {
            $dtFim = Carbon::now();
        }
        $movimento1 = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->whereHas('agendamento', function ($q) use ($request) {
            if($request->get('convenio') == "0") {

            } else {
                $q->where('convenio_id', '=', $request->get('convenio'));
            }
        })->get();

        $movimento2 = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->where('tipo', 1)->get();
        $movimento =  $movimento1->merge($movimento2)->sortBy('created_at');


        $receita = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->where('tipo', 0)->whereHas('agendamento', function ($q) use ($request) {
            if($request->get('convenio') == "0") {

            } else {
                $q->where('convenio_id', '=', $request->get('convenio'));
            }
        })->sum('valorPag');
        $despesa = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->where('tipo', 1)->whereHas('agendamento', function ($q) use ($request) {
            if($request->get('convenio') == "0") {

            } else {
                $q->where('convenio_id', '=', $request->get('convenio'));
            }
        })->sum('valorPag');

        $convenios = Convenio::all();
        $total = $receita - $despesa;
        $total = number_format((float)$total, 2, '.', '');
        return view('backend.caixas.caixaRelatorio', compact('movimento', 'total', 'convenios'));
    }

    public function relatorioPrint(Request $request)
    {
        if($request->get('datainicio')) {
            $dtInicio = Carbon::createFromFormat('d/m/Y', $request->get('datainicio'))->startOfDay();
        } else {
            $dtInicio = Carbon::now();
        }

        if($request->get('datafim')) {
            $dtFim = Carbon::createFromFormat('d/m/Y', $request->get('datafim'))->endOfDay();
        } else {
            $dtFim = Carbon::now();
        }
        $movimento1 = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->whereHas('agendamento', function ($q) use ($request) {
            if($request->get('convenio') == "0") {

            } else {
                $q->where('convenio_id', '=', $request->get('convenio'));
            }
        })->get();

        $movimento2 = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->where('tipo', 1)->get();
        $movimento =  $movimento1->merge($movimento2)->sortBy('created_at');

        $receita = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->where('tipo', 0)->whereHas('agendamento', function ($q) use ($request) {
            if($request->get('convenio') == "0") {

            } else {
                $q->where('convenio_id', '=', $request->get('convenio'));
            }
        })->sum('valorPag');
        $despesa = MovimentoCaixa::whereBetween('created_at', [$dtInicio, $dtFim])->where('tipo', 1)->whereHas('agendamento', function ($q) use ($request) {
            if($request->get('convenio') == "0") {

            } else {
                $q->where('convenio_id', '=', $request->get('convenio'));
            }
        })->sum('valorPag');


        $total = $receita - $despesa;
        $total = number_format((float)$total, 2, '.', '');
        $dataSel = $request->get('datainicio') . " até " . $request->get('datafim');
        if($request->get('convenio') != "0") {
            $conv = Convenio::find($request->get('convenio'));
            $convNome = $conv->name;
        } else {
            $convNome = "TODOS";
        };

        $pdf = PDF::loadView('backend.caixas.relatorioPrint', ['data' => $movimento, 'total' => $total, 'datasel' => $dataSel, 'convenio' => $convNome]);
        return $pdf->setPaper('a4')->setOrientation('landscape')->inline('relatorio.pdf');
    }
}
