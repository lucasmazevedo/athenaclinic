<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cid10;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class Cid10Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Cid10::select('*')->orderBy('cod', 'ASC');
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
                        <a data-href="'. route('cid10.editar', $row->id) .'" id="btnActionModal" class="btn btn-icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a data-href="'. route('cid10.deletar', $row->id) .'" class="btn btn-icon btn-danger btn_delete"><i class="bi bi-trash"></i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id'])
                    ->make(true);
        }
        return view('tenant.cid10.index');
    }

    public function create()
    {
        return response()->json(View::make('tenant.cid10.cadastrar')->render());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cod' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        try {
            $cid10 = new Cid10();
            $cid10->cod = $request->get('cod');
            $cid10->name = $request->get('name');
            $cid10->save();
            return response()->json(['success' => 'Cid 10 cadastrado com sucesso', 'data' => $cid10]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function edit(string $id)
    {
        $model = Cid10::findOrFail($id);
        return response()->json(View::make('tenant.cid10.editar', compact('model'))->render());
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cod' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            $cid10 = Cid10::findOrFail($id);
            $cid10->cod = $request->get('cod');
            $cid10->name = $request->get('name');
            $cid10->update();
            return response()->json(['success' => 'Cid 10 alterado com sucesso', 'data' => $cid10]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $cid10 = Cid10::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }

        $result = $cid10->delete();
        // $result = true;
        if ($result) {
            return response()->json(['success' => 'Cid 10 deletado com sucesso.']);
        } else {
            return response()->json(['error' => 'Não foi possível completar esta ação, tente novamente!']);
        }
    }
}
