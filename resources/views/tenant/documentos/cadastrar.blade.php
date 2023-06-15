<div class="modal-header">
    <h5 class="modal-title">Cadastrar Documento</h5>

    <!--begin::Close-->
    <div class="btn btn-icon btn-sm ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="fas fa-times fs-2x text-white"></i>
    </div>
    <!--end::Close-->
</div>

<div class="modal-body">
    <form method="POST" enctype="multipart/form-data" id="formData">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder=""
                        value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="abbr" class="form-label">Tipo de Documento</label>
                    <select id="tipo" name="tipo" class="form-select">
                        <option selected disabled>Selecione um tipoa</option>
                        <option value="0">Receita</option>
                        <option value="1">Atestado</option>
                        <option value="2">Declaração</option>
                        <option value="3">Laudo</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="conteudo" class="form-label">Conteúdo</label>
                    <textarea type="text" id="conteudo" name="conteudo" class="form-control cloudmed_editor" placeholder="">{{ old('conteudo') }}</textarea>
                </div>
            </div>
        </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('documentos.salvar') }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
            class="fas fa-save me-2"></i> Salvar</a>
</div>
<style>
    .modal-header {
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: #1e1e2d;
        color: #fff;
    }

    .modal-title {
        color: #fff;
    }

    .modal-footer {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
        background-color: #f5f5f5;
        color: #fff;
    }
</style>
<script>
    var options = {
        selector: ".cloudmed_editor",
        height: "380",
        menubar: false,
        toolbar: [
            "undo redo | cut copy paste | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | subscript superscript"
        ],
        plugins: "advlist lists",
        setup: function(ed) {
            ed.on('change', function(e) {
                // This will print out all your content in the tinyMce box
                console.log('the content ' + ed.getContent());
                // Your text from the tinyMce box will now be passed to your  text area ...
                $(".cloudmed_editor").text(ed.getContent());
            });
        }
    };

    if (KTThemeMode.getMode() === "dark") {
        options["skin"] = "oxide-dark";
        options["content_css"] = "dark";
    }

    tinymce.init(options);
</script>
