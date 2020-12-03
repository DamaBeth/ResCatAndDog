<?php

require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);
if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }
    if(!empty($_GET['idTipoUser'])) 
    {
        $idTipoUser = checkInput($_GET['idTipoUser']);
    }
    $statement = $DB->prepare("SELECT mascota.idMascota, mascota.nombre, mascota.comentarios, mascota.edad, mascota.foto, mascota.tipo, mascota.sexo, categorias.name AS categoria, usuario.nombre AS nameUser, usuario.telefono AS telUser, usuario.correo AS emailUser FROM mascota LEFT JOIN categorias ON mascota.categoria = categorias.id JOIN cuidador ON mascota.cuidador = cuidador.idCuidador JOIN usuario ON cuidador.idUsuario = usuario.idUsuario WHERE mascota.idMascota = ?");
    $statement->execute(array($id));
    $mascota = $statement->fetch();

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
include("header.php");
?>
<!DOCTYPE html>
<html>
    <head>
                    <title>Ver mascota</title>
                    <meta charset="utf-8"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?v=<?php echo(rand()); ?>"></script>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js?v=<?php echo(rand()); ?>"></script>
                    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
                    <link rel="stylesheet" href="css/styles.css?v=<?php echo(rand()); ?>">
    </head>
    
    <body class="cuerpo">
        <h1 class="text-logo"> Ver mascota </h1>
         <div class="container admin">
            <div class="row">
               <div class="col-sm-6">
                    <div class="detalles">
                         <label> Detalles: </label>
                    </div>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nombre:</label><?php echo '  '.$mascota['nombre'];?>
                      </div>
                      <div class="form-group">
                        <label>Descripción:</label><?php echo '  '.$mascota['comentarios'];?>
                      </div>
                      <div class="form-group">
                        <label>Edad:</label><?php echo '  '.$mascota['edad'].' meses';?>
                      </div>
                      <div class="form-group">
                        <label>Tipo:</label><?php echo '  '.$mascota['categoria'];?>
                      </div>
                      <div class="form-group">
                        <label>Raza:</label><?php echo '  '.$mascota['tipo'];?>
                      </div>
                      <div class="form-group">
                        <label>Sexo:</label><?php echo '  '.$mascota['sexo'];?>
                      </div>
                      <div class="form-group">
                        <label>Nombre del cuidador:</label><?php echo '  '.$mascota['nameUser'];?>
                      </div>
                      <div class="form-group">
                        <label>Teléfono del cuidador:</label><?php echo '  '.$mascota['telUser'];?>
                      </div>
                      <div class="form-group">
                        <label>Correo eletrónico del cuidador:</label><?php echo '  '.$mascota['emailUser'];?>
                      </div>
                    </form>
                    <br>
                    <?php
                        if($idTipoUser == '1'){
                            echo '<div class="col-sm-6">';
                            echo    '<a class="btn btn-primary" href="admin-catalogo.php"><span class="glyphicon glyphicon-arrow-left"></span> Administar catálogo</a>';
                            echo '</div>';
                            echo '<div class="col-sm-6">';
                            echo    '<a class="btn btn-primary" href="catalog.php"><span class="glyphicon glyphicon-arrow-left"></span> Regresar al catálogo</a>';
                            echo '</div>';
                        }elseif($idTipoUser == '2'){
                            echo '<div class="col-sm-6">';
                            echo    '<a class="btn btn-primary" href="cuidador-catalogo.php"><span class="glyphicon glyphicon-arrow-left"></span> Administrar catálogo</a>';
                            echo '</div>';
                            echo '<div class="col-sm-6">';
                            echo    '<a class="btn btn-primary" href="catalog.php"><span class="glyphicon glyphicon-arrow-left"></span> Regresar al catálogo</a>';
                            echo '</div>';
                        }else{
                            echo '<div class="form-actions">';
                            echo    '<a class="btn btn-primary" href="catalog.php"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>';
                            echo '</div>';
                        }
                    ?>
                </div> 
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo 'ImagenesMascotas/'.$mascota['foto'];?>" alt="...">
                        <div class="price"><?php echo $mascota['nombre'];?></div>
                          <div class="caption">
                            <h4><?php echo $mascota['tipo'];?></h4>
                            <p><?php echo $mascota['comentarios'];?></p>
                            <?php
                                if($idTipoUser == '3'){
                                    echo '<a href="creaSolicitud.php?idM=" class="btn btn-adoptar" role="button"> Adoptar</a>';
                                }elseif($idTipoUser != '1' && $idTipoUser != '2'){
                                    echo '<a href="login.php" class="btn btn-adoptar" role="button"> Adoptar</a>';
                                }
                            ?>
                          </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>


<?php
include("footer.php");
?>