<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva tarea</h2>
                </div>

                <div class="container">
                    <?php
                        include('utils.php');
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $id = $_POST["id"];
                            $desc = $_POST["descripcion"];
                            $esta = $_POST["estado"];
                          }

                        if(esValidoDato($id) && esValidoDato($desc) && esValidoDato($esta)){
                            if(guardaDatos($id,$desc,$esta)){
                            echo "<p>Guardado OK</p><br/>";
                            }else{
                                echo "<p>Guardado KO</p>";
                            }
                            print_r($tareas);
                        }else {
                            echo "<p>Validación KO</p>";
                        }


                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
