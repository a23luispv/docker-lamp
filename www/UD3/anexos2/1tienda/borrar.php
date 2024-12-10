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
                    <p>voy completar aquí</p>
                    <?php
                        $idUser = $_GET['id'];

                        echo $idUser;

                        include('database.php');

                        $resultado = borrarUser($idUser);

                        if($resultado[0]){
                            echo "[OK]: ".$resultado[1];
                        }else{
                            echo "[KO]: ".$resultado[1];
                        }

                    ?>



                </div>

                <?php include_once('vista/back.php'); ?>

            </main>
        </div>
    </div>
    
    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>
