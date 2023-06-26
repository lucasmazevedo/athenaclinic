@extends('tenant.layouts.app')

@section('title_head')
    Movimento de Caixa (ID:{{ $model->id }} - DATA:
    {{ \Carbon\Carbon::parse($model->dtabertura)->format('d/m/Y') }} - {!! $model->status == 1 ? 'FECHADO' : 'ABERTO' !!})
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-core-table-filter="search"
                                class="form-control form-control-sm form-control-solid w-250px ps-14"
                                placeholder="Pesquisar" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <a data-href="{{ route('caixas.lancarMovimento', $model->id) }}" id="btnActionModal"
                            class="btn btn-sm btn-dark">
                            <i class="fas fa-plus-square fs-2 me-2"></i> Lançar Registro
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table-row-dashed fs-6 table align-middle" id="coreDatatable">
                        <thead>
                            <tr class="text-muted fw-bold fs-7 gs-2 text-uppercase text-start">
                                <th class="min-w-125px">Data</th>
                                <th class="min-w-125px">Forma</th>
                                <th class="min-w-125px">Descrição</th>
                                <th class="min-w-125px">Lançado por</th>
                                <th class="min-w-125px">Valor</th>
                                <th class="min-w-70px text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        </tbody>
                    </table>
                    <div class="row bg-success fs-2 m-2 mt-2 text-center text-white">
                        <div class="col-md-12">
                            Saldo do Caixa: {{ $saldoC }}
                        </div>
                    </div>
                    <div class="row m-2 mt-2">
                        <div class="col-md-6">
                            <table
                                class="tableTotal col-md-6 table-striped table-bordered table-hover table-condensed table">
                                <tbody class="text-center">
                                    <tr class="success">
                                        <th colspan="3"> Total de Entradas</th>
                                    </tr>
                                    <tr>
                                        <td>Dinheiro <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/din.png') }}"><br>
                                            {{ $di_r }}</td>
                                        <td>Cartão de Débito <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/cdeb.png') }}">
                                            <br>{{ $cd_r }}
                                        </td>
                                        <td>Cartão de Crédito <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/ccred.png') }}">
                                            <br>{{ $cc_r }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Transferência <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/transf.png') }}"><br>
                                            {{ $tr_r }}</td>
                                        <td>Cheque <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/cheque.png') }}"><br>
                                            {{ $cq_r }}</td>
                                        <td>Boleto <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/boleto.png') }}">
                                            <br>
                                            {{ $bo_r }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pix <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/pix.png') }}"><br>
                                            {{ $pi_r }}
                                        </td>
                                    </tr>
                                    <tr>

                                        <td colspan="3">Total: {{ $totalR }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table
                                class="tableTotal col-md-6 table-striped table-bordered table-hover table-condensed table">
                                <tbody class="text-center">
                                    <tr class="danger">
                                        <th colspan="3"> Total de saidas</th>
                                    </tr>
                                    <tr>
                                        <td>Dinheiro <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/din.png') }}"><br>
                                            {{ $di_d }}</td>
                                        <td>Cartão de Débito <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/cdeb.png') }}">
                                            <br>{{ $cd_d }}
                                        </td>
                                        <td>Cartão de Crédito <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/ccred.png') }}">
                                            <br>{{ $cc_d }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Transferência <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/transf.png') }}"><br>
                                            {{ $tr_d }}</td>
                                        <td>Cheque <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/cheque.png') }}"><br>
                                            {{ $cq_d }}</td>
                                        <td>Boleto <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/boleto.png') }}"><br>
                                            {{ $bo_d }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pix <img width="18"
                                                src="{{ global_asset('/assets/images/formasPag/pix.png') }}"><br>
                                            {{ $pi_d }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Total: {{ $totalD }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css_page')
    <link href="{{ global_asset('/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .card .card-header {
            min-height: 0px;
        }

        .btn.btn-icon {
            height: 30px;
            width: 30px;
        }
    </style>
@endpush

@push('js_page')
    <script src="{{ global_asset('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        var dt = $("#coreDatatable").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ route('caixas.movimento', $model->id) }}",
            },
            columns: [{
                    data: 'created_at'
                },
                {
                    data: 'forma'
                },
                {
                    data: 'descricao'
                },
                {
                    data: 'userLan'
                },
                {
                    data: 'valorPag'
                },
                {
                    data: 'action',
                    className: 'text-end'
                },
            ],
            language: {
                processing: "Carregando...",
                search: "Pesquisar",
                lengthMenu: "_MENU_",
                info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 até 0 de 0 registro(s)",
                infoFiltered: "(Filtrados de _MAX_ registros)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum registro encontrado",
                emptyTable: "Nenhum registro encontrado",
                paginate: {
                    "next": "Próximo",
                    "previous": "Anterior",
                    "first": "Primeiro",
                    "last": "Último"
                }
            }
        })
        const filterSearch = document.querySelector('[data-core-table-filter="search"]');
        filterSearch.addEventListener('keyup', function(e) {
            dt.search(e.target.value).draw();
        });

        $(document).on('init.dt', function(e, settings) {
            var api = new $.fn.dataTable.Api(settings);
            var state = api.state.loaded();
            if (state != null) {
                filterSearch.value = state.search.search;
            }
        });
    </script>
@endpush
