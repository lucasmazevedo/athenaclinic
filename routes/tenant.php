<?php

declare(strict_types=1);

use App\Events\PublicEvent;
use App\Http\Controllers\Tenant\Cid10Controller;
use App\Http\Controllers\Tenant\ConvenioController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\DocumentoController;
use App\Http\Controllers\Tenant\EspecialidadeController;
use App\Http\Controllers\Tenant\ModalidadeController;
use App\Http\Controllers\Tenant\PacienteController;
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
    Route::get('/', [DashboardController::class,'index'])->name('home');

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

    // --- MODULO SENHAS ---//
    Route::controller(SenhaController::class)->group(function () {
        Route::get('/senhas/fila', 'index')->name('senhas.fila.index');
    });
});
