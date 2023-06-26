<div class="modal-header">
    <h5 class="modal-title">Cadastrar Paciente</h5>

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
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder=""
                        value="{{ old('nome') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nome_social" class="form-label">Nome Social</label>
                    <input type="text" id="nome_social" name="nome_social" class="form-control" placeholder=""
                        value="{{ old('nome_social') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-control cpf" placeholder=""
                        value="{{ old('cpf') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="dtnascimento" class="form-label">Data de Nascimento</label>
                    <input type="text" id="dtnascimento" name="dtnascimento" class="form-control date" placeholder=""
                        value="{{ old('dtnascimento') }}">

                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" id="sexo" class="form-select form-select-solid">
                        <option value="0">Masculino</option>
                        <option value="1">Feminino</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" id="celular" name="celular" class="form-control cellphone" placeholder=""
                        value="{{ old('celular') }}">

                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" id="cep" name="cep" class="form-control cep"
                        placeholder="Digite o cep" value="{{ old('cep') }}">
                    <div id="validationCEP" class="ms-2 text-danger" style="display: none">
                        CEP não encontrado...
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="end_rua" class="form-label">Rua</label>
                    <input type="text" id="end_rua" name="end_rua" class="form-control" placeholder=""
                        value="{{ old('end_rua') }}">

                </div>
            </div>

            <div class="col-md-2">
                <div class="mb-3">
                    <label for="end_numero" class="form-label">Numero</label>
                    <input type="text" id="end_numero" name="end_numero" class="form-control" placeholder=""
                        value="{{ old('end_numero') }}">

                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="end_bairro" class="form-label">Bairro</label>
                    <input type="text" id="end_bairro" name="end_bairro" class="form-control" placeholder=""
                        value="{{ old('end_bairro') }}">

                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="end_complemento" class="form-label">Complemento</label>
                    <input type="text" id="end_complemento" name="end_complemento" class="form-control"
                        placeholder="" value="{{ old('end_complemento') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="end_cidade" class="form-label">Cidade/UF</label>
                    <input type="text" id="end_cidade" name="end_cidade" class="form-control" placeholder=""
                        value="{{ old('end_cidade') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="nome_mae" class="form-label">Nome da Mãe</label>
                    <input type="text" id="nome_mae" name="nome_mae" class="form-control" placeholder=""
                        value="{{ old('nome_mae') }}">

                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="resp_nome" class="form-label">Nome do Responsável</label>
                    <input type="text" id="resp_nome" name="resp_nome" class="form-control" placeholder=""
                        value="{{ old('resp_nome') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="resp_cpf" class="form-label">CPF do Responsável</label>
                    <input type="text" id="resp_cpf" name="resp_cpf" class="form-control cpf" placeholder=""
                        value="{{ old('resp_cpf') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Email do Paciente</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder=""
                        value="{{ old('email') }}">
                </div>
            </div>

        </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('pacientes.salvar') }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
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
    $(document).ready(function() {
        Inputmask({
            "mask": "99/99/9999"
        }).mask('.date');

        Inputmask({
            "mask": "99999-999",
            "oncomplete": function() {
                $('.cep').attr('disabled', 'disabled');
                var cep = $(this).val();
                $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
                    delete options.headers['X-CSRF-TOKEN'];
                });

                $.ajax({
                    url: "https://viacep.com.br/ws/" + cep + "/json/",
                    method: 'GET',
                    dataType: 'json',
                    success: function(result) {
                        if (result.erro == true) {
                            console.log('cep não encontrado...');
                            $('#validationCEP').show();
                            $('.cep').removeAttr('disabled');
                        } else {
                            $('#validationCEP').hide();
                            $('#end_rua').val(result.logradouro);
                            $('#end_bairro').val(result.bairro);
                            $('#end_complemento').val(result.complemento);
                            $('#end_cidade').val(result.localidade + "/" + result.uf);
                            $("#end_numero").focus();
                            $('.cep').removeAttr('disabled');
                        }
                    },

                });
            }
        }).mask('.cep');

        Inputmask({
            "mask": "(99) 9999-9999"
        }).mask('.phone');

        Inputmask({
            "mask": "(99) 99999-9999"
        }).mask('.cellphone');

        Inputmask({
            "mask": "999.999.999-99"
        }).mask('.cpf');

        //$('.ip_address').mask('999.999.999.999');
        //$('.percent').mask('##9,99%', {
        //    reverse: true
        //});
        //$('.clear-if-not-match').mask("99/99/9999", {
        //    clearIfNotMatch: true
        //});
        //$('.placeholder').mask("99/99/9999", {
        //    placeholder: "__/__/____"
        //});
        //$('.fallback').mask("99r99r9999", {
        //    translation: {
        //        'r': {
        //            pattern: /[\/]/,
        //            fallback: '/'
        //        },
        //        placeholder: "__/__/____"
        //    }
        //});
        //$('.selectonfocus').mask("99/99/9999", {
        //    selectOnFocus: true
        //});
    });
</script>
