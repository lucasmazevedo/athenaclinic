<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Convenio;
use App\Models\Tenant\Preco;
use App\Models\Tenant\Procedimento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class ConvenioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Convenio::select('*')->orderBy('name', 'ASC');
            return DataTables::of($model)
                    ->addIndexColumn()
                    ->editColumn('id', function ($row) {
                        return '<span class="badge bg-light border-start border-width-3 text-body rounded-start-0 border-dark">'. str_pad($row->id, 4, '0', STR_PAD_LEFT) .'</span>';
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d/m/Y') . " às " . Carbon::parse($row->created_at)->format('H:i');
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '
                        <a data-href="'. route('convenios.valores', $row->id) .'" id="btnActionModal" class="btn btn-icon btn-primary"><i class="bi bi-cash-coin"></i></a>
                        <a data-href="'. route('convenios.editar', $row->id) .'" id="btnActionModal" class="btn btn-icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a data-href="'. route('convenios.deletar', $row->id) .'" class="btn btn-icon btn-danger btn_delete"><i class="bi bi-trash"></i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id'])
                    ->make(true);
        }
        return view('tenant.convenios.index');
    }

    public function create()
    {
        return response()->json(View::make('tenant.convenios.cadastrar')->render());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        try {
            $convenio = new Convenio();
            $convenio->name = $request->get('name');
            $convenio->registro_ans = $request->get('registro_ans');
            $convenio->dias_retorno = $request->get('dias_retorno');
            $convenio->limite_diario = $request->get('limite_diario');
            $convenio->tipo_valores = $request->get('tipo_valores');
            $convenio->porcentagem = $request->get('porcentagem');
            $convenio->save();
            $procedimentos = Procedimento::all();
            if($convenio->tipo_valores == 0) {
                foreach($procedimentos as $p) {
                    $preco = new Preco();
                    $preco->procedimento_id = $p->id;
                    $preco->convenio_id = $convenio->id;
                    $preco->preco = "0.00";
                    $preco->save();
                }
            } elseif($convenio->tipo_valores == 1) {
                foreach($procedimentos as $p) {
                    $preco = new Preco();
                    $preco->procedimento_id = $p->id;
                    $preco->convenio_id = $convenio->id;
                    $preco_base = Preco::where('convenio_id', 1)->where('procedimento_id', $p->id)->first()->preco;
                    $preco->preco = floatval($preco_base) * ((100-$convenio->porcentagem) / 100);
                    $preco->save();
                }
            }

            return response()->json(['success' => 'Convênio cadastrado com sucesso', 'data' => $convenio]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function edit(string $id)
    {
        $model = Convenio::findOrFail($id);
        return response()->json(View::make('tenant.convenios.editar', compact('model'))->render());
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            $convenio = Convenio::findOrFail($id);
            $convenio->name = $request->get('name');
            $convenio->registro_ans = $request->get('registro_ans');
            $convenio->dias_retorno = $request->get('dias_retorno');
            $convenio->limite_diario = $request->get('limite_diario');
            $convenio->update();
            return response()->json(['success' => 'Convênio alterado com sucesso', 'data' => $convenio]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function valores($id)
    {
        $model = Convenio::findOrFail($id);
        $procedimentos = Procedimento::all();
        $precos = Preco::where('convenio_id', $id)->get();
        return view('tenant.convenios.valores', compact('precos', 'model', 'procedimentos'));
    }

    public function valoresUpdate(Request $request, $id)
    {
        $convenio = Convenio::findOrFail($id);
        $convenios = Convenio::all();
        $data = $request->all();
        foreach ($data as $key => $value) {
            if($key != '_token') {
                $procedimento_id = preg_replace('/[^0-9.]+/', '', $key);
                $preco = Preco::where('convenio_id', $convenio->id)->where('procedimento_id', $procedimento_id)->first();
                $valores = explode('_', $key);
                if($valores[0] == "preco") {
                    $preco->preco = number_format($this->onlyNumber($value)/100, 2, '.', '');
                }
                $preco->update();
                foreach($convenios as $c) {
                    if($c->tipo_valores == 1) {
                        $precoNovo = Preco::where('convenio_id', $c->id)->where('procedimento_id', $procedimento_id)->first();
                        $preco_base = Preco::where('convenio_id', 1)->where('procedimento_id', $procedimento_id)->first()->preco;
                        $precoNovo->preco = floatval($preco_base) * ((100-$c->porcentagem) / 100);
                        // dd($precoNovo);

                        // $preco->preco = floatval($preco_base) * ((100-$convenio->porcentagem) / 100);
                        $precoNovo->update();
                    }
                }
            }
        }
        return response()->json(['success' => 'Valores atualizados com sucesso', 'data' => $convenio]);
    }

    public function destroy(string $id)
    {
        try {
            $convenio = Convenio::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }

        $result = $convenio->delete();

        if ($result) {
            return response()->json(['success' => 'Convênio deletado com sucesso.']);
        } else {
            return response()->json(['error' => 'Não foi possível completar esta ação, tente novamente!']);
        }
    }

    private function onlyNumber($value)
    {
        return preg_replace('/[^0-9]+/', '', $value);
    }

}
