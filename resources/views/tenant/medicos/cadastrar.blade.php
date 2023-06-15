<div class="modal-header">
    <h5 class="modal-title">Cadastrar Profissional</h5>

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

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder=""
                        value="{{ old('nome') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" placeholder=""
                        value="{{ old('usuario') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" placeholder=""
                        value="{{ old('senha') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Endereço de email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder=""
                        value="{{ old('email') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder=""
                        value="{{ old('cpf') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="dtnascimento" class="form-label">Data de Nascimento</label>
                    <input type="text" id="dtnascimento" name="dtnascimento" class="form-control" placeholder=""
                        value="{{ old('dtnascimento') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" class="form-select">
                        <option value="1">Masculino</option>
                        <option value="0">Feminino</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="form-control" placeholder=""
                        value="{{ old('telefone') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="administrador" class="form-label">Administrador?</label>
                    <select name="administrador" class="form-select">
                        @foreach (\App\Models\Tenant\Funcionario::listAdminStatus() as $ladmin)
                            <option value="{{ $ladmin['id'] }}">{{ $ladmin['text'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>
        Cancelar</button>
    <a data-href="{{ route('profissionais.salvar') }}" id="btnStoreModal" class="btn btn-sm btn-dark"><i
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
    var inputCPF = document.getElementById("cpf");
    var inputTelefone = document.getElementById("telefone");
    var inputDtNascimento = document.getElementById("dtnascimento");
    Inputmask({
        "mask": "999.999.999-99"
    }).mask(inputCPF);

    Inputmask({
        "mask": "99/99/9999"
    }).mask(inputDtNascimento);

    $(document).on('keydown', '#telefone', function(e) {
        var digit = e.key.replace(/\D/g, '');
        var value = $(this).val().replace(/\D/g, '');
        var size = value.concat(digit).length;
        Inputmask({
            "mask": (size <= 10) ? '(99) 9999-9999' : '(99) 99999-9999'
        }).mask(inputTelefone);
    });

    $(document).on('keydown', '#usuario', function(e) {
        if (e.which === 32) {
            return false;
        } else {
            let val = $(this).val().toLowerCase()
            $(this).val(val)
        }
    });
</script>
