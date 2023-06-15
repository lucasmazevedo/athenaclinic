@extends('tenant.layouts.app')

@section('title_head')
    Especialidades
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
                        <a data-href="{{ route('especialidades.cadastrar') }}" id="btnActionModal"
                            class="btn btn-sm btn-dark">
                            <i class="fas fa-plus-square fs-2 me-2"></i> Novo Registro
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table-row-dashed fs-6 table align-middle" id="coreDatatable">
                        <thead>
                            <tr class="text-muted fw-bold fs-7 gs-2 text-uppercase text-start">
                                <th class="min-w-125px">Cod.</th>
                                <th class="min-w-125px">Nome</th>
                                <th class="min-w-70px text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                        </tbody>
                    </table>
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
                url: "{{ route('especialidades.index') }}",
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
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
