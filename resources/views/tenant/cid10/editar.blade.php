<div class="modal-header">
    <h5 class="modal-title">Alterar CID10 ({{ $model->cod }})</h5>

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
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="cod" class="form-label">Cod.: CID</label>
                    <input type="text" id="cod" name="cod" class="form-control" placeholder=""
                        value="{{ $model->cod }}">
                </div>
            </div>

            <div class="col-md-9">
                <div class="mb-3">
                    <label for="name" class="form-label">Descrição</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder=""
                        value="{{ $model->name }}">
                </div>
            </div>
        </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('cid10.alterar', $model->id) }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
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
