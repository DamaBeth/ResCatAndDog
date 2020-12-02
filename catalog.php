<?php

require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);

include("header.php");
?>
<!DOCTYPE html>
            <html>
                <head>
                    <title>Catálogo</title>
                    <meta charset="utf-8"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?v=<?php echo(rand()); ?>"></script>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js?v=<?php echo(rand()); ?>"></script>
                    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
                    <link rel="stylesheet" href="css/styles.css?v=<?php echo(rand()); ?>">
                </head>
                
                
                <body class="cuerpo">
                    <div class="container site">
                        <h1 class="text-logo"> ¡Adopta una huellita! </h1>
                        <?php
                            echo '<nav>
                                    <ul class="nav nav-pills">';

                            $statement = $DB->query('SELECT * FROM categorias');
                            $categorias = $statement->fetchAll();
                            foreach ($categorias as $categoria) 
                            {
                                if($categoria['id'] == '1')
                                    echo '<li role="presentation" class="active"><a href="#'. $categoria['id'] . '" data-toggle="tab">' . $categoria['name'] . '</a></li>';
                                else
                                    echo '<li role="presentation"><a href="#'. $categoria['id'] . '" data-toggle="tab">' . $categoria['name'] . '</a></li>';
                            }

                            echo    '</ul>
                                </nav>';

                            echo '<div class="tab-content">';

                            foreach ($categorias as $categoria) 
                            {
                                if($categoria['id'] == '1'){
                                    echo '<div class="tab-pane active" id="' . $categoria['id'] .'">';   
                                }
                                else
                                    echo '<div class="tab-pane" id="' . $categoria['id'] .'">';
                                echo '<div class="row">';

                                if($categoria['id'] == '1'){
                                    $statement = $DB->prepare('SELECT * FROM mascota');
                                    $statement->execute(array($categoria['id']));
                                    while ($mascota = $statement->fetch()) 
                                    {
                                        echo '<div class="col-sm-6 col-md-4">
                                                <div class="thumbnail">
                                                    <img src="ImagenesMascotas/' . $mascota['foto'] . '" alt="...">
                                                    <div class="price">' . $mascota['nombre']. ' </div>
                                                    <div class="caption">
                                                        <h4>' . $mascota['tipo'] . '</h4>
                                                        <p>' . $mascota['comentarios'] . '</p>
                                                        <div class="left-contentCatag">
                                                            <a href="#" class="btn btn-adoptar" role="button"> Adoptar</a>
                                                        </div>
                                                        <div class="left-contentCatag">
                                                            <a href="ver-mascota.php?id='.$mascota['idMascota'].'" class="btn btn-info" role="button"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                
                                $statement = $DB->prepare('SELECT * FROM mascota WHERE mascota.categoria = ?');
                                $statement->execute(array($categoria['id']));
                                while ($mascota = $statement->fetch()) 
                                {
                                    echo '<div class="col-sm-6 col-md-4">
                                            <div class="thumbnail">
                                                <img src="ImagenesMascotas/' . $mascota['foto'] . '" alt="...">
                                                <div class="price">' . $mascota['nombre']. ' </div>
                                                <div class="caption">
                                                    <h4>' . $mascota['tipo'] . '</h4>
                                                    <p>' . $mascota['comentarios'] . '</p>
                                                    <div class="left-contentCatag">
                                                            <a href="#" class="btn btn-adoptar" role="button"> Adoptar</a>
                                                        </div>
                                                        <div class="left-contentCatag">
                                                            <a href="#" class="btn btn-info" role="button"> Ver</a>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
                                }
                            
                            echo    '</div>
                                    </div>';
                            }
                            echo  '</div>';
                        ?>
                    </div>
                </body>
            </html> 
<?php
include("footer.php");
?>