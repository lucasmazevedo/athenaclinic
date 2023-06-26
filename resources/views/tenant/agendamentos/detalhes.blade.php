<div class="modal-header">
    <h5 class="modal-title"><i class="ph-user-plus me-2"></i>Agendamento ({{ $agendamento->id }})</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
        <div class="me-2">
            <h6>{{ $agendamento->paciente->cod_acesso }} - {{ $agendamento->paciente->nome }}</h6>
            <ul class="list list-unstyled mb-0">
                <li>Data nasc. : <span
                        class="fw-semibold">{{ \Carbon\Carbon::parse($agendamento->paciente->dtnascimento)->format('d/m/Y') }}</span>
                </li>
                <li>CPF : <span class="fw-semibold">{{ $agendamento->paciente->cpf }}</span></li>
                <li>Endereço : <span class="fw-semibold">{{ $agendamento->paciente->end_rua }},
                        {{ $agendamento->paciente->end_numero }}, {{ $agendamento->paciente->end_bairro }} -
                        {{ $agendamento->paciente->end_cidade }}</span></li>
                <li>Contato : <span class="fw-semibold">{{ $agendamento->paciente->celular }}</span></li>
            </ul>
        </div>

        <div class="ms-5">
            <h6>Procedimentos:</h6>
            <ul class="list list-unstyled mb-0">
                @foreach ($agendamento->procedimentos as $p)
                    <li>{{ $p->name }}</li>
                @endforeach
            </ul>
        </div>

        <div class="text-sm-end mt-sm-0 ms-auto mb-0 mt-3">
            <h6><i class="bi bi-coin fs-3 me-1 text-{{ $agendamento->status_pagamento['color'] }}"></i><span
                    class="text-{{ $agendamento->status_pagamento['color'] }}">{{ $agendamento->status_pagamento['text'] }}</span>
            </h6>
            <ul class="list list-unstyled mb-0">
                <div class="dropdown">
                    <a href="#"
                        class="badge badge-{{ $agendamento->status['color'] }} d-inline-flex align-items-center dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ $agendamento->status['text'] }}</a>

                    <div class="dropdown-menu dropdown-menu-end" style="">
                        @if ($agendamento->status['id'] != 0)
                            <a data-href="{{ route('agendamentos.mudarStatus', $agendamento->id) }}" data-id="0"
                                class="dropdown-item btnChangeStatus" style="cursor: pointer;">
                                <span class="badge badge-dark d-block">Agendado</span>
                            </a>
                        @endif

                        @if ($agendamento->status['id'] != 1)
                            <a data-href="{{ route('agendamentos.mudarStatus', $agendamento->id) }}" data-id="1"
                                class="dropdown-item btnChangeStatus" style="cursor: pointer;">
                                <span class="badge badge-primary d-block">Confirmado</span>
                            </a>
                        @endif

                        @if ($agendamento->status['id'] != 2)
                            <a data-href="{{ route('agendamentos.mudarStatus', $agendamento->id) }}" data-id="2"
                                class="dropdown-item btnChangeStatus" style="cursor: pointer;">
                                <span class="badge badge-warning d-block text-black">Esperando</span>
                            </a>
                        @endif
                        @if ($agendamento->status['id'] != 3)
                            <a data-href="{{ route('agendamentos.mudarStatus', $agendamento->id) }}" data-id="3"
                                class="dropdown-item btnChangeStatus" style="cursor: pointer;">
                                <span class="badge badge-danger d-block">Cancelado</span>
                            </a>
                        @endif
                        @if ($agendamento->status['id'] != 4)
                            <a data-href="{{ route('agendamentos.mudarStatus', $agendamento->id) }}" data-id="4"
                                class="dropdown-item btnChangeStatus" style="cursor: pointer;">
                                <span class="badge badge-info d-block text-white">Não Compareceu</span>
                            </a>
                        @endif
                        @if ($agendamento->status['id'] != 5)
                            <a data-href="{{ route('agendamentos.mudarStatus', $agendamento->id) }}" data-id="5"
                                class="dropdown-item btnChangeStatus" style="cursor: pointer;">
                                <span class="badge badge-secondary d-block">Em Atendimento</span>
                            </a>
                        @endif

                        @if ($agendamento->status['id'] != 6)
                            <a data-href="{{ route('agendamentos.mudarStatus', $agendamento->id) }}" data-id="6"
                                class="dropdown-item btnChangeStatus" style="cursor: pointer;">
                                <span class="badge badge-success d-block">Finalizado</span>
                            </a>
                        @endif
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>

<div class="modal-footer">
    @if ($agendamento->status_pagamento['id'] == 1)
    @else
        <a data-href="{{ route('agendamentos.pagamento', $agendamento->id) }}" id="btnActionModal"
            class="btn btn-sm btn-success"><i class="bi bi-coin me-2"></i>Registrar Pagamento</i>
        </a>
    @endif
    <a href="{{ route('agendamentos.printFicha', $agendamento->id) }}" target="_Blank"
        class="btn btn-sm btn-primary"><i class="fas fa-print me-2"></i>Imprimir Ficha
    </a>
    <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal"><i
            class="fas fa-times me-1"></i>Fechar</button>
</div>

<script>
    $(document).ready(function() {

        $('body').on('click', '.btnChangeStatus', function(e) {
            e.preventDefault();
            var href = $(this).attr('data-href');
            var statusID = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: href,
                method: 'POST',
                data: {
                    'id': statusID
                },
                dataType: 'JSON',
                success: function(data, textStatus, xhr) {
                    date = new Date(data.data.horario);
                    console.log(date);
                    $.ajax({
                        url: "{{ route('agendamentos.index') }}",
                        data: {
                            data: moment(date).format("YYYY-MM-DD"),
                        },
                        method: 'GET',
                        beforeSend: function() {
                            Swal.fire({
                                allowOutsideClick: false,
                                showCancelButton: false, // There won't be any cancel button
                                showConfirmButton: false, // There won't be any confirm button
                                title: '<i class="ph-spinner spinner m-1 me-2"></i>Carregando...',
                                showClass: {
                                    backdrop: 'swal2-noanimation', // disable backdrop animation
                                    popup: '', // disable popup animation
                                    icon: '' // disable icon animation
                                },
                                hideClass: {
                                    popup: '', // disable popup fade-out animation
                                },
                            });
                        },
                        complete: function() {
                            Swal.close();
                        },
                        success: function(result) {
                            $('#agenda-content').html(result);
                            $('#coreModal').modal('hide');
                        }
                    });
                },
            });
        });

    });
</script>
