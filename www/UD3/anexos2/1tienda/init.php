<?php include_once('vista/head.php'); ?>
<body>

    <?php include_once('vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Menú</h2>
                </div>

                <div class="container justify-content-between">
                    <p> vou completar aquí </p>
                    <?php
                        require_once('database.php');

                        $resultadoCrearBD = creaDB();

                        if ($resultadoCrearBD[0]){
                            echo '<div class="alert alert-success" role="alert">';
                        }else{
                            echo '<div class="alert alert-warning" role="alert">';
                        }
                        echo $resultadoCrearBD[1];
                        echo '</div>';

                        $resultadoCrearTabla = creaTabla();
                        if ($resultadoCrearTabla[0]){
                            echo '<div class="alert alert-success" role="alert">';
                        }else{
                            echo '<div class="alert alert-warning" role="alert">';
                        }
                        echo $resultadoCrearTabla[1];
                        echo '</div>';

                    ?>
                </div>
                <?php include_once('vista/back.php'); ?>
            </main>
        </div>
    </div>

    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>