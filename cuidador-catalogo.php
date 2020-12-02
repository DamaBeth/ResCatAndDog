<?php

require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);
$id = 1; /*id del cuidador que está logueado*/
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("header.php");?>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?v=<?php echo(rand()); ?>"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js?v=<?php echo(rand()); ?>"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/styles.css?v=<?php echo(rand()); ?>">
    </head>
    
    <body>
        <h1 class="text-logo"> Administración del catálogo </h1>
        <div class="container admin">
            <div class="row">
                <div class="detalles">
                    <label>Lista de mascotas </label>  <a href="agregar-mascota-cuidador.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Agregar una mascota</a></h1>
                </div>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Raza</th>
                      <th>Categoría</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        $statement = $DB->query("SELECT mascota.idMascota, mascota.nombre, mascota.comentarios, mascota.tipo, categorias.name AS categoria, usuario.nombre AS nameUser, usuario.telefono AS telUser FROM mascota LEFT JOIN categorias ON mascota.categoria = categorias.id JOIN cuidador ON mascota.cuidador = cuidador.idCuidador JOIN usuario ON cuidador.idUsuario = usuario.idUsuario WHERE mascota.estado = 'activo' AND mascota.cuidador = '2' ORDER BY mascota.idMascota DESC");
                        /*$statement->execute(array($id));*/
                        while($mascota = $statement->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $mascota['nombre'] . '</td>';
                            echo '<td>'. $mascota['comentarios'] . '</td>';
                            echo '<td>'. $mascota['tipo'] . '</td>';
                            echo '<td>'. $mascota['categoria'] . '</td>';
                            echo '<td width=300>';
                            echo '<a class="btn btn-default" href="ver-mascota.php?id='.$mascota['idMascota'].'"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="modificar-mascota.php?id='.$mascota['idMascota'].'"><span class="glyphicon glyphicon-pencil"></span> Modificar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="eliminar-mascota.php?id='.$mascota['idMascota'].'"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                      ?>
                  </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

<?php
include("footer.php");
?>