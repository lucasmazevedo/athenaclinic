@extends('tenant.layouts.app')

@section('title_head')
    Relatório Coleta
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card shadow-sm">
                {{-- <div class="card-header">
                    <h3 class="card-title">Filtros</h3>
                </div> --}}
                <form id="" class="" action="">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <label class="form-label required fw-semibold fs-6">Data</label>
                                <input type="text" name="nome"
                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" placeholder=""
                                    value="">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label required fw-semibold fs-6">Profissional</label>
                                <select name="" id=""
                                    class="form-select form-select-lg form-select-solid mb-lg-0 mb-3">
                                    <option disabled selected>Selecione</option>
                                    <option value="">Profissional 01</option>
                                    <option value="">Profissional 02</option>
                                    <option value="">Profissional 03</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required fw-semibold fs-6">Status</label>
                                <select name="" id=""
                                    class="form-select form-select-lg form-select-solid mb-lg-0 mb-3">
                                    <option disabled selected>Selecione</option>
                                    <option value="">Pendente</option>
                                    <option value="">Coletado</option>
                                    <option value="">Cancelado</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn w-100 btn-primary fw-bold mt-8 flex-shrink-0">Filtrar</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Relatório</h3>
                        <div class="card-toolbar">
                            <button class="btn btn-sm btn-primary">GERAR PDF</button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered gy-2 gs-7 table">
                                <thead class="bg-light-primary">
                                    <tr class="fw-semibold fs-6 border-bottom border-gray-200 text-gray-800">
                                        <th>PACIENTE</th>
                                        <th>EXAME</th>
                                        <th>STATUS</th>
                                        <th>PROFISSIONAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>
                                            <div>
                                                <span class="fs-6 fw-bold text-hover-primary mb-2 text-gray-900">MARIA
                                                    GORETE NARCISO DOS SANTOS GOMES</span>
                                                <div class="fw-semibold fs-7 text-muted">Cod. P0001 - Data de Nascimento:
                                                    27/05/1998</div>
                                            </div>
                                        </td>
                                        <td class="text-center">CLORETO (URINA 24H)</td>
                                        <td class="text-center"><span class="badge badge-success">COLETADO</span></td>
                                        <td>PROFISSIONAL DE COLETA 01</td>
                                    </tr>

                                    <tr class="align-middle">
                                        <td>
                                            <span class="fs-6 fw-bold text-hover-primary mb-2 text-gray-900">MARIA
                                                GORETE NARCISO DOS SANTOS GOMES</span>
                                            <div class="fw-semibold fs-7 text-muted">Cod. P0001 - Data de Nascimento:
                                                27/05/1998</div>
                                        </td>
                                        <td class="text-center">CLORETO (URINA 24H)</td>
                                        <td class="text-center"><span class="badge badge-success">COLETADO</span></td>
                                        <td>PROFISSIONAL DE COLETA 01</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('css_page')
@endpush
@push('js_page')
    <script></script>
@endpush
