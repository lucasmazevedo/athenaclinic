<div class="modal-header">
    <h5 class="modal-title">Fechamento de Caixa</h5>

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
                    {{ $caixaA->user->profile->nome }}
                </strong>
            </div>
            <div class="col-md-6">Data de Abertura: <br>
                <strong
                    class="text-uppercase">{{ \Carbon\Carbon::parse($caixaA->dtabertura)->translatedFormat('l, d \d\e\ F \d\e\ Y ') }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <label for="SaldoInicial">Saldo Inicial</label>
                <input type="text" name="saldoInicial" class="form-control money" placeholder="R$ 0,00"
                    value="R$ {{ str_replace('.', ',', $caixaA->saldo_inicial) }}" disabled>
            </div>
        </div>
        <hr>
        <div class="row">
            <table class="table-striped table-condensed table-hover table-rounded gy-2 gs-7 mt-2 table border">
                <thead class="bg-dark bg-opacity-25">
                    <tr class="success">
                        <th>Tipo</th>
                        <th>Entradas</th>
                        <th>Saídas</th>
                        <th>Saldo Final</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dinR - $dinD <=> 0)
                        <tr>
                            <td>Dinheiro</td>
                            <td class="text-right">{{ "R$ " . number_format($dinR, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($dinD, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($dinR - $dinD, 2, ',', '.') }}</td>
                        </tr>
                    @endif
                    @if ($pixR - $pixD <=> 0)
                        <tr>
                            <td>Pix</td>
                            <td class="text-right">{{ "R$ " . number_format($pixR, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($pixD, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($pixR - $pixD, 2, ',', '.') }}</td>
                        </tr>
                    @endif
                    @if ($debR - $debD <=> 0)
                        <tr>
                            <td>Cartão de Débito</td>
                            <td class="text-right">{{ "R$ " . number_format($debR, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($debD, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($debR - $debD, 2, ',', '.') }}</td>
                        </tr>
                    @endif

                    @if ($credR - $credD <=> 0)
                        <tr>
                            <td>Cartão de Crédito</td>
                            <td class="text-right">{{ "R$ " . number_format($credR, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($credD, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($credR - $credD, 2, ',', '.') }}</td>
                        </tr>
                    @endif

                    @if ($transfR - $transfD <=> 0)
                        <tr>
                            <td>Transferência</td>
                            <td class="text-right">{{ "R$ " . number_format($transfR, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($transfD, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($transfR - $transfD, 2, ',', '.') }}</td>
                        </tr>
                    @endif

                    @if ($cheqR - $cheqD <=> 0)
                        <tr>
                            <td>Boleto</td>
                            <td class="text-right">{{ "R$ " . number_format($cheqR, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($cheqD, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($cheqR - $cheqD, 2, ',', '.') }}</td>
                        </tr>
                    @endif

                    @if ($bolR - $bolD <=> 0)
                        <tr>
                            <td>Cheque</td>
                            <td class="text-right">{{ "R$ " . number_format($bolR, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($bolD, 2, ',', '.') }}</td>
                            <td class="text-right">{{ "R$ " . number_format($bolR - $bolD, 2, ',', '.') }}</td>
                        </tr>
                    @endif

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total geral</th>
                        <th class="text-right">{{ $totalGeral }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</div>
<div class="modal-footer bg-light">
    <a href="{{ route('caixas.movimento', $caixaA->id) }}" id="" class="btn btn-sm btn-secondary"><i
            class="fas fa-dollar-sign me-1"></i>MOVIMENTO DE CAIXA</a>

    <a data-href="{{ route('caixas.processafechar') }}" id="btnStoreModal" class="btn btn-sm btn-success"><i
            class="fas fa-building-columns me-1"></i>FECHAR CAIXA</a>
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
