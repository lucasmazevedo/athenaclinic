<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Sala;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class SalaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Sala::select('*')->orderBy('name', 'ASC');
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
                        <a data-href="'. route('salas.editar', $row->id) .'" id="btnActionModal" class="btn btn-icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a data-href="'. route('salas.deletar', $row->id) .'" class="btn btn-icon btn-danger btn_delete"><i class="bi bi-trash"></i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id'])
                    ->make(true);
        }
        return view('tenant.salas.index');
    }

    public function create()
    {
        return response()->json(View::make('tenant.salas.cadastrar')->render());
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
            $sala = new Sala();
            $sala->tipo = $request->get('tipo');
            $sala->name = $request->get('name');
            $sala->save();
            return response()->json(['success' => 'Sala cadastrada com sucesso', 'data' => $sala]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function edit(string $id)
    {
        $model = Sala::findOrFail($id);
        return response()->json(View::make('tenant.salas.editar', compact('model'))->render());
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
            $sala = Sala::findOrFail($id);
            $sala->tipo = $request->get('tipo');
            $sala->name = $request->get('name');
            $sala->update();
            return response()->json(['success' => 'Sala alterada com sucesso', 'data' => $sala]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $sala = Sala::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }

        $result = $sala->delete();

        if ($result) {
            return response()->json(['success' => 'Sala deletada com sucesso.']);
        } else {
            return response()->json(['error' => 'Não foi possível completar esta ação, tente novamente!']);
        }
    }
}
