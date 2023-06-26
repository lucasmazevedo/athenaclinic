<div class="modal-header">
    <h5 class="modal-title"><i class="ph-user-plus me-2"></i>Agendamento ({{ $agendamento->id }})</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form method="POST" enctype="multipart/form-data" id="formData">
        @csrf
        <input type="hidden" name="total" id="total" value="">
        <table class="text-nowrap text-md-nowrap table-hover mb-0 table border">
            <thead>
                <tr>
                    <th width="60%">TIPO</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Desconto</td>
                    <td><input id="desconto" name="desconto" class="form-control money" value="R$ 0,00"></td>
                </tr>
                <tr>
                    <td>Dinheiro</td>
                    <td><input id="din" name="din" class="form-control money" value="R$ 0,00"></td>
                </tr>
                <tr>
                    <td>Pix</td>
                    <td><input id="pix" name="pix" class="form-control money" value="R$ 0,00"></td>
                </tr>
                <tr>
                    <td>Transfência Bancária</td>
                    <td><input id="transf" name="transf" class="form-control money" value="R$ 0,00"></td>
                </tr>
                <tr>
                    <td>Cartão Débito</td>
                    <td><input id="deb" name="deb" class="form-control money" value="R$ 0,00"></td>
                </tr>
                <tr>
                    <td>Cartão Crédito</td>
                    <td><input id="cred" name="cred" class="form-control money" value="R$ 0,00"></td>
                </tr>
            </tbody>
        </table>
        <div class="col-sm-12 col-md-12 mt-2">
            <div style="float: right">
                <p class="text-danger">Total a Pagar</p>
                <h4><label id="total_a_pagar" class="ui-outputlabel ui-widget" style="float: right" data-price="">R$
                        {{ $total }}</label>
                </h4>
            </div>

            <div style="float: right" class="me-5">
                <p style="color: #009881;">Total Pago</p>
                <h4><label id="total_pago" class="ui-outputlabel ui-widget" style="float: right" data-price="">R$
                        0,00</label>
                </h4>
            </div>


            <div style="float: right" class="me-5">
                <p>Desconto</p>
                <h4><label id="total_desconto" class="ui-outputlabel ui-widget" style="float: right" data-price="">R$
                        0,00</label>
                </h4>
            </div>

            <div style="float: right" class="me-5">
                <p class="text-indigo">Total</p>
                <h4><label id="total_pago" class="ui-outputlabel ui-widget" style="float: right" data-price="">R$
                        {{ $total }},00</label>
                </h4>
            </div>
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="button" id="btnStoreModal"
        data-href="{{ route('agendamentos.registraPagamento', $agendamento->id) }}" class="btn btn-secondary"><i
            class="ph-money me-2"></i>Registrar Pagamento</button>

    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><i class="ph-x me-2"></i>Cancelar</button>
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

        //$(".").maskMoney({
        //});

        var precoProc = parseFloat({{ $total }});
        $('#total_a_pagar').html(precoProc
            .toLocaleString('pt-br', {
                style: 'currency',
                currency: 'BRL'
            }));

        $(document).on('keyup', '.money', function(e) {
            //console.log($('#din').val());
            var desconto = $('#desconto').val().replace(/,/g, '.');
            var din = $('#din').val().replace(/,/g, '.');
            var pix = $('#pix').val().replace(/,/g, '.');
            var transf = $('#transf').val().replace(/,/g, '.');
            var deb = $('#deb').val().replace(/,/g, '.');
            var cred = $('#cred').val().replace(/,/g, '.');

            var total = parseFloat(din) + parseFloat(pix) + parseFloat(transf) + parseFloat(deb) +
                parseFloat(cred);

            if (total >= (precoProc - desconto)) {
                if (din == 0) {
                    $('#din').prop("disabled", true);
                }

                if (pix == 0) {
                    $('#pix').prop("disabled", true);
                }
                if (deb == 0) {
                    $('#deb').prop("disabled", true);
                }
                if (transf == 0) {
                    $('#transf').prop("disabled", true);
                }
                if (cred == 0) {
                    $('#cred').prop("disabled", true);
                }

            } else {
                $('#din').prop("disabled", false);
                $('#pix').prop("disabled", false);
                $('#deb').prop("disabled", false);
                $('#transf').prop("disabled", false);
                $('#cred').prop("disabled", false);
            }

            $('#total_pago').html(total
                .toLocaleString('pt-br', {
                    style: 'currency',
                    currency: 'BRL'
                }));

            $('#total_desconto').html(parseFloat(desconto)
                .toLocaleString('pt-br', {
                    style: 'currency',
                    currency: 'BRL'
                }));

            var total_a_pagar = (precoProc - desconto) - total;

            $('#total').val(total);
            if (total_a_pagar < 0) {
                $('#total_a_pagar').html("------"
                    .toLocaleString('pt-br', {
                        style: 'currency',
                        currency: 'BRL'
                    }));
            } else {
                $('#total_a_pagar').html(total_a_pagar
                    .toLocaleString('pt-br', {
                        style: 'currency',
                        currency: 'BRL'
                    }));
            }
        });
    });
</script>
