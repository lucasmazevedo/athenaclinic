<?php

declare(strict_types=1);

use App\Events\PublicEvent;
use App\Http\Controllers\Tenant\AgendamentoController;
use App\Http\Controllers\Tenant\AtendimentoController;
use App\Http\Controllers\Tenant\CaixaController;
use App\Http\Controllers\Tenant\Cid10Controller;
use App\Http\Controllers\Tenant\ConvenioController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\DocumentoController;
use App\Http\Controllers\Tenant\EspecialidadeController;
use App\Http\Controllers\Tenant\LaboratorioController;
use App\Http\Controllers\Tenant\LoginController;
use App\Http\Controllers\Tenant\ModalidadeController;
use App\Http\Controllers\Tenant\PacienteController;
use App\Http\Controllers\Tenant\PainelController;
use App\Http\Controllers\Tenant\ProcedimentoController;
use App\Http\Controllers\Tenant\ProfissionalController;
use App\Http\Controllers\Tenant\SalaController;
use App\Http\Controllers\Tenant\SenhaController;
use App\Http\Controllers\Tenant\UsuarioController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // login
    Route::name('tenant.')->controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::get('/', [DashboardController::class,'index'])->name('home');

    Route::prefix('/painel')->name('painel.')->controller(PainelController::class)->group(function () {
        Route::get('/display', 'display')->name('display');
    });
    Route::get('/chamar', function () {
        sleep(2);
        PublicEvent::dispatch(['AN-0021', 'Guichê 06']);
        sleep(9);
        PublicEvent::dispatch(['Lucas Martins de Azevedo', 'Consultório 02']);
    })->name('chamar.public.event');

    Route::get('/painel', function () {
        return view('tenant.painel.index');
    });

    Route::prefix('/cadastros')->group(function () {
        // --- MODULO CID 10 --- //
        Route::prefix('/cid10')->name('cid10.')->controller(Cid10Controller::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
            Route::post('/getCid10', 'listaCid')->name('listaCid');

        });

        // --- MODULO ESPECIALIDADE --- //
        Route::prefix('/especialidades')->name('especialidades.')->controller(EspecialidadeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });

        // --- MODULO MODALIDADES --- //
        Route::prefix('/modalidades')->name('modalidades.')->controller(ModalidadeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });

        // --- MODULO SALAS --- //
        Route::prefix('/salas')->name('salas.')->controller(SalaController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });

        // --- MODULO DOCUMENTOS --- //
        Route::prefix('/documentos')->name('documentos.')->controller(DocumentoController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });

        // --- MODULO PROCEDIMENTOS --- //
        Route::prefix('/procedimentos')->name('procedimentos.')->controller(ProcedimentoController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });

        // --- MODULO CONVENIOS --- //
        Route::prefix('/convenios')->name('convenios.')->controller(ConvenioController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
            Route::get('/{id}/valores', 'valores')->name('valores');
            Route::post('/{id}/valores/atualizar', 'valoresUpdate')->name('valoresUpdate');
        });

        // --- MODULO PACIENTES --- //
        Route::prefix('/pacientes')->name('pacientes.')->controller(PacienteController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });

        // --- MODULO FUNCIONÁRIOS --- //
        Route::prefix('/funcionarios')->name('funcionarios.')->controller(UsuarioController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });

        // --- MODULO PROFISSIONAIS --- //
        Route::prefix('/profissionais')->name('profissionais.')->controller(ProfissionalController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cadastrar', 'create')->name('cadastrar');
            Route::post('/cadastrar', 'store')->name('salvar');
            Route::get('/{id}/editar', 'edit')->name('editar');
            Route::post('/{id}/editar', 'update')->name('alterar');
            Route::delete('/{id}/deletar', 'destroy')->name('deletar');
        });
    });
    Route::prefix('/financeiro')->group(function () {
        Route::prefix('/caixas')->name('caixas.')->controller(CaixaController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/movimento', 'movimento')->name('movimento');
            Route::get('/abrir-caixa', 'abrirCaixa')->name('abrir');
            Route::post('/abrir-caixa', 'processaCaixa')->name('processaCaixa');
            Route::get('/fechar-caixa', 'fecharCaixa')->name('fechar');
            Route::post('/fechar-caixa', 'processaFechamentoCaixa')->name('processafechar');
            Route::delete('/{id}/movimento/deletar', 'destroyMovimento')->name('destroyMovimento');
            Route::get('/{id}/lancar-movimento', 'lancarMovimento')->name('lancarMovimento');
            Route::post('/{id}/lancar-movimento', 'processaMovimento')->name('processaMovimento');
            Route::get('/relatorios', 'relatorio')->name('relatorio');
            Route::get('/relatorios/imprimir', 'relatorioPrint')->name('relatorioPrint');
        });
    });

        Route::prefix('/atendimentos')->name('atendimentos.')->controller(AtendimentoController::class)->group(function () {
            Route::get('/{id}/consulta', 'consulta')->name('consulta');
            Route::post('/{id}/consulta', 'salvar_consulta')->name('salvar_consulta');
            Route::get('/{id}/documentos', 'documentos')->name('documentos');
            Route::get('/{id}/getDocumentos', 'getDocumentos')->name('getDocumentos');
            Route::post('/{id}/saveDocumentos', 'setDocumentos')->name('setDocumentos');
            Route::get('/{id}/printDocumento', 'printDocumento')->name('printDocumento');
        });

        Route::prefix('/laboratorio')->name('laboratorio.')->controller(LaboratorioController::class)->group(function () {
            Route::get('/coleta', 'coleta')->name('coleta');
            Route::get('/agenda', 'agenda')->name('agenda');
            Route::get('/relatorios', 'relatorios')->name('relatorios');
        });
    // --- MODULO SENHAS ---//
    Route::controller(SenhaController::class)->group(function () {
        Route::get('/senhas/fila', 'index')->name('senhas.fila.index');
    });

    Route::prefix('/agendamentos')->name('agendamentos.')->controller(AgendamentoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getAgendamentos', 'getAgendamentos')->name('getAgendamentos');
        Route::get('/getPacientes', 'getPacientes')->name('getPacientes');
        Route::get('/verificacao', 'verificacao')->name('verificacao');
        Route::get('/espera', 'espera')->name('espera');

        Route::get('/{id}/detalhes', 'show')->name('show');
        Route::get('/{id}/pagamento', 'pagamento')->name('pagamento');
        Route::post('/{id}/pagamento', 'registraPagamento')->name('registraPagamento');
        Route::post('/{id}/mudarStatus', 'mudarStatus')->name('mudarStatus');
        Route::get('/{id}/ficha', 'printFicha')->name('printFicha');
        Route::get('/{id}/recibo', 'printRecibo')->name('printRecibo');

        Route::get('/novo-agendamento', 'create')->name('create');
        Route::get('/novo-agendamento-consulta', 'createConsulta')->name('createConsulta');
        Route::post('/agendamento/cadastrar', 'store')->name('store');
        Route::post('/agendamento/cadastrarConsulta', 'storeConsulta')->name('storeConsulta');
        // Route::get('/{id}/chamar', 'chamarPaciente')->name('chamarPaciente');
        // Route::post('/{id}/chamar', 'RegistraPainel')->name('RegistraPainel');
    });
});
