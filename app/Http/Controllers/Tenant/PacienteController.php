<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Paciente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Paciente::select('*')->orderBy('created_at', 'DESC');
            return DataTables::of($model)
                    ->addIndexColumn()
                    ->editColumn('id', function ($row) {
                        return '<span class="badge bg-light border-start border-width-3 text-body rounded-start-0 border-dark">'. str_pad($row->id, 4, '0', STR_PAD_LEFT) .'</span>';
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d/m/Y') . " às " . Carbon::parse($row->created_at)->format('H:i');
                    })
                    ->editColumn('dtnascimento', function ($row) {
                        return Carbon::parse($row->dtnascimento)->format('d/m/Y');
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '
                        <a data-href="'. route('pacientes.editar', $row->id) .'" id="btnActionModal" class="btn btn-icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a data-href="'. route('pacientes.deletar', $row->id) .'" class="btn btn-icon btn-danger btn_delete"><i class="bi bi-trash"></i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id'])
                    ->make(true);
        }
        return view('tenant.pacientes.index');
    }

    public function create()
    {
        return response()->json(View::make('tenant.pacientes.cadastrar')->render());
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'dtnascimento' => 'required|max:255',
            'sexo' => 'required|max:255',
            'celular' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            $model = new Paciente();
            $model->nome = $request->get('nome');
            $model->nome_social = $request->get('nome_social');
            $model->cpf = $this->onlyNumber($request->get('cpf'));

            $model->dtnascimento = Carbon::createFromFormat('d/m/Y', $request->get('dtnascimento'))->format('Y-m-d');
            $model->sexo = $request->get('sexo');
            $model->celular = $this->onlyNumber($request->get('celular'));
            $model->cep = $this->onlyNumber($request->get('cep'));
            $model->end_rua = $request->get('end_rua');
            $model->end_numero = $request->get('end_numero');
            $model->end_bairro = $request->get('end_bairro');
            $model->end_complemento = $request->get('end_complemento');
            $model->end_cidade = $request->get('end_cidade');
            $model->nome_mae = $request->get('nome_mae');
            $model->resp_menor = $request->get('resp_nome');
            $model->resp_cpf = $this->onlyNumber($request->get('resp_cpf'));
            $model->cod_acesso = "0000";
            $model->senha_acesso = "0000";
            $model->email = $request->get('email');
            $model->save();
            $model->cod_acesso = "PC" . str_pad($model->id, 4, '0', STR_PAD_LEFT);
            $model->senha_acesso = strtoupper(Str::random(8));
            $model->update();

            return response()->json(['success' => 'Paciente cadastrado com sucesso', 'data' => $model]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function edit(string $id)
    {
        $model = Paciente::findOrFail($id);
        return response()->json(View::make('tenant.pacientes.editar', compact('model'))->render());
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'dtnascimento' => 'required|max:255',
            'sexo' => 'required|max:255',
            'celular' => 'required|max:255',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            $model = Paciente::findOrFail($id);
            $model->nome = $request->get('nome');
            $model->nome_social = $request->get('nome_social');
            $model->cpf = $this->onlyNumber($request->get('cpf'));

            $model->dtnascimento = Carbon::createFromFormat('d/m/Y', $request->get('dtnascimento'))->format('Y-m-d');
            $model->sexo = $request->get('sexo');
            $model->celular = $this->onlyNumber($request->get('celular'));
            $model->cep = $this->onlyNumber($request->get('cep'));
            $model->end_rua = $request->get('end_rua');
            $model->end_numero = $request->get('end_numero');
            $model->end_bairro = $request->get('end_bairro');
            $model->end_complemento = $request->get('end_complemento');
            $model->end_cidade = $request->get('end_cidade');
            $model->nome_mae = $request->get('nome_mae');
            $model->resp_menor = $request->get('resp_nome');
            $model->resp_cpf = $this->onlyNumber($request->get('resp_cpf'));
            $model->email = $request->get('email');
            $model->update();

            return response()->json(['success' => 'Paciente alterado com sucesso', 'data' => $model]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $paciente = Paciente::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }

        $result = $paciente->delete();

        if ($result) {
            return response()->json(['success' => 'Paciente deletado com sucesso.']);
        } else {
            return response()->json(['error' => 'Não foi possível completar esta ação, tente novamente!']);
        }
    }

    private function onlyNumber($value)
    {
        return preg_replace('/[^0-9]+/', '', $value);
    }
}
