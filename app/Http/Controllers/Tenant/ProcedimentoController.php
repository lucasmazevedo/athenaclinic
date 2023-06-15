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

class ProcedimentoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Procedimento::select('*')->orderBy('name', 'ASC');
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
                        <a data-href="'. route('procedimentos.editar', $row->id) .'" id="btnActionModal" class="btn btn-icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a data-href="'. route('procedimentos.deletar', $row->id) .'" class="btn btn-icon btn-danger btn_delete"><i class="bi bi-trash"></i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id'])
                    ->make(true);
        }
        return view('tenant.procedimentos.index');
    }

    public function create()
    {
        return response()->json(View::make('tenant.procedimentos.cadastrar')->render());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'tipo' => 'required|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        try {
            $procedimento = new Procedimento();
            $procedimento->tipo = $request->get('tipo');
            $procedimento->name = $request->get('name');
            $procedimento->save();
            $convenios = Convenio::all();
            foreach ($convenios as $c) {
                $preco = new Preco();
                $preco->procedimento_id = $procedimento->id;
                $preco->convenio_id = $c->id;
                $preco->preco = "0.00";
                $preco->save();
            }
            return response()->json(['success' => 'Procedimento cadastrado com sucesso', 'data' => $procedimento]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function edit(string $id)
    {
        $model = Procedimento::findOrFail($id);
        return response()->json(View::make('tenant.procedimentos.editar', compact('model'))->render());
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'tipo' => 'required|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            $procedimentos = Procedimento::findOrFail($id);
            $procedimentos->tipo = $request->get('tipo');
            $procedimentos->name = $request->get('name');
            $procedimentos->update();
            return response()->json(['success' => 'Procedimentos alterado com sucesso', 'data' => $procedimentos]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $procedimento = Procedimento::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }

        $result = $procedimento->delete();

        if ($result) {
            return response()->json(['success' => 'Procedimento deletado com sucesso.']);
        } else {
            return response()->json(['error' => 'Não foi possível completar esta ação, tente novamente!']);
        }
    }
}
