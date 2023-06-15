<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Funcionario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Funcionario::select('*')->orderBy('nome', 'ASC');
            return DataTables::of($model)
                    ->addIndexColumn()
                    ->editColumn('id', function ($row) {
                        return '<span class="badge bg-light border-start border-width-3 text-body rounded-start-0 border-dark">'. str_pad($row->id, 4, '0', STR_PAD_LEFT) .'</span>';
                    })
                    ->editColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d/m/Y') . " às " . Carbon::parse($row->created_at)->format('H:i');
                    })
                    ->editColumn('administrador', function ($row) {
                        return "<span class='badge badge-". $row->administrador['color'] ."'>" . $row->administrador['text'] . "</span>";
                    })
                    ->editColumn('status', function ($row) {
                        return "<span class='badge badge-". $row->status['color'] ."'>" . $row->status['text'] . "</span>";
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '
                        <a data-href="'. route('funcionarios.editar', $row->id) .'" id="btnActionModal" class="btn btn-icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a data-href="'. route('funcionarios.deletar', $row->id) .'" class="btn btn-icon btn-danger btn_delete"><i class="bi bi-trash"></i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action', 'id', 'status', 'administrador'])
                    ->make(true);
        }
        return view('tenant.funcionarios.index');
    }

    public function create()
    {
        return response()->json(View::make('tenant.funcionarios.cadastrar')->render());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'usuario' => 'required|unique:users,username',
            'email' => 'required|email|unique:funcionarios,email',
            'senha' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            $user = new User();
            $user->username = $request->get('usuario');
            $user->password = Hash::make('senha');
            $user->save();
            $funcionario = new Funcionario();
            $funcionario->nome = $request->get('nome');
            $funcionario->email = $request->get('email');
            $funcionario->cpf = onlyNumber($request->get('cpf'));
            $funcionario->dtnascimento = dataMysql($request->get('dtnascimento'));
            $funcionario->sexo = $request->get('sexo');
            $funcionario->telefone = onlyNumber($request->get('telefone'));
            $funcionario->administrador = $request->get('administrador');
            $funcionario->save();
            $funcionario->user()->save($user);

            return response()->json(['success' => 'Funcionário cadastrado com sucesso', 'data' => $funcionario]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    public function edit(string $id)
    {
        $model = Funcionario::findOrFail($id);
        return response()->json(View::make('tenant.funcionarios.editar', compact('model'))->render());
    }

    public function update(Request $request, string $id)
    {
        $funcionario = Funcionario::find($id);
        $user = $funcionario->user;

        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'usuario' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:funcionarios,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        try {
            $user->username = $request->get('usuario');
            if($request->get('senha') != '') {
                $user->password = Hash::make('senha');
            }
            $user->update();
            $funcionario->nome = $request->get('nome');
            $funcionario->email = $request->get('email');
            $funcionario->cpf = onlyNumber($request->get('cpf'));
            $funcionario->dtnascimento = dataMysql($request->get('dtnascimento'));
            $funcionario->sexo = $request->get('sexo');
            $funcionario->telefone = onlyNumber($request->get('telefone'));
            $funcionario->administrador = $request->get('administrador');
            $funcionario->update();

            return response()->json(['success' => 'Funcionário alterado com sucesso', 'data' => $funcionario]);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]]);
        }
        $funcionario->status = 0;
        $result = $funcionario->update();

        if ($result) {
            return response()->json(['success' => 'Usuário desativado com sucesso.']);
        } else {
            return response()->json(['error' => 'Não foi possível completar esta ação, tente novamente!']);
        }
    }
}
