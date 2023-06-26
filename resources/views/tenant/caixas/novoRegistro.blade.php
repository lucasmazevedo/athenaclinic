<div class="modal-header">
    <h5 class="modal-title">Lançar Movimento de Caixa</h5>

    <!--begin::Close-->
    <div class="btn btn-icon btn-sm ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="fas fa-times fs-2x text-white"></i>
    </div>
    <!--end::Close-->
</div>
<div class="modal-body">
    <form method="POST" id="formData">
        @csrf
        <fieldset class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tipo:</label>
                        <select class="form-control form-select" name="tipo">
                            <option value="" disabled selected>Selecione</option>
                            <option value="0">RECEITA</option>
                            <option value="1">DESPESA</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Descrição:</label>
                        <input type="text" class="form-control" name="descricao" placeholder="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Valor:</label>
                        <input type="text" class="form-control money" name="valor" placeholder="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Forma:</label>
                        <select class="form-control form-select" name="formaPag">
                            <option value="" disabled selected>Selecione</option>
                            <option value="0">DINHEIRO</option>
                            <option value="1">PIX</option>
                            <option value="2">CARTÃO DE DÉBITO</option>
                            <option value="3">CARTÃO DE CRÉDITO</option>
                            <option value="4">TRANSFERÊNCIA</option>
                            <option value="5">CHEQUE</option>
                            <option value="6">BOLETO</option>
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>

    </form>
</div>
<div class="modal-footer bg-light">
    <a data-href="{{ route('caixas.processaMovimento', $caixaA->id) }}" id="btnStoreModal"
        class="btn btn-sm btn-success"><i class="ph-bank me-2"></i>SALVAR</a>
</div>
<script>
    $(document).ready(function() {
        Inputmask({
            alias: 'currency',
            prefix: 'R$ ',
            radixPoint: ',',
            groupSeparator: '.',
            numericInput: true,
            autoUnmask: true,
            allowMinus: false
        }).mask('.money');
    });
</script>
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
