<?php include_once('vista/head.php'); ?>
<body>

    <?php include_once('vista/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo donante</h2>
                </div>

                <div class="container justify-content-between">
                    
                    <?php
                        include('utils.php');

                        $grupos = listaGrupoSanguineo();

                        $nombre = filtraCampo($_POST['nombre']);
                        $apellidos = filtraCampo($_POST['apellidos']);
                        $edad = filtraCampo($_POST['edad']);
                        $codigoPostal = filtraCampo($_POST['codigo_postal']);
                        $telefonoMovil = filtraCampo($_POST['telefono_movil']);
                        $grupoSanguineo = filtraCampo($_POST['grupo_sanguineo']);

                        // Validaciones
                        $error = false;
                        if (!validarCampoTexto($nombre)){
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el nombre.</div>';
                        }
                        if (!validarCampoTexto($apellidos)){
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa los apellidos.</div>';
                        }
                        if (!esNumeroValido($edad) || $edad < 18){
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa la edad.</div>';
                        }
                        if (!esNumeroValido($codigoPostal) || !preg_match('/^[0-9]{5}$/', $codigoPostal)){
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el código postal.</div>';
                        }
                        if (!esNumeroValido($telefonoMovil) || !preg_match('/^[0-9]{9}$/', $telefonoMovil)){
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el teléfono.</div>';
                        }
                        if (!in_array($grupoSanguineo, $grupos)){
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el grupo sanguíneo.</div>';
                        }

                        if(!$error){
                            require('database.php');

                            if (addDonante($nombre, $apellidos, $edad, $grupoSanguineo, $codigoPostal, $telefonoMovil)){
                                echo '<p>OK , donante metido</p>';
                            }else{
                                echo '<p>KO , meter donante</p>';
                            }

                        }else{
                            echo '<p>error que te cagas, revisa datos de form</p>';
                        }
                    ?>
                   
                </div>
            </main>
        </div>
    </div>

    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>
