<div class="modal-header">
    <h5 class="modal-title">Cadastrar Procedimento</h5>

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
                    <label for="registro_ans" class="form-label">Registro ANS</label>
                    <input type="text" id="registro_ans" name="registro_ans" class="form-control" placeholder=""
                        value="{{ old('registro_ans') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="dias_retorno" class="form-label">Dias Retorno</label>
                    <input type="text" id="dias_retorno" name="dias_retorno" class="form-control" placeholder=""
                        value="{{ old('dias_retorno') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="limite_diario" class="form-label">Limite Diário</label>
                    <input type="text" id="limite_diario" name="limite_diario" class="form-control" placeholder=""
                        value="{{ old('limite_diario') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="tipo_valores" class="form-label">Forma de Precificação</label>
                    <select name="tipo_valores" id="tipo_valores" class="form-select">
                        <option selected disabled>Selecionar</option>
                        <option value="0">Valor Fixo</option>
                        <option value="1">Porcentagem</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3" id="porcentageField" style="display:none;">
                <div class="mb-3">
                    <label for="porcentagem" class="form-label">Porcentagem</label>
                    <input type="text" id="porcentagem" name="porcentagem" class="form-control" placeholder=""
                        value="{{ old('porcentagem') }}">
                </div>
            </div>
        </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('convenios.salvar') }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
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
    $(document).on('change', '#tipo_valores', function(e) {
        if (e.currentTarget.value == 1) {
            $('#porcentageField').show();
        } else {
            $('#porcentageField').hide();
        }
    });
    // ACTION MODAL STORE DATA
    /**
    $('body').on('click', '#btnStoreModal', function(e) {
    console.log('clicou..');
    });
         */
</script>
