<div id="kt_app_header" class="app-header">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-5">
            <a href="/">
                <img alt="Logo" src="{{ global_asset('/assets/media/logos/athena_clinic-dark.svg') }}"
                    class="h-50px h-lg-70px app-sidebar-logo-default" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">

                <div class="menu menu-rounded menu-column menu-lg-row my-lg-0 align-items-stretch fw-semibold px-lg-0 my-5 px-2"
                    id="kt_app_header_menu" data-kt-menu="true">

                    <div class="menu-item me-0">
                        <a class="menu-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                            <span class="menu-icon"><i class="bi bi-speedometer2 fs-3"></i></span>
                            <span class="menu-title">Dashboards</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>

                    <div class="menu-item me-0">
                        <a class="menu-link {{ request()->is('agendamentos/espera') ? 'active' : '' }}"
                            href="{{ route('agendamentos.espera') }}">
                            <span class="menu-icon"><i class="bi bi-people-fill fs-3"></i></span>
                            <span class="menu-title">Espera</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>

                    <div class="menu-item me-0">
                        <a class="menu-link {{ request()->is('agendamentos') ? 'active' : '' }}"
                            href="{{ route('agendamentos.index') }}">
                            <span class="menu-icon"><i class="bi bi-calendar3 fs-3"></i></span>
                            <span class="menu-title">Agenda</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="bi bi-prescription2 fs-3"></i></span>
                            <span class="menu-title">Laboratório</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div
                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('laboratorio.coleta') }}">
                                    <span class="menu-icon"><i class="bi bi-sliders2 fs-3"></i></span>
                                    <span class="menu-title">Coleta</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('laboratorio.agenda') }}">
                                    <span class="menu-icon"><i class="bi bi-calendar-event-fill fs-3"></i></span>
                                    <span class="menu-title">Agenda</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('laboratorio.relatorios') }}">
                                    <span class="menu-icon"><i class="bi bi-whatsapp fs-3"></i></span>
                                    <span class="menu-title">Relatório</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="bi bi-cash-coin fs-3"></i></span>
                            <span class="menu-title">Financeiro</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div
                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">

                            <div data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                data-kt-menu-placement="right-start" class="menu-item menu-lg-down-accordion">

                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('financeiro/caixas*') ? 'active' : '' }}"
                                        href="{{ route('caixas.index') }}">
                                        <span class="menu-icon"><i class="bi bi-bank fs-3"></i></span>
                                        <span class="menu-title">Caixas</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a class="menu-link {{ request()->is('relatorios*') ? 'active' : '' }}"
                                        href="{{ route('caixas.index') }}">
                                        <span class="menu-icon"><i class="bi bi-list-task fs-3"></i></span>
                                        <span class="menu-title">Relatórios</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0">
                        <span class="menu-link {{ request()->is('cadastros*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="bi bi-database-fill fs-3"></i></span>
                            {{-- <span class="menu-title">Cadastros</span> --}}
                            <span class="menu-arrow"></span>
                        </span>

                        <div
                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/pacientes*') ? 'active' : '' }}"
                                    href="{{ route('pacientes.index') }}">
                                    <span class="menu-icon"><i class="bi bi-people-fill fs-3"></i></span>
                                    <span class="menu-title">Pacientes</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/convenios*') ? 'active' : '' }}"
                                    href="{{ route('convenios.index') }}">
                                    <span class="menu-icon"><i class="bi bi-journal-medical fs-3"></i></span>
                                    <span class="menu-title">Convênios</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/procedimentos*') ? 'active' : '' }}"
                                    href="{{ route('procedimentos.index') }}">
                                    <span class="menu-icon"><i class="bi bi-heart-pulse-fill fs-3"></i></span>
                                    <span class="menu-title">Procedimentos</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/especialidades*') ? 'active' : '' }}"
                                    href="{{ route('especialidades.index') }}">
                                    <span class="menu-icon"><i class="bi bi-card-list fs-3"></i></span>
                                    <span class="menu-title">Especialidades</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/salas*') ? 'active' : '' }}"
                                    href="{{ route('salas.index') }}">
                                    <span class="menu-icon"><i class="bi bi-house-add-fill fs-3"></i></span>
                                    <span class="menu-title">Salas</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/modalidades*') ? 'active' : '' }}"
                                    href="{{ route('modalidades.index') }}">
                                    <span class="menu-icon"><i class="bi bi-prescription fs-3"></i></span>
                                    <span class="menu-title">Modalidades</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/documentos*') ? 'active' : '' }}"
                                    href="{{ route('documentos.index') }}">
                                    <span class="menu-icon"><i class="bi bi-file-medical-fill fs-3"></i></span>
                                    <span class="menu-title">Documentos</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/cid10*') ? 'active' : '' }}"
                                    href="{{ route('cid10.index') }}">
                                    <span class="menu-icon"><i class="bi bi-bookmark-plus-fill fs-3"></i></span>
                                    <span class="menu-title">CID-10</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/profissionais*') ? 'active' : '' }}"
                                    href="{{ route('profissionais.index') }}">
                                    <span class="menu-icon"><i class="bi bi-person-vcard-fill fs-3"></i></span>
                                    <span class="menu-title">Profissionais</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ request()->is('cadastros/funcionarios*') ? 'active' : '' }}"
                                    href="{{ route('funcionarios.index') }}">
                                    <span class="menu-icon"><i class="bi bi-person-fill-add fs-3"></i></span>
                                    <span class="menu-title">Usuários</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-placement="bottom-start"
                        class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="bi bi-gear-fill fs-3"></i></span>
                            <span class="menu-title"></span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div
                            class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link" href="">
                                    <span class="menu-icon"><i class="bi bi-sliders2 fs-3"></i></span>
                                    <span class="menu-title">Gerais</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="/">
                                    <span class="menu-icon"><i class="bi bi-calendar-event-fill fs-3"></i></span>
                                    <span class="menu-title">Agenda</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="/">
                                    <span class="menu-icon"><i class="bi bi-whatsapp fs-3"></i></span>
                                    <span class="menu-title">Whatsapp</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="/">
                                    <span class="menu-icon"><i class="bi bi-clipboard2-pulse fs-3"></i></span>
                                    <span class="menu-title">Memed</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="/">
                                    <span class="menu-icon"><i class="bi bi-printer-fill fs-3"></i></span>
                                    <span class="menu-title">Impressão</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="/">
                                    <span class="menu-icon"><i class="bi bi-bell-fill fs-3"></i></span>
                                    <span class="menu-title">Notificações</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <button class="btn btn-sm btn-primary" id="chamarPainel">Chamar Painel</button> --}}
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-1 ms-md-3">
                    <a href="#"
                        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
                        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <span class="svg-icon theme-light-show svg-icon-2">
                            <i class="bi bi-brightness-high-fill fs-3"></i>
                        </span>
                        <span class="svg-icon theme-dark-show svg-icon-2">
                            <i class="bi bi-moon-stars-fill fs-3"></i>
                        </span>
                    </a>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold fs-base w-150px py-4"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <div class="menu-item my-0 px-3">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="bi bi-brightness-high-fill fs-3"></i>
                                </span>
                                <span class="menu-title">Claro</span>
                            </a>
                        </div>

                        <div class="menu-item my-0 px-3">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="bi bi-moon-stars-fill fs-3"></i>
                                </span>
                                <span class="menu-title">Escuro</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
                    <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 px-md-3 py-2 px-2"
                        data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">

                        <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
                            <span class="fs-7 fw-bold lh-2 text-white">{{ Auth::user()->profile->nome }}</span>
                            <span
                                class="fs-8 fw-semibold lh-1 mb-1 text-white opacity-75">{{ '@' . Auth::user()->username }}</span>
                        </div>
                        <div class="symbol symbol-30px symbol-md-40px">
                            <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                                {{ mb_substr(Auth::user()->profile->nome, 0, 1, 'utf-8') }}</div>
                        </div>
                    </div>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px py-4"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                                        {{ mb_substr(Auth::user()->profile->nome, 0, 1, 'utf-8') }}</div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ Auth::user()->profile->nome }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="/" class="menu-link px-5">Meus Dados</a>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a class="menu-link px-5" href="{{ route('tenant.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('tenant.logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
                    <div class="btn btn-icon btn-active-color-primary w-30px h-30px w-md-35px h-md-35px"
                        id="kt_app_header_menu_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                        <span class="svg-icon svg-icon-2 svg-icon-md-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                    fill="currentColor" />
                                <path opacity="0.3"
                                    d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
