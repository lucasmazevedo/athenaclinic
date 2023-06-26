@extends('tenant.layouts.app')

@section('title_head')
    Registrar Coleta
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card p-6 shadow-sm">
                        <div class="w-100">
                            <h4 class="fs-5 fw-semibold text-gray-800">Digite o Código do Exame ou se o leitor</h4>
                            <div class="d-flex">
                                <input type="text" class="form-control form-control-solid me-3 flex-grow-1"
                                    name="search" value="" />

                                <button class="btn btn-light fw-bold flex-shrink-0"
                                    data-clipboard-target="#kt_share_earn_link_input">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="card p-6 shadow-sm">
                        <div class="table-responsive">
                            <table class="table-bordered gy-2 gs-7 table">
                                <thead class="bg-light-primary">
                                    <tr class="fw-semibold fs-6 border-bottom border-gray-200 text-gray-800">
                                        <th>#</th>
                                        <th>EXAME</th>
                                        <th>COR</th>
                                        <th>SETOR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="w-70px">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="flexCheckDefault" />
                                        </td>
                                        <td>CLORETO (URINA 24H)</td>
                                        <td>FRASCO URINA 24 HORAS</td>
                                        <td>APOIO</td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input" type="checkbox" value="1"
                                                id="flexCheckDefault" /></td>
                                        <td>COLESTEROL TOTAL</td>
                                        <td>TAMPA VERMELHA</td>
                                        <td>BIOQUIMICA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">REGISTRA COLETA</button>
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
