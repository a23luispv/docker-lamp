<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Usuarios</h2>
                </div>

                <div class="container justify-content-between">
                <?php
                    /* TODO */
                ?>
                    <div class="table">
                        <table class="table table-sm table-striped table-hover">
                            <thead class="thead">
                                <tr>                            
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Usuario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    require('../modelo/pdo.php');

                                    foreach(listaUsuarios()[1] as $usuario){
                                        echo '<tr>';
                                        echo '<th>'.$usuario['id'].'</th>';
                                        echo '<th>'.$usuario['nombre'].'</th>';
                                        echo '<th>'.$usuario['apellidos'].'</th>';
                                        echo '<th>'.$usuario['username'].'</th>';
                                        echo '<th>'.$usuario['contrasena'].'</th>';
                                        echo '</tr>';
                                    }

                                ?>

                            </tbody>
                        </table>
                    </div>
                <!--TODO: amostrar error-->    
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>
