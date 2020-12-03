<?php


require("../libs/config.php");
$pageTitle = "Administrar usuarios";
$msg = '';
if (isset($_GET["del"]) && $_GET["del"] != "") {
    $sql = "DELETE FROM  " . TABLE_USUARIO . " WHERE `idUsuario` = :id";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":id", db_prepare_input($_GET["del"]));
        $stmt->execute();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        $msg = successMessage("Usuario eliminado con éxito");
    } else {
        $msg = errorMessage(mysql_error());
    }
}
include("header.php");
?>   
<?php echo $msg; ?>
<style>
.rows{ width:100%; height:auto; overflow:hidden; margin-bottom:10px; }
.label{ width:100px;color:#000; float:left;padding-top:5px;}
.input-row{ width:280px; height:32px; background-color:#FFF; float:left; position:relative; }
.textbox{ width:100%; height:24px;  border:1px solid #007294;outline:none; background:transparent; color:#000; padding:0px;  }
.textarea{ width:100%; height:57px;  border:1px solid #007294; outline:none; background:transparent; color:#000; padding:0px;  }
.submit_button{background:#118eb1;padding:5px;border:none;cursor:pointer;}
.success{padding-bottom:30px; color:#009900;}
.error{padding-bottom:30px; color:#F00;}
</style>
<div class="title" style="text-align:right;"><a href="add_edit_user.php">Registrar usuario</a></div>
<table class="bordered">
    <tr>
        <th ><strong>Nombre</strong> </th>
        <th ><strong>Correo</strong> </th>
        <th ><strong>Telefono</strong> </th>
        <th ><strong>Nombre de usuario</strong> </th>
        <th ><strong>Acción</strong> </th>
    </tr>
    <?php
    $sql = "SELECT * FROM " . TABLE_USUARIO . " WHERE 1 ORDER BY nombre ASC, idUsuario DESC";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
    foreach ($results as $rs) {
        ?>
        <tr>
            <td ><?php echo stripslashes($rs["nombre"]); ?></td>
            <td><?php echo stripslashes($rs["correo"]); ?></td>
            <td><?php echo stripslashes($rs["telefono"]); ?></td>
            <td><?php echo stripslashes(($rs["username"])); ?></td>
            <td><a  href="add_edit_user.php?edit=<?php echo ($rs["idUsuario"]); ?>">Edit</a> 
                <a href="manage_users.php?del=<?php echo ($rs["idUsuario"]); ?>" onclick="return confirm('Are you sure?');">Delete</a> </td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include("footer.php");
?>