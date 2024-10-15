<!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
<div class="page-wrapper">

    <!-- Header -->
    <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <!-- Sidebar toggle button -->
            <button id="sidebar-toggler" class="sidebar-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>

            <span class="page-title">Panel</span>

            <div class="navbar-right ">

                <ul class="nav navbar-nav">
                    <!-- User Account -->
                    <li class="dropdown user-menu ">
                        <button class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <?php if (Sessiones::getVista('estudiante')) { ?>
                                <img src="<?= PLANTILLA ?>images/user.png" class="user-image rounded-circle" />
                            <?php } ?>
                            <span class="d-none d-lg-inline-block">
                                <?php if (Sessiones::getClave('usuario')) {
                                    echo Sessiones::getClave('usuario');
                                } else {
                                    echo "Ingresar";
                                } ?>
                            </span>
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-right">

                            <li class="dropdown">
                                <?php
                                if (Sessiones::getClave('autenticado')) {
                                    echo '
                                        <a class="dropdown-link-item" href="' . BASE_URL . 'login/salir/"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión</a>
                                        ';
                                } else {
                                    echo '
                                        <a class="dropdown-link-item" href="' . BASE_URL . 'login"><i class="fa-solid fa-arrow-right-to-bracket"></i> Iniciar Sesión</a>
                                        ';
                                }
                                ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>