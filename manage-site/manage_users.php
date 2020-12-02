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
            <td><a href="add_edit_user.php?edit=<?php echo ($rs["idUsuario"]); ?>">Edit</a> 
                <a href="manage_users.php?del=<?php echo ($rs["idUsuario"]); ?>" onclick="return confirm('Are you sure?');">Delete</a> </td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include("footer.php");
?>