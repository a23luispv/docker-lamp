<?php include_once('vista/head.php'); ?>
<body>

    <?php include_once('vista/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Registrar donación</h2>
                </div>

                <div class="container justify-content-between">
                    

                <?php
                                    require_once('database.php');
                                    
                                    $grupo=null;
                                    $cPostal=null;
                                    $donantesBD=listaDonantes($cPostal,$grupo);
                ?>
                <?php
                            print_r($donantesBD);
                ?>


                    

                    <form action="donacionNueva.php" method="POST" class="needs-validation mb-4">
                        <div class="mb-3">
                                <label for="idDonante" class="form-label">Donante</label>
                                <select class="form-select" id="idDonante" name="idDonante" required>
                                <option selected disabled value="">Selecciona un donante</option>
                                <?php
                                    
                                    foreach ($donantesBD as $donante){
                                        echo '<option value="'.$donante['id'].'">'.$donante['nombre'].'</option>';
                                    }
                                ?>
                                </select>
                            </div>

                            

                        <div class="mb-3">
                            <label for="fechaDonacion" class="form-label">Fecha donación</label>
                            <input type="date" class="form-control" id="fechaDonacion" name="fechaDonacion" required>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-success">Registrar Donante</button>
                    </form>



                </div>
            </main>
        </div>
    </div>

    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>
