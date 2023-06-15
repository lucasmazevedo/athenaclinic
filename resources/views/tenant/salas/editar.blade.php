<div class="modal-header">
    <h5 class="modal-title">Alterar Sala ({{ $model->name }})</h5>

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
                        value="{{ $model->name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="abbr" class="form-label">Tipo de Sala</label>
                    <select id="tipo" name="tipo" class="form-select">
                        <option @if (!$model->tipo) selected @endif disabled>Selecione um tipo de sala
                        </option>
                        <option value="0" @if ($model->tipo == 0) selected @endif>Guichê</option>
                        <option value="1" @if ($model->tipo == 1) selected @endif>Sala de Exame</option>
                        <option value="2" @if ($model->tipo == 2) selected @endif>Sala de Consulta
                        </option>
                    </select>
                </div>
            </div>
        </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('salas.alterar', $model->id) }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
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
