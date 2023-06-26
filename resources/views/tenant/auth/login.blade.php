@extends('tenant.layouts.auth')

@section('content')
    <div class="py-20">
        <form class="form w-100" method="POST" action="{{ route('tenant.login') }}">
            @csrf
            <div class="card-body">
                <div class="mb-10 text-start">
                    <h1 class="text-dark fs-3x mb-3" data-kt-translate="sign-in-title">Acesso ao Sistema</h1>
                    <div class="fw-semibold fs-6 text-gray-400" data-kt-translate="general-desc">{{ env('CLIENT_NAME') }} -
                        {{ env('CLIENT_CNPJ') }}</div>
                </div>
                <div class="fv-row mb-8">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Usuário"
                        autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="fv-row mb-7">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Senha">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="d-flex flex-stack fs-base fw-semibold mb-10 flex-wrap gap-3">
                    <div></div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link-primary">Esqueceu a Senha?</a>
                    @endif
                </div>
                <div class="d-grid gap-2">
                    <button id="btnLogin" class="btn btn-primary me-2 btn-block flex-shrink-0">
                        <span class="indicator-label" data-kt-translate="sign-in-submit">Entrar</span>
                        <span class="indicator-progress">
                            <span data-kt-translate="general-progress">Carregando...</span>
                            <span class="spinner-border spinner-border-sm ms-2 align-middle"></span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="m-0">
        <button class="btn btn-flex btn-secondary rotate">
            <span class="me-2"><span class="fw-semibold me-1">Empresa: <b>{{ tenant('nome_cliente') }} -
                        {{ showDoc(tenant('doc_cliente')) }}</b></span></span>
        </button>
    </div>
@endsection
