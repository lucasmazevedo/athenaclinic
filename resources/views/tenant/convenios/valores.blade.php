<div class="modal-header">
    <h5 class="modal-title">Valores de Procedimentos ({{ $model->name }})</h5>

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
            <div class="table-responsive">
                <table class="text-nowrap text-md-nowrap table-hover mb-0 table border">
                    <thead>
                        <tr>
                            <th>PROCEDIMENTO</th>
                            <th>CODIGO</th>
                            <th>VALOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($precos as $p)
                            <tr>
                                <td>{{ $p->procedimento->name }}</td>
                                <td>{{ $p->procedimento->cod }}</td>
                                <td><input type="text" name="preco_{{ $p->procedimento->id }}"
                                        class="form-control money" value="R$ {{ str_replace('.', ',', $p->preco) }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('convenios.valoresUpdate', $model->id) }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
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
