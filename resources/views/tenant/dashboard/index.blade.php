@extends('tenant.layouts.app')

@section('title_head')
    Painel de Estatísticas
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-10">
                <div class="card-body d-flex align-items-center p-lg-8 p-5">
                    <!--begin::Icon-->
                    <div
                        class="d-flex h-50px w-50px h-lg-80px w-lg-80px flex-center position-relative align-self-start align-self-lg-center mt-lg-0 mt-3 flex-shrink-0">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs051.svg-->
                        <span class="svg-icon svg-icon-primary position-absolute opacity-15"><svg
                                class=". h-50px w-50px h-lg-80px w-lg-80px ."xmlns="http://www.w3.org/2000/svg" width="70px"
                                height="70px" viewBox="0 0 70 70" fill="none">
                                <path
                                    d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911  49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                    fill="currentColor" />
                            </svg></span>
                        <!--end::Svg Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/coding/cod009.svg-->
                        <span class="svg-icon svg-icon-2x svg-icon-lg-3x svg-icon-primary position-absolute"><svg
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M22.0318 8.59998C22.0318 10.4 21.4318 12.2 20.0318 13.5C18.4318 15.1 16.3318 15.7 14.2318 15.4C13.3318 15.3 12.3318 15.6 11.7318 16.3L6.93177 21.1C5.73177 22.3 3.83179 22.2 2.73179 21C1.63179 19.8 1.83177 18 2.93177 16.9L7.53178 12.3C8.23178 11.6 8.53177 10.7 8.43177 9.80005C8.13177 7.80005 8.73176 5.6 10.3318 4C11.7318 2.6 13.5318 2 15.2318 2C16.1318 2 16.6318 3.20005 15.9318 3.80005L13.0318 6.70007C12.5318 7.20007 12.4318 7.9 12.7318 8.5C13.3318 9.7 14.2318 10.6001 15.4318 11.2001C16.0318 11.5001 16.7318 11.3 17.2318 10.9L20.1318 8C20.8318 7.2 22.0318 7.59998 22.0318 8.59998Z"
                                    fill="currentColor" />
                                <path
                                    d="M4.23179 19.7C3.83179 19.3 3.83179 18.7 4.23179 18.3L9.73179 12.8C10.1318 12.4 10.7318 12.4 11.1318 12.8C11.5318 13.2 11.5318 13.8 11.1318 14.2L5.63179 19.7C5.23179 20.1 4.53179 20.1 4.23179 19.7Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </div>

                    <div class="ms-6">
                        <p class="list-unstyled fw-semibold fs-6 m-0 p-0 text-gray-600">
                            Sem dados disponíveis para gerar relatório.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
