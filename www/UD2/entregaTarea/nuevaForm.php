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
                    <p>nueva tarea </p>
                    <form method="POST" action="nueva.php">
                    <div class="mb-3">
                            <label class="form-label" for="id">Descripcion Tarea:</label>
                            <input class="form-control" type="text" id="id" name="id"><br><br>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="descripcion">Descripcion Tarea:</label>
                            <input class="form-control" type="text" id="descripcion" name="descripcion" required><br><br>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="estado">Estado:</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="progreso"> In progreso </option>
                                <option value="competado"> Completado </option>
                                <option value="pendiente"> Pendiente </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <!--<input type="submit" class="btn btn-primary" value=Guardar">-->
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
