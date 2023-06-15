<div id="kt_app_toolbar" class="app-toolbar py-lg-6 py-3">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-md-nowrap flex-wrap">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center me-3 mb-lg-0 mb-5 flex-wrap">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                @yield('title_head')
            </h1>
        </div>
        <div class="d-flex align-items-center overflow-auto">
            <a data-href="" id="btnModal" class="btn btn-sm btn-danger rounded-pill">
                <span class="btn-labeled-icon rounded-pill bg-black bg-opacity-20">
                    <i class="fas fa-building-columns"></i>
                </span>
                Fechado
            </a>
            <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <a id="btnActionFila" data-href="{{ route('senhas.fila.index') }}" class="btn btn-sm btn-dark me-3">
                        <i class="fas fa-people-arrows"></i>
                        Fila de Atendimento <span class="badge badge-circle badge-primary ms-2">5</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
