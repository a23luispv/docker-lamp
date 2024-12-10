<?php include_once('vista/head.php'); ?>
<body>

    <?php include_once('vista/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva donación</h2>
                </div>

                <div class="container justify-content-between">

                    <?php
                        $idDonante=$_POST['idDonante'];
                        $fechaDonacion=$_POST['fechaDonacion'];

                        echo $idDonante;
                        echo $fechaDonacion;

                        include('database.php');
                        $resultadoo=addDonacion($idDonante,$fechaDonacion);
                        if($resultadoo){
                            echo 'OK'.$resultadoo;
                        }else{
                            echo 'KO'.$resultadoo;
                        }

                    ?>
                    
                </div>
            </main>
        </div>
    </div>

    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>
