<div class="modal-header">
    <h5 class="modal-title fs-1">Documentos</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form method="POST" enctype="multipart/form-data" id="formData">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Modelo:</label>
                    <select name="modelos" id="modelos"
                        class="form-select form-select-lg form-select-solid mb-lg-0 mb-3">
                        @foreach ($modelos_doc as $docu)
                            <option value="{{ $docu->id }}">{{ $docu->name }}</option>
                        @endforeach
                        <option value="122">Laudo Médico</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Título:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder=""
                        value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Conteúdo:</label>
                    <div id="conteudo_doc" name="conteudo_doc" class="tinymce">
                        <p>Modelo Atestado / Documento</p>
                    </div>
                </div>
                <div class="h-100 text-end">
                    <button type="button" id="btnSaveDocumento"
                        data-href="{{ route('atendimentos.setDocumentos', $documentos->first()->agendamento_id) }}"
                        class="btn btn-secondary"><i class="bi bi-save me-2"></i>Salvar</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="w-100 bg-light-primary fs-3 mb-2 text-center">Documentos Emitidos</div>
                <div id="doc_div">
                    @include('tenant.atendimentos.partials.documentos_table')
                </div>
            </div>

        </div>
        </fieldset>
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg me-2"></i>Fechar</button>
</div>
<style>
    .ql-editor {
        min-height: 200px;
    }
</style>
<script>
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
        toolbar1: 'bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist',
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
    $(document).on("change", "#modelos", function(e) {
        var $option = $(this).find('option:selected');
        $.ajax({
            url: '/atendimentos/' + $option.val() + '/getDocumentos',
            method: 'GET',
            success: function(result) {
                tinyMCE.activeEditor.setContent(result.data.conteudo);
            },
        });
    });
    $(document).on("click", "#btnSaveDocumento", function(e) {
        var href = $(this).attr('data-href');
        console.log(tinyMCE.activeEditor.getContent());
        $.ajax({
            url: href,
            method: 'POST',
            dataType: 'json',
            data: {
                titulo: $('#titulo').val(),
                conteudo: tinyMCE.activeEditor.getContent(),
            },
            success: function(data, textStatus, xhr) {
                $('#doc_div').html(data);
                console.log(data);
            },
        });
    });
</script>
