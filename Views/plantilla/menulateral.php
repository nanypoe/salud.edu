<body class="navbar-fixed sidebar-fixed" id="body">
  <div id="toaster"></div>
  <!-- ====================================
    ——— WRAPPER
    ===================================== -->
  < class="wrapper">
    <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
    <aside class="left-sidebar sidebar-dark" id="left-sidebar">
      <div id="sidebar" class="sidebar">
        <!-- Aplication Brand -->
        <div class="app-brand">
          <a href="<?= BASE_URL ?>index">
            <img src="<?= PLANTILLA ?>images/logo/hNegativo.png" class="brand-image">
          </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
          <!-- sidebar menu -->
          <ul class="nav sidebar-inner" id="sidebar-menu">

            <li class="">
              <a class="sidenav-item-link" href="<?= BASE_URL ?>index">
                <i class="fa-solid  fa-house"></i>
                <span class="nav-text">Inicio</span>
              </a>
            </li>

            <?php
            if (Sessiones::accesoVista('estudiante')) {
              ?>
              <li class="section-title">
                Protagonistas
              </li>

              <li>
                <a class="sidenav-item-link" href="<?= BASE_URL ?>personal">
                  <i class="fa-regular fa-user"></i>
                  <span class="nav-text">Datos Personales</span>
                </a>
              </li>

              <li>
                <a class="sidenav-item-link" href="<?= BASE_URL ?>metrica">
                  <i class="fa-solid fa-chart-line"></i>
                  <span class="nav-text">Metrica Personales</span>
                </a>
              </li>


            <?php } ?>

            <?php
            if (Sessiones::accesoVista('docente')) {
              ?>
              <li class="section-title">
                Salud Estudiantil
              </li>

              <li>
                <a class="sidenav-item-link" href="<?= BASE_URL ?>perfil">
                  <i class="fa-solid fa-notes-medical"></i>
                  <span class="nav-text">Historial Estudiante</span>
                </a>
              </li>

              <li>
                <a class="sidenav-item-link" href="<?= BASE_URL ?>prueba">
                  <i class="fa-solid fa-person-running"></i>
                  <span class="nav-text">Pruebas Físicas</span>
                </a>
              </li>

            <?php } ?>

            <?php
            if (Sessiones::getVista('admin')) {
              ?>
              <li class="section-title">
                Registro de Datos y Tablas
              </li>

              <!-- CRUD: Usuarios -->
              <li class="crudUsuarios">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>usuario">
                  <i class="fa-regular fa-user"></i>
                  <span class="nav-text">Usuarios</span>
                </a>
              </li>

              <!-- CRUD: Año Lectivo -->
              <li class="crudLectivo">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>lectivo">
                  <i class="fa-regular fa-calendar"></i>
                  <span class="nav-text">Años Lectivos</span>
                </a>
              </li>

              <!-- CRUD: Departamentos -->
              <li class="crudDepartamentos">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>departamento">
                  <i class="fa-solid fa-earth-americas"></i>
                  <span class="nav-text">Departamentos</span>
                </a>
              </li>

              <!-- CRUD: Municipios -->
              <li class="crudMunicipios">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>municipio">
                  <i class="fa-solid fa-map-location-dot"></i>
                  <span class="nav-text">Municipios</span>
                </a>
              </li>

              <!-- CRUD: Escuelas -->
              <li class="crudEscuelas">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>escuela">
                  <i class="fa-solid  fa-school"></i>
                  <span class="nav-text">Escuelas</span>
                </a>
              </li>

              <!-- CRUD: Docentes -->
              <li class="crudDocentes">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>docente">
                  <i class="fa-solid fa-chalkboard-user"></i>
                  <span class="nav-text">Docentes</span>
                </a>
              </li>

              <!-- CRUD: Grupos -->
              <li class="crudGrupos">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>grupo">
                  <i class="fa-solid fa-people-group"></i>
                  <span class="nav-text">Grupos/Secciones</span>
                </a>
              </li>

              <!-- CRUD: Estudiantes -->
              <li class="crudEstudiantes">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>estudiante">
                  <i class="fa-solid fa-graduation-cap"></i>
                  <span class="nav-text">Estudiantes</span>
                </a>
              </li>

              <!-- CRUD: Matricula -->
              <li class="nav-item">
                <a class="sidenav-item-link" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                  <i class="fa-solid fa-person-circle-plus"></i><span>Matricula</span><i
                    class="fa-solid fa-caret-down ms-auto"></i>
                </a>

                <ul id="forms-nav" class="collapse" data-bs-parent="#sidebar-nav">

                  <div class="sub-menu">
                    <li>
                      <a href="<?= BASE_URL ?>matricula" class="sidenav-item-link">
                        <i class="fa-solid fa-minus mr-3"></i><span>Sin Matrícula</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= BASE_URL ?>matriculado">
                        <i class="fa-solid fa-minus mr-3"></i><span>Matrículados</span>
                      </a>
                    </li>
                  </div>

                </ul>
              </li>

              <!-- CRUD: Eventos -->
              <li class="crudEstudiantes">
                <a class="sidenav-item-link" href="<?= BASE_URL ?>eventos">
                  <i class="fa-regular fa-calendar-minus"></i>
                  <span class="nav-text">Eventos</span>
                </a>
              </li>



            </ul>
          </div>

        <?php } ?>

      </div>

    </aside>