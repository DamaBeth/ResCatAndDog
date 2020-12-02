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
    $statement = $DB->prepare("SELECT idMascota, nombre, comentarios, foto, tipo FROM mascota WHERE mascota.idMascota = ?");
    $statement->execute(array($id));
    $mascota = $statement->fetch();

    /*if($idTipoUser == '1'){*/
        if(!empty($_POST)) 
        {
            $id = checkInput($_POST['id']);
            $statement = $DB->prepare("UPDATE mascota SET estado = 'inactivo' WHERE idMascota = ?");
            $statement->execute(array($id));
            header("Location: catalog.php"); 
        }
    /*}*/
    
    

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("header.php")?>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?v=<?php echo(rand()); ?>"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js?v=<?php echo(rand()); ?>"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/styles.css?v=<?php echo(rand()); ?>">
    </head>
    
    <body>
        <h1 class="text-logo"> Eliminar una mascota </h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <div class="detalles">
                         <label> Confirmar operación: </label>
                    </div>
                    <br>
                    <form class="form" action="eliminar-mascota.php" role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        <p class="caption">¿Estás seguro que deseas eliminar esta mascota del catálogo?</p>
                        <br>
                        <div class="col-sm-6">
                            <a><button type="submit" class="btn btn-warning">Aceptar</button></a>
                        </div> 
                        <div class="col-sm-6">
                            <?php
                                if($idTipoUser == '1'){
                                    echo '<a class="btn btn-default" href="admin-catalogo.php">Cancelar</a>';
                                }elseif($idTipoUser == '2'){
                                    echo '<a class="btn btn-default" href="cuidador-catalogo.php">Cancelar</a>';
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo 'ImagenesMascotas/'.$mascota['foto'];?>" alt="...">
                        <div class="price"><?php echo $mascota['nombre'];?></div>
                          <div class="caption">
                            <h4><?php echo $mascota['tipo'];?></h4>
                            <p><?php echo $mascota['comentarios'];?></p>
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

