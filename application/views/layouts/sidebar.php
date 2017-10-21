<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
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
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de usuario</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuraciones</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="login/logout_user"><i class="fa fa-sign-out fa-fw"></i> cerrar sesion</a>
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
                            <a href ng-click="traertablaespecies()"><i class="fa fa-table fa-fw"></i> Resumen de Capturas</a>
                        </li>

                        <li>
                            <a href ng-click="totalypesoporloc()"><i class="fa fa-table fa-fw"></i> Total y peso por Localidad</a>
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i>{{titulo}} Total y peso por Localidad</a>
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> suma CPUE por Localidad</a>
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> CPUE por especie y localidad</a>
                            <!-- cuboCpueEspecies -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> CPUE por largo y Localidad</a>
                            <!-- rangocpuelst -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> Total por sexo</a>
                            <!-- cuentaSexoEsp -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> Total por estado de gonada</a>
                            <!-- cuentaGonada -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> Total por estado de gonada  sexo</a>
                            <!-- cuentaGonadaSexo -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> Total de especies por estado de gonada  sexo</a>
                            <!-- cuentaEspGonada -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-table fa-fw"></i> regresion porcentual</a>
                            <!-- rgx -->
                        </li>



                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Administracion<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Recalcular largos promedio</a>
                                </li>
                                <li>
                                    <a href="#">Recalcular coeficientes</a>
                                </li>
                                <li>
                                    <a href="#">ABM <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Pescas</a>
                                        </li>
                                        <li>
                                            <a href="#">Especies</a>
                                        </li>
                                        <li>
                                            <a href="#">Campaña</a>
                                        </li>
                                        <li>
                                            <a href="#">pescados</a>
                                        </li>
                                        <li>
                                            <a href="#">Otolitos</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">ABM Administrativo<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Modificar o agregar usuarios</a>
                                        </li>

                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
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
                    <div ng-include="template.url" class="block">
