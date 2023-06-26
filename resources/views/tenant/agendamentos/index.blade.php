@extends('tenant.layouts.app')

@section('title_head')
    Agendamentos
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="d-flex flex-stack mb-6 flex-wrap">
                <!--begin::Heading-->
                <h3 class="fw-bold my-2"></h3>
                <!--end::Heading-->

                <!--begin::Actions-->
                <div class="d-flex my-2 flex-wrap">
                    <div class="me-4">
                    </div>
                    <a href="#" class="btn btn-dark btn-sm me-2">Agendar Exame</a>
                    <a href="#" class="btn btn-dark btn-sm">Agendar Consulta</a>
                </div>
                <!--end::Actions-->
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow-sm" id="agenda-content">
                    </div>
                </div>

                <div class="col my-sidebar">
                    <div class="card-body" id="coreCalendarAg"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css_page')
    <style>
        .my-sidebar {
            -ms-flex: 0 0 230px;
            flex: 0 0 230px;
            /* background-color: greenyellow; */
        }
    </style>
@endpush
@push('js_page')
    <script>
        $.ajax({
            url: "{{ route('agendamentos.index') }}",
            data: {
                data: moment(Date.now()).format("YYYY-MM-DD"),
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
                Swal.close()
            },
            success: function(result) {
                $('#agenda-content').html(result);
            }
        });
        const picker = new tempusDominus.TempusDominus(document.getElementById("coreCalendarAg"), {
            restrictions: {
                minDate: undefined,
                maxDate: undefined,
                disabledDates: [],
                enabledDates: [],
                daysOfWeekDisabled: [0],
                disabledTimeIntervals: [],
                disabledHours: [],
                enabledHours: []
            },
            display: {
                viewMode: 'calendar',
                inline: true,
                components: {
                    calendar: true,
                    date: true,
                    month: true,
                    year: true,
                    decades: false,
                    clock: false,
                    hours: false,
                    minutes: false,
                    seconds: false,
                    useTwentyfourHour: undefined
                },
            },

            localization: {
                locale: "pt-BR",
                startOfTheWeek: 1
            }
        });
        picker.subscribe(tempusDominus.Namespace.events.change, (e) => {
            var date = moment(e.date).format("YYYY-MM-DD");
            document.getElementById('agDate').innerHTML = moment(e.date).format("DD/MM/YYYY");
            $.ajax({
                url: "{{ Route('agendamentos.index') }}",
                data: {
                    data: moment(e.date).format("YYYY-MM-DD"),
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
                    Swal.close()
                },
                success: function(result) {
                    $('#agenda-content').html(result);
                }
            });
        });

        $('body').on('click', '.btnChangeStatus', function(e) {
            e.preventDefault();
            var href = $(this).attr('data-href');
            var statusID = $(this).attr('data-id');
            console.log(statusID);
        });
    </script>
@endpush
