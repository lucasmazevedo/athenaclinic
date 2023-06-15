<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-md-1 order-2">
            <span class="text-muted fw-semibold me-1">2023&copy;</span>
            <a href="javascript:void(0);" class="text-hover-primary text-gray-800">Athena Clinic -
                Sistema de Gestão de Clínicas | Cloud Medical Tecnologia</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <div class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <span class="fw-semibold me-1">Empresa: <b>{{ tenant('nome_cliente') }} -
                    {{ showDoc(tenant('doc_cliente')) }}</b></span>


        </div>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
