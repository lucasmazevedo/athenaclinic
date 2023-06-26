    <div class="card-header">
        <h3 class="card-title">Agendamentos do Dia (<span class="fw-bolder" id="agDate">{{ $data }}</span>)
        </h3>
        <div class="card-toolbar">
            <span class="badge badge-dark">{{ $agendamentos->count() }} Agendamentos</span>
        </div>
    </div>
    <div class="card-body px-0 py-0">
        <table id="" class="table-rounded fs-6 gy-2 my-0 table pb-1 align-middle">
            <thead class="bg-light-primary">
                <tr class="text-center">
                    <th>Horário</th>
                    <th>Paciente</th>
                    <th>Procedimento</th>
                    <th>Médico</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>

        <div class="table-responsive px-3">
            <table id="" class="table-rounded fs-6 gy-2 my-0 table pb-1 align-middle">
                <tbody>
                    @forelse ($agendamentos as $agenda)
                        <tr class="odd">
                            <td class="min-w-70px">
                                <div class="position-relative ps-3 pe-3 py-2">
                                    <div data-title="{{ $agenda->status['text'] }}"
                                        class="position-absolute start-0 w-6px h-100 rounded-2 bg-{{ $agenda->status['color'] }} top-0">
                                    </div>
                                    <div class="text-center">
                                        <div class="fw-semibold fs-2 text-gray-800">
                                            {{ \Carbon\Carbon::parse($agenda->horario)->format('H:i') }}<span
                                                class="fw-semibold fs-7 text-gray-400">h</span>
                                        </div>
                                        <span class="badge badge-dark">Exame</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <!--begin::Icons-->
                                <div class="d-flex mb-2 gap-2">
                                </div>
                                <!--end::Icons-->
                                <div class="fw-bold">{{ $agenda->paciente->nome }}</div>
                                <div class="fs-7 text-muted">CPF: <span
                                        class="fw-bold">{{ showDoc($agenda->paciente->cpf) }}
                                    </span> | Idade:
                                    <span class="fw-bold">
                                        {{ \Carbon\Carbon::parse($agenda->paciente->dtnascimento)->diffInYears(\Carbon\Carbon::now()) }}</span>
                                </div>
                            </td>
                            <td class="min-w-150px text-center">
                                @if ($agenda->procedimentos->count() > 1)
                                    <div class="fw-bold mb-2">{{ $agenda->procedimentos->first()->name }}
                                        (+{{ $agenda->procedimentos->count() - 1 }})</div>
                                @else
                                    <div class="fw-bold mb-2">{{ $agenda->procedimentos->first()->name }}</div>
                                @endif
                                <span class="badge badge-{{ $agenda->status_pagamento['color'] }}"><i
                                        class="bi bi-coin fs-3 me-3 text-white"></i>{{ $agenda->status_pagamento['text'] }}</span>
                            </td>
                            <td class="text-center">
                                @if ($agenda->medico)
                                    <div class="fw-bold mb-2">{{ $agenda->medico }}</div>
                                @else
                                    <div class="fw-bold mb-2">---------</div>
                                @endif
                                <div class="fw-bold text-muted mb-2">{{ $agenda->convenio->name }}</div>
                            </td>
                            <td class="text-end">
                                <a data-href="{{ route('agendamentos.show', $agenda->id) }}" id="btnActionModal"
                                    class="btn btn-icon btn-sm btn-dark"><i class="bi bi-info-circle-fill fs-2"></i></a>
                                <button type="button" class="btn btn-icon btn-sm btn-dark">
                                    <i class="bi bi-coin fs-2"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="table-light">
                            <td colspan="6">Nenhum agendamento para data selecionada</td>
                        </tr>
                    @endforelse
                </tbody>
                <!--end::Table-->
            </table>
        </div>

    </div>
