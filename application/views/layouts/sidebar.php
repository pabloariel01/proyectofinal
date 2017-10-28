<div id="wrapper" ng-app="tfa">

    <!-- Navigation -->
    <nav ng-controller="navController" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href>
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href><i class="fa fa-user fa-fw"></i> Perfil de usuario</a>
                    </li>
                    <li><a href><i class="fa fa-gear fa-fw"></i> Configuraciones</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="/prueba/login/logout_user"><i class="fa fa-sign-out fa-fw"></i> cerrar sesion</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


    <div class="row">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!-- <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        <!-- </li> -->
                        <li>
                            <?php if($this->router->class=="vistas"): ?>
                              <a href="#/capturas"><i class="fa fa-table fa-fw"></i> Resumen de Capturas</a>
                            <?php else : ?>
                              <a href="/prueba/vistas#/capturas"><i class="fa fa-table fa-fw"></i> Resumen de Capturas</a>
                            <?php endif; ?>
                        </li>
                        <li>
                          <?php if($this->router->class=="vistas"): ?>
                            <a href="#/totales"><i class="fa fa-table fa-fw"></i> Total y peso por Localidad</a>
                          <?php else : ?>
                            <a href="/prueba/vistas#/totales"><i class="fa fa-table fa-fw"></i> Total y peso por Localidad</a>
                          <?php endif; ?>
                        </li>
                        <!-- <li>
                            <a href ng-click="sumcpueloc()"><i class="fa fa-table fa-fw"></i>Total y peso por Localidad</a>
                        </li> -->
                        <li>
                            <a href ng-click="sumcpueloc()"><i class="fa fa-table fa-fw"></i> suma CPUE por Localidad</a>
                        </li>
                        <li>
                            <a href ng-click="cuboCpueEspecies()"><i class="fa fa-table fa-fw"></i> CPUE por especie y localidad</a>
                            <!-- cuboCpueEspecies -->
                        </li>
                        <li>
                            <a href ng-click="rangocpuelst()"><i class="fa fa-table fa-fw"></i> CPUE por largo y Localidad</a>
                            <!-- rangocpuelst -->
                        </li>
                        <li>
                            <a href ng-click="cuentaSexoEsp()"><i class="fa fa-table fa-fw"></i> Total por sexo</a>
                            <!-- cuentaSexoEsp -->
                        </li>
                        <li>
                            <a href ng-click="cuentaGonada()"><i class="fa fa-table fa-fw"></i> Total por estado de gonada</a>
                            <!-- cuentaGonada -->
                        </li>
                        <li>
                            <a href ng-click="cuentaGonadaSexo()"><i class="fa fa-table fa-fw"></i> Total por estado de gonada  sexo</a>
                            <!-- cuentaGonadaSexo -->
                        </li>
                        <li>
                            <a href ng-click="cuentaEspGonada()"><i class="fa fa-table fa-fw"></i> Total de especies por estado de gonada  sexo</a>
                            <!--cuentaEspGonada  -->
                        </li>
                        <li>
                            <a href ng-click="rgsXCien()"><i class="fa fa-table fa-fw"></i> regresion porcentual</a>
                            <!-- rgx -->
                        </li>



                        <li>
                            <a href ng-click="div_show = !div_show"><i class="fa fa-wrench fa-fw"></i> Administracion<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" ng-show="div_show">
                                <li>
                                    <a href>Recalcular largos promedio</a>
                                    <!-- calcularLargoProm() -->
                                </li>
                                <li>
                                    <a href>Recalcular duracion de pescas</a>
                                    <!-- calcularduracion() sql falta llamar-->
                                    <!-- calcularDuracionPesca(idp int) eso despues del insert de pesca-->
                                </li>
                                <li>
                                    <a href ng-click="div_show1 = !div_show1">ABM <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level" ng-show="div_show1">
                                        <li>
                                            <a href="/prueba/abm/actas">Actas</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/campania">Campaña</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/camploc">Info de Campaña</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/localidad">Localidades</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/red">Redes</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/fondo">Fondos</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/pesca">Pescas</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/especie">Especies</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/pescado">Pescados</a>
                                        </li>
                                        <li>
                                            <a href="/prueba/abm/otolito">Otolitos</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>

                                <?php if($this->session->userdata('rol')=="1"): ?>
                                <li>
                                    <a href ng-click="div_show2 = !div_show2">ABM Administrativo<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level" ng-show="div_show2">
                                        <li>
                                            <a href="/prueba/abmusuario/usuarios" data-asd='abmusuario/usuarios'>Modificar o agregar usuarios</a>
                                        </li>

                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                              <?php endif; ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->


        </nav>

        <div class="col-md-10" id="page-wrapper">
            <div id="content">
                <div class="row-fluid">
                    <!-- block -->
                    <!-- <div ng-view></div> -->
                    <!-- <div ng-include="template.url" class="block"> -->
