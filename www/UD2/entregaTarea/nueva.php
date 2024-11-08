<?php
include 'utils.php';

$error = false;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $descripcion = $_POST['descripcion'] ?? '';
    $estado = $_POST['estado'] ?? '';

        if (guardarTarea($descripcion, $estado)) {
            $mensaje = "Tarea guardado correctamente.";
        } else {
            $mensaje = "Problemas al guardar la tarea.";
            $error = true;
        }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--header-->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php include 'menu.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Resultado - creación tarea: </h2>
                </div>
                <div class="container">
            
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-success">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php endif; ?>
                
                    
                    <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>Identificador</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tareas as $tarea){ ?>
                                <tr>
                                    <td><?php echo $tarea['id']; ?></td>
                                    <td><?php echo $tarea['descripcion']; ?></td>
                                    <td><?php echo $tarea['estado']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>


                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php include 'footer.php'; ?>

</body>
</html>