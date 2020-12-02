<?php
require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        $id = checkInput($_POST['id']);
        $statement = $DB->prepare("UPDATE mascota SET estado = 'inactivo' WHERE idMascota = ?");
        $statement->execute(array($id));
        header("Location: admin-catalogo.php"); 
    }

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
        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Eliminar una mascota <span class="glyphicon glyphicon-cutlery"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Confirmar operación</strong></h1>
                <br>
                <form class="form" action="eliminar-mascota.php" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning">¿Estás seguro que deseas eliminar esta mascota del catálogo?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Aceptar</button>
                      <a class="btn btn-default" href="admin-catalogo.php">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>
<?php
include("footer.php");
?>

