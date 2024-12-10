<?php include_once('vista/head.php'); ?>
<body>

    <?php include_once('vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar usuario</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="editar.php" method="POST" class="mb-2 w-50">
                        
                        <p> voy completar aquí</p>

                        <?php
                            include('database.php');
                            $idUser=$_GET['id'];
                            $resultado = buscarUser($idUser);

                            echo $idUser . '<br/>';
                            print_r($resultado[1]);


                            if (!empty($idUser) && $resultado[0]){
                                    $usuario = $resultado[1];
                                    $nombre = $usuario['nombre'];
                                    $apellidos = $usuario['apellidos'];
                                    $edad = $usuario['edad'];
                                    $provincia = $usuario['provincia'];
                        ?>
                                <input type="hidden" name="id" value="<?php echo $idUser ?>">
                                <?php include_once('vista/form.php'); ?>
                                <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        <?php
                            }else{
                                    echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información del usuario.</div>';
                            }





                        ?>
                </form>
                </div>

                <div class="container justify-content-between mb-2">
                    <a class="btn btn-info btn-sm" href="listaUsuarios.php" role="button">Volver</a>
                </div>

            </main>
        </div>
    </div>
    
    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>
