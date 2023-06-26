<div class="modal-header">
    <h5 class="modal-title">Alterar Procedimento ({{ $model->name }})</h5>

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
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder=""
                        value="{{ $model->name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="abbr" class="form-label">Tipo</label>
                    <select id="tipo" name="tipo" class="form-select">
                        <option @if (!$model->tipo) selected @endif disabled>Selecione um tipo
                        </option>
                        <option value="0" @if ($model->tipo == 0) selected @endif>Consulta</option>
                        <option value="1" @if ($model->tipo == 1) selected @endif>Exame de Imagem
                        </option>
                        <option value="2" @if ($model->tipo == 2) selected @endif>Exame de Laboratório
                        </option>
                        <option value="3" @if ($model->tipo == 3) selected @endif>Serviços</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="captura" class="form-label">Habilitar Captura?</label>
                    <select id="captura" name="captura" class="form-select">
                        <option value="0" @if ($model->captura == 0) selected @endif>Não</option>
                        <option value="1" @if ($model->captura == 1) selected @endif>Sim</option>
                    </select>
                </div>
            </div>
        </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('procedimentos.alterar', $model->id) }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
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
    // ACTION MODAL STORE DATA
    /**
    $('body').on('click', '#btnStoreModal', function(e) {
    console.log('clicou..');
    });
         */
</script>
