@extends('tenant.layouts.app')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Atendimentos em Espera</h3>
                            <div class="card-toolbar">
                                <span class="badge badge-dark">3 Agendamentos</span>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive px-3">
                                <table id=""
                                    class="table-row-bordered table-rounded fs-6 gy-2 my-0 table pb-1 align-middle">
                                    <thead class="bg-light-primary">
                                        <tr class="fw-bold text-center">
                                            <td>Horário</td>
                                            <th class="ps-4 text-start">Paciente</th>
                                            <th>Procedimento</th>
                                            <th>Profissional</th>
                                            <th>Convênio</th>
                                            <th class="pe-5 text-end">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($agendamentos as $agenda)
                                            @foreach ($agenda->procedimentos as $p)
                                                <tr class="odd">
                                                    <td class="min-w-70px">
                                                        <div class="text-center">
                                                            <div class="fw-semibold fs-2 text-gray-800">
                                                                {{ \Carbon\Carbon::parse($agenda->horario)->format('H:i') }}<span
                                                                    class="fw-semibold fs-7 text-gray-400">h</span>
                                                            </div>
                                                            @if ($agenda->tipo == 0)
                                                                <span class="badge badge-dark">Consulta</span>
                                                            @elseif($agenda->tipo == 1)
                                                                <span class="badge badge-dark">Exame</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <!--begin::Icons-->
                                                        <div class="d-flex mb-2 gap-2">
                                                        </div>
                                                        <!--end::Icons-->
                                                        <div class="fw-bold">{{ $agenda->paciente->nome }}</div>
                                                        <div class="fs-7 text-muted">CPF: <span
                                                                class="fw-bold">{{ showDoc($agenda->paciente->cpf) }}</span>
                                                            | Idade: <span class="fw-bold">
                                                                {{ \Carbon\Carbon::parse($agenda->paciente->dtnascimento)->diffInYears(\Carbon\Carbon::now()) }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="min-w-150px text-center">
                                                        <div class="fw-bold mb-2">{{ $p->name }}</div>
                                                        <span class="badge badge-dark">Sala TC</span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($agenda->medico)
                                                            <div class="fw-bold mb-2">{{ $agenda->medico }}</div>
                                                        @else
                                                            <div class="fw-bold mb-2">---------</div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="fw-bold mb-2">{{ $agenda->convenio->name }}</div>
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-icon btn-sm btn-primary">
                                                            <i class="bi bi-bell-fill fs-2"></i>
                                                        </button>
                                                        @if ($agenda->tipo == 0)
                                                            <a href="{{ route('atendimentos.consulta', $agenda->id) }}"
                                                                class="btn btn-sm btn-success">
                                                                <i class="bi bi-play-fill fs-2"></i> INICIAR
                                                            </a>
                                                        @else
                                                            @if ($p->captura == 1)
                                                                <a href="" class="btn btn-sm btn-success">
                                                                    <i class="bi bi-camera-video-fill fs-2"></i> INICIAR
                                                                </a>
                                                            @else
                                                                <button type="button" class="btn btn-icon btn-sm btn-info">
                                                                    <i class="bi bi-check2-all fs-2"></i>
                                                                </button>
                                                            @endif
                                                        @endif
                                                        <a data-href="{{ route('agendamentos.show', $agenda->id) }}"
                                                            id="btnActionModal" class="btn btn-icon btn-sm btn-dark"><i
                                                                class="bi bi-info-circle-fill fs-2"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr class="table-light">
                                                <td colspan="6">Nenhum procedimento em espera para está data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <!--end::Table-->
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
@endpush
