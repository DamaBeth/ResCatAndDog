<?php

require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);
if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    $nombreError = $descripcionError = $edadError = $categoriaError = $tipoError = $fotoError = $nombre = $descripcion = $edad = $categoria = $tipo = $foto = "";

    if(!empty($_POST)) 
    {
        $nombre              = checkInput($_POST['nombre']);
        $descripcion         = checkInput($_POST['comentarios']);
        $edad                = checkInput($_POST['edad']);
        $categoria           = checkInput($_POST['categoria']); 
        $tipo                = checkInput($_POST['tipo']);
        $foto                = checkInput($_FILES["image"]["name"]);
        $imagePath           = 'ImagenesMascotas/'.basename($foto);
        $imageExtension      = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess           = true;
       
        if(empty($nombre)) 
        {
            $nombreError = 'Este campo no puede estar vacío';
            $isSuccess = false;
        }
        if(empty($descripcion)) 
        {
            $descripcionError = 'Este campo no puede estar vacío';
            $isSuccess = false;
        } 
        if(empty($edad)) 
        {
            $edadError = 'Este campo no puede estar vacío';
            $isSuccess = false;
        } 
         
        if(empty($categoria)) 
        {
            $categoriaError = 'Este campo no puede estar vacío';
            $isSuccess = false;
        }
        if(empty($tipo)) 
        {
            $tipoError = 'Este campo no puede estar vacío';
            $isSuccess = false;
        }
        if(empty($foto)) 
        {
            $isImageUpdated = false;
        }
        else
        {
            $isImageUpdated = true;
            $isUploadSuccess =true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $fotoError = "Los archivos permitidos son: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $fotoError = "El archivo ya existe";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 5000000) 
            {
                $fotoError = "La imagen debe de pesar menos de 5MB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $fotoError = "Se ha producido un error al subir el archivo";
                    $isUploadSuccess = false;
                } 
            } 
        }
         
        if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) 
        { 
            if($isImageUpdated)
            {
                $statement = $DB->prepare("UPDATE mascota  set nombre = ?, comentarios = ?, edad = ?, categoria = ?, tipo = ?, foto = ? WHERE idMascota = ?");
                $statement->execute(array($nombre,$descripcion,$edad,$categoria,$tipo,$foto,$id));
            }
            else
            {
                $statement = $DB->prepare("UPDATE mascota  set nombre = ?, comentarios = ?, edad = ?, categoria = ?, tipo = ? WHERE idMascota = ?");
                $statement->execute(array($nombre,$descripcion,$edad,$categoria,$tipo,$id));
            }
            header("Location: admin-catalogo.php");
        }
        else if($isImageUpdated && !$isUploadSuccess)
        {
            $statement = $DB->prepare("SELECT * FROM mascota where idMascota = ?");
            $statement->execute(array($id));
            $mascota        = $statement->fetch();
            $mascota        = $mascota['foto'];
        }
    }
    else 
    {
        $statement = $DB->prepare("SELECT * FROM mascota where idMascota = ?");
        $statement->execute(array($id));
        $mascota = $statement->fetch();
        $nombre         = $mascota['nombre'];
        $descripcion    = $mascota['comentarios'];
        $edad           = $mascota['edad'];
        $categoria      = $mascota['categoria'];
        $tipo           = $mascota['tipo'];
        $foto           = $mascota['foto'];
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
        <h1 class="text-logo"> Modificar datos de la mascota </h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Detalles</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'modificar-mascota.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nombre:
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>">
                            <span class="help-inline"><?php echo $nombreError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:
                            <input type="text" class="form-control" id="comentarios" name="comentarios" placeholder="Descripción" value="<?php echo $descripcion;?>">
                            <span class="help-inline"><?php echo $descripcionError;?></span>
                        </div>
                        <div class="form-group">
                        <label for="price">Edad (en meses):
                            <input type="number" class="form-control" id="edad" name="edad" placeholder="Edad" value="<?php echo $edad;?>">
                            <span class="help-inline"><?php echo $edadError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Raza:
                            <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Raza" value="<?php echo $tipo;?>">
                            <span class="help-inline"><?php echo $tipoError;?></span>
                        </div>


                        <div class="form-group">
                            <label for="category">Categoría:
                            <select class="form-control" id="categoria" name="categoria">
                            <?php
                               foreach ($DB->query('SELECT * FROM categorias') as $row) 
                               {
                                    if($row['id'] == $categoria)
                                        echo '<option selected="selected" value="'. $row['id'] .'">'. $row['name'] . '</option>';
                                    else
                                        echo '<option value="'. $row['id'] .'">'. $row['name'] . '</option>';;
                               }
                            ?>
                            </select>
                            <span class="help-inline"><?php echo $categoriaError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen:</label>
                            <p><?php echo $foto;?></p>
                            <label for="image">Selecciona una nueva imagen::</label>
                            <input type="file" id="image" name="image"> 
                            <span class="help-inline"><?php echo $fotoError;?></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                            <a class="btn btn-primary" href="admin-catalogo.php"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                       </div>
                    </form>
                </div>
                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo 'ImagenesMascotas/'.$foto;?>" alt="...">
                        <div class="price"><?php echo $nombre;?></div>
                          <div class="caption">
                            <h4><?php echo $tipo;?></h4>
                            <p><?php echo $descripcion;?></p>
                            <a href="#" class="btn btn-adoptar" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Adoptarr</a>
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