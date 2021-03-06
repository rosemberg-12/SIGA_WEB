
<aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Panel usuario -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/user.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php
                                require_once '../bussines/DTO/Usuario.php';
                                require_once '../bussines/DTO/Persona.php';

                           if( $_SESSION['tipo_usuario'] == 1){
                                echo $_SESSION['usuario']->_GET('nick');
                            }
                                else
                            echo $_SESSION['usuario']->_GET('persona')->_GET('nombre')." ".$_SESSION['usuario']->_GET('persona')->_GET('apellido');?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->

                    <ul class="sidebar-menu">

                        <li class="header">MENU PRINCIPAL</li>

                        <?php
                        if( $_SESSION['tipo_usuario']==1 ){
                       echo '<li class="treeview" >
                            <a href="gestion-usuarios.php">
                                <i class="fa fa-users"></i> <span>Gestion de Usuarios</span>
                            </a>                            
                        </li>';
                        }
                        ?>
                        <?php
                       if( $_SESSION['tipo_usuario']==1  ){
                       echo '<li class="treeview" >
                            <a href="gestion-division.php">
                                <i class="fa fa-cubes"></i>
                                <span>Gestion de divisiones (Administrador)</span>
                            </a>                            
                        </li>';}
                        ?>
                        <?php
                        if( $_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 ){
                        echo '<li class="treeview" >
                            <a href="gestionar-division.php">
                                <i class="fa fa-cube"></i>
                                <span>Gestion de división</span>
                            </a>
                        </li>';}
                            ?>
                        <?php
                        if( $_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3){
                            echo '<li class="treeview" >
                            <a href="registrar-ano.php">
                                <i class="fa fa-calendar"></i>
                                <span>Gestion de año actividad</span>
                            </a>
                        </li>';}
                        ?>
                        <?php
                        if( $_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2  || $_SESSION['tipo_usuario']==3){
                            echo '<li class="treeview" >
                            <a href="gestionar-unidad.php">
                                <i class="fa fa-tasks"></i>
                                <span>Gestion de unidad</span>
                            </a>
                        </li>';}?>


                        <?php
                        if( $_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==4){
                            echo '<li class="treeview" >
                             <a href="gestionar-actividad.php">
                                <i class="fa fa-list-alt"></i>
                                <span>Gestion de actividad</span>
                            </a>
                        </li>';}?>

                        <?php
                        if( $_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==4){
                            echo '<li class="treeview" >
                             <a href="gestionar-carrera.php">
                                <i class="fa fa-graduation-cap"></i>
                                <span>Gestion de programa académico</span>
                            </a>
                        </li>';}?>

                        <?php
                        if( $_SESSION['tipo_usuario']==1 ){
                            echo '<li class="treeview" >
                            <a href="reporte-excel.php">
                                <i class="fa fa-file-excel-o"></i> <span>Generar Informe indicadores MEN</span>
                            </a>                            
                        </li>';
                        }
                        ?>

                        <?php
                        if( $_SESSION['tipo_usuario']==1 ){
                            echo '<li class="treeview" >
                            <a href="reportePdf.php">
                                <i class="fa fa-file-pdf-o"></i> <span>Generar Informe PDF</span>
                            </a>
                        </li>';
                        }
                        ?>

                        <li class="treeview">
                            <a href="cerrarS.php">
                                <i class="fa fa-times"></i> <span>Cerrar Sesion</span>
                            </a>                            
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
