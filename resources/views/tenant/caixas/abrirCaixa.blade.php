<div class="modal-header">
    <h5 class="modal-title">Abertura de Caixa</h5>

    <!--begin::Close-->
    <div class="btn btn-icon btn-sm ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="fas fa-times fs-2x text-white"></i>
    </div>
    <!--end::Close-->
</div>
<div class="modal-body">
    <form method="POST" id="formData">
        <div class="row">
            <div class="col-md-6">Usuário: <br>
                <strong class="text-uppercase">
                    {{ Auth::user()->profile->nome }}
                </strong>
            </div>
            <div class="col-md-6">Data de Abertura: <br>
                <strong
                    class="text-uppercase">{{ \Carbon\Carbon::now()->translatedFormat('l, d \d\e\ F \d\e\ Y ') }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <label for="SaldoInicial">Saldo Inicial</label>
                <input type="text" name="saldoInicial" class="form-control money" value="R$ 0,00"
                    placeholder="R$ 0,00">
            </div>
        </div>
    </form>
</div>
<div class="modal-footer bg-light">
    <a data-href="{{ route('caixas.abrir') }}" id="btnStoreModal" class="btn btn-sm btn-success"><i
            class="fas fa-building-columns me-2"></i>ABRIR CAIXA</a>
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
