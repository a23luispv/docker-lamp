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
                    <h2>Crear tarea</h2>
                </div>
                <div class="container">

                    <form action="nueva.php" method="POST" class="mb-5">
                        <div class="mb-3">
                            <label for="Descripcion" class="form-label">Tarea:</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select id="estado" name="estado" class="form-select" required>
                                <option value="Completada">Completada</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="En progreso">En progreso</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>                
                    </form>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php include 'footer.php'; ?>

</body>
</html>