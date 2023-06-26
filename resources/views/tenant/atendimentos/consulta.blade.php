@extends('tenant.layouts.app')

@section('title_head')
    Atendimento Consulta (Paciente: {{ $agendamento->paciente->nome }})
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fuild">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid me-lg-15 order-lg-1 mb-lg-0 order-2 mb-10">
                    <form class="form" action="#" id="kt_subscriptions_create_new">
                        <div class="card card-flush mb-lg-10 mb-5 pt-3">
                            <div class="card-body pt-0">

                                <div class="pt-5">
                                    <label class="form-label">Queixa Principal (QP) / Motivo da avaliação:</label>
                                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder=""
                                        value="">
                                </div>

                                <div class="pt-5">
                                    <label class="form-label">Historia da Doença atual:</label>
                                    <textarea id="tbQP" name="tbQP" class="tox-target tinymce">{{ $agendamento->historico->queixa_principal }}
                                    </textarea>
                                </div>

                                <div class="pt-5">
                                    <label class="form-label">Histórico Familiar (HF):</label>
                                    <textarea id="tbHF" name="tbHF" class="tox-target tinymce">
                                    {{ $agendamento->historico->historico }}
                                    </textarea>
                                </div>

                                <div class="pt-5">
                                    <label class="form-label">Observações:</label>
                                    <textarea id="tbOBS" name="tbOBS" class="tox-target tinymce">
                                    {{ $agendamento->historico->obs }}
                                    </textarea>
                                </div>

                                <div class="pt-5">
                                    <label class="form-label">CID 10:</label>
                                    <select id="selectCID" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Select an option">
                                        <option value="">Não Informado</option>
                                        @foreach ($cid10 as $c)
                                            <option value="{{ $c->id }}"
                                                @if ($agendamento->historico->cid10_id == $c->id) selected @endif>{{ $c->cod }} -
                                                {{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px order-lg-2 order-1 mb-10">
                    <div class="card card-flush mb-0 pt-3" data-kt-sticky="true" data-kt-sticky-name="subscription-summary"
                        data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto"
                        data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95"
                        data-kt-sticky-enabled="true">
                        <div class="card-body py-2 px-0 pt-3 text-center">
                            <h1 id="timerConsulta">Iniciando...</h1>
                        </div>
                        <div class="separator separator-dashed"></div>
                        <div class="w-100 bg-light-primary fs-3 text-center">Dados do Paciente</div>
                        <div class="separator separator-dashed mb-5"></div>
                        <div class="card-body fs-6 pt-0">
                            <div class="mb-7">
                                <span>Código: <span
                                        class="fw-bold">{{ $agendamento->paciente->cod_acesso }}</span></span><br>
                                <span>Nome: <span class="fw-bold">{{ $agendamento->paciente->nome }}</span></span><br>
                                <span>Idade: <span class="fw-bold"> 34 anos (27/05/1988)</span></span><br>
                                <span>Convênio: <span class="fw-bold"> {{ $agendamento->convenio->name }}</span></span><br>
                                <span>Nome da mãe: <span class="fw-bold">
                                        {{ $agendamento->paciente->nome_mae }}</span></span><br>
                            </div>
                            <div class="separator separator-dashed mb-5"></div>
                            <div class="mb-0 text-center">
                                <a id="btnModalConsulta"
                                    data-href="{{ route('atendimentos.documentos', $agendamento->id) }}"
                                    class="btn btn-sm btn-dark w-100 mb-5">
                                    Documentos
                                </a>
                            </div>
                            <div class="separator separator-dashed mb-5"></div>
                            <div class="mb-0 text-center">
                                <a href="" class="btn btn-sm btn-primary mb-5">
                                    Finalizar Consulta
                                </a><br>
                                <div class="separator separator-dashed"></div>
                                <div id="statusDiv" class="w-100 bg-light-primary fs-7 text-center"></div>
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
    <script src="{{ global_asset('/assets/js/timer.min.js') }}"></script>
    <script src="{{ global_asset('/assets/js/tinymce/tinymce.js') }}"></script>
    <script>
        var dtStart = new Date('{{ $agendamento->historico->dtInicio }}');
        var atualTime = new Date();
        var difference = (atualTime - dtStart) / 1000;
        var timer = new easytimer.Timer();
        var startTime = [0, difference, 0, 0, 0]
        timer.start({
            startValues: startTime,

        });
        timer.addEventListener("secondsUpdated", function(e) {
            $("#timerConsulta").html(timer.getTimeValues().toString());
        });


        $(document).ready(function() {
            $('#coreModal').on('hidden.bs.modal', function(e) {
                $('#modal-content').html("");
                $('#coreModal').modal('dispose');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $('#selectCID').select2({
                    // ajax: {
                    //     url: "{{ route('cid10.listaCid') }}",
                    //     type: "post",
                    //     dataType: 'json',
                    //     delay: 250,
                    //     data: function(params) {
                    //         return {
                    //             _token: CSRF_TOKEN,
                    //             search: params.term // search term
                    //         };
                    //     },
                    //     processResults: function(response) {
                    //         return {
                    //             results: response
                    //         };
                    //     },
                    //     cache: true
                    // }
                });
            });

            function loadlink() {
                $.ajax({
                    url: "{{ route('atendimentos.salvar_consulta', $agendamento->historico->id) }}",
                    method: 'POST',
                    data: {
                        cid10: $('#selectCID').val(),
                        tbQP: tinyMCE.editors[$('#tbQP').attr('id')].getContent(),
                        tbHF: tinyMCE.editors[$('#tbHF').attr('id')].getContent(),
                        tbOBS: tinyMCE.editors[$('#tbOBS').attr('id')].getContent(),
                    },
                    success: function(result) {
                        console.log(result);
                        $("#statusDiv").text('');
                    },
                    beforeSend: function() {
                        $("#statusDiv").text("Salvando...");
                    },
                    complete: function() {
                        $("#statusDiv").text("Salvo às " + new Date().toLocaleString());
                    }
                });

            }

            setInterval(function() {
                console.log('salvando...');
                loadlink();
            }, 5000);

            $('body').on('click', '#btnModalConsulta', function(e) {
                e.preventDefault();
                var href = $(this).attr('data-href');
                $.ajax({
                    url: href,
                    method: 'GET',
                    success: function(result) {
                        $('#coreModal').modal('show');
                        $('#modal-content').html(result);
                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    }
                });
            });
        });
        //tinymce.baseURL = "/assets/editors/tinymce/";// trailing slash important
        // Basic TineMCE
        tinymce.init({
            selector: '.tinymce',
            height: 150,
            theme: 'modern',
            content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
            menubar: false,
            statusbar: false,
            fontsize_formats: "10pt 12pt 14pt 18pt 24pt 36pt",
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern image imagetools code variable'
            ],
            toolbar1: 'insertfile undo redo | fields_custom | bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist | link image code',
            //toolbar2: 'print preview media | forecolor backcolor emoticons',
            //image_advtab: true,

            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
            ],
            setup: function(editor) {
                window.tester = editor
                editor.addButton('fields_custom', {
                    type: 'menubutton',
                    text: 'Campos',
                    icon: false,
                    menu: [{
                            text: 'Nome Paciente',
                            onclick: function() {
                                editor.insertContent('{nome_paciente}');
                            }
                        },
                        {
                            text: 'Idade Paciente',
                            onclick: function() {
                                editor.insertContent('{idade_paciente}');
                            }
                        },
                        {
                            text: 'Sexo Paciente',
                            onclick: function() {
                                editor.insertContent('{sexo_paciente}');
                            }
                        },
                        {
                            text: 'Data Nascimento',
                            onclick: function() {
                                editor.insertContent('{data_nascimento}');
                            }
                        },
                        {
                            text: 'Medico Solicitante',
                            onclick: function() {
                                editor.insertContent('{medico_solicitante}');
                            }
                        },
                        {
                            text: 'Medico Realizante',
                            onclick: function() {
                                editor.insertContent('{medico_realizante}');
                            }
                        },
                        {
                            text: 'Data do Laudo',
                            onclick: function() {
                                editor.insertContent('{data_laudo}');
                            }
                        },
                        {
                            text: 'Data do Exame',
                            onclick: function() {
                                editor.insertContent('{data_exame}');
                            }
                        },
                        {
                            text: 'Convênio',
                            onclick: function() {
                                editor.insertContent('{convenio}');
                            }
                        },
                        {
                            text: 'Modalidade',
                            onclick: function() {
                                editor.insertContent('{modality_study}');
                            }
                        },
                        {
                            text: 'Número de Ordem',
                            onclick: function() {
                                editor.insertContent('{numero_ordem}');
                            }
                        },
                        {
                            text: 'Código Exame',
                            onclick: function() {
                                editor.insertContent('{codigo_exame}');
                            }
                        }
                    ]
                });
                editor.on('variableClick', function(e) {
                    console.log('click', e);
                });
            }
        });
    </script>
@endpush
