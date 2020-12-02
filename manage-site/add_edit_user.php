<?php


require("../libs/config.php");

$msg = '';
if (isset($_POST["sub"])) {

    $nombre     = db_prepare_input($_POST["nombre"]);
    $correo     = db_prepare_input($_POST["correo"]);
    $password   = db_prepare_input($_POST["password"]);
    $telefono   = db_prepare_input($_POST["telefono"]);
    $username   = db_prepare_input($_POST["username"]);
    $calle      = db_prepare_input($_POST["calle"]);
    $colonia    = db_prepare_input($_POST["colonia"]);
    $estado     = db_prepare_input($_POST["estado"]);
    $noExterior = db_prepare_input($_POST["noExterior"]);
    $noInterior = db_prepare_input($_POST["noInterior"]);
    $idUsuario  = db_prepare_input($_POST["idUsuario"]);

    $status = ($status <> "") ? $status : "I";

    if ($nombre <> "" && $username <> "" && $correo <> "" && $password <> "") {
        if ($idUsuario <> "") {

            $sqlUS = "UPDATE " . TABLE_USUARIO . " SET  `nombre` =  :nom, "
                    . " `calle` =  :ca, `colonia` = :col, "
                    . " `estado` =  :es, `noExterior` = :nex, "
                    . " `noInterior` =  :nint, `correo` = :correo, "
                    . " `password` =  :pass, `telefono` = :tel, "
                    . " `username` =  :user"
                    . " WHERE `idUsuario` = :pid";
            
            try {
                $stmt = $DB->prepare($sqlUS);
                $stmt->bindValue(":nom", $nombre);
                $stmt->bindValue(":ca", $calle);
                $stmt->bindValue(":col", $colonia);
                $stmt->bindValue(":es", $estado);
                $stmt->bindValue(":nex", $noExterior);
                $stmt->bindValue(":nint", $noInterior);
                $stmt->bindValue(":correo", $correo);
                $stmt->bindValue(":pass", $password);
                $stmt->bindValue(":tel", $telefono);
                $stmt->bindValue(":user", $username);
                $stmt->bindValue(":pid", $idUsuario);
               
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $msg = successMessage("Usuario mdificado con éxito");
                }  else if ($stmt->rowCount() == 0) {
                    $msg = successMessage("No changes affected");
                } else {
                    $msg = errorMessage("Error. No se púdo modificar la información del usuario");
                }
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }
            
        } else {
            $sqlUS = "INSERT INTO " . TABLE_USUARIO . " (`nombre`,`calle`, `colonia`, `estado`, `noExterior`, `noInterior`, `correo`, `password`, `telefono`, `username`) VALUES 
                (:pt, :ca, :col, :es, :nex, :nint, :correo, :pdsc, :mkey, :mdesc)";
            
                try {
                    $stmt = $DB->prepare($sqlUS);
                    $stmt->bindValue(":pt", $nombre);
                    $stmt->bindValue(":ca",$calle);
                    $stmt->bindValue(":col",$colonia);
                    $stmt->bindValue(":es",$estado);
                    $stmt->bindValue(":nex",$noExterior);
                    $stmt->bindValue(":nint",$noInterior);
                    $stmt->bindValue(":correo", $correo);
                    $stmt->bindValue(":pdsc", $password);
                    $stmt->bindValue(":mkey", $telefono);
                    $stmt->bindValue(":mdesc", $username);
    
                   
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $msg = successMessage("Usuario agregado satisfactoriamente");
                    } else if ($stmt->rowCount() == 0) {
                        $msg = successMessage("No changes affected");
                    } else {
                        $msg = errorMessage("Failed to add page");
                    }
                } catch (Exception $ex) {
                    echo errorMessage($ex->getMessage());
                }
        }
    } else {
        $msg = errorMessage("Todos los campos son obligatorios, a excepción del número interior");
    }
}

if (isset($_GET["edit"]) && $_GET["edit"] != "") {
    $pageTitle = "Editar usuario";

    try {
        $stmt = $DB->prepare("SELECT * FROM " . TABLE_USUARIO . " WHERE `idUsuario` = :pid");
        $stmt->bindValue(":pid", intval(db_prepare_input($_GET["edit"])));
        $stmt->execute();
        $details = $stmt->fetchAll();

    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
} else {
    $pageTitle = "Registrar nuevo usuario";
}


include("header.php");

$sql = "SELECT * FROM " . TABLE_USUARIO . " ORDER BY nombre ASC";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $optionsRs = $stmt->fetchAll();
} catch (Exception $ex) {
    echo errorMessage($ex->getMessage());
}
?>   

<link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>
<!--
<script type="text/javascript">
    $(document).ready(function() {
        $("#nombre").cleditor();
    });
    function changeAlias() {
        var title = $.trim($("#nombre").val());
        title = title.replace(/[^a-zA-Z0-9-]+/g, '-');
        $("#nombre").val(title.toLowerCase());
    }
</script>
-->
<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action="" name="users">
        <input type="hidden" name="idUsuario" value="<?php echo $details[0]["idUsuario"]; ?>"  />
        
        <table id="tableForm">
            <tr>
                <td class="formLeft"><span class="required">*</span>Nombre: </td>
                <td><input type="text" name="nombre" id="nombre" class="textboxes" value="<?php echo stripslashes($details[0]["nombre"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Calle: </td>
                <td><input type="text" name="calle" id="calle" class="textboxes" value="<?php echo stripslashes($details[0]["calle"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Colonia: </td>
                <td><input type="text" name="colonia" id="colonia" class="textboxes" value="<?php echo stripslashes($details[0]["colonia"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Estado: </td>
                <td><input type="text" name="estado" id="estado" class="textboxes" value="<?php echo stripslashes($details[0]["estado"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Número exterior: </td>
                <td><input type="text" name="noExterior" id="noExterior" class="textboxes" value="<?php echo stripslashes($details[0]["noExterior"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft">Número interior: </td>
                <td><input type="text" name="noInterior" id="noInterior" class="textboxes" value="<?php echo stripslashes($details[0]["noInterior"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Teléfono: </td>
                <td><input type="text" name="telefono" id="telefono" class="textboxes" value="<?php echo stripslashes($details[0]["telefono"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Correo: </td>
                <td><input type="text" name="correo" id="correo" class="textboxes" value="<?php echo stripslashes($details[0]["correo"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Nombre de usuario: </td>
                <td><input type="text" name="username" id="username" class="textboxes" value="<?php echo stripslashes($details[0]["username"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Contraseña: </td>
                <td><input type="text" name="password" id="password" class="textboxes" value="<?php echo stripslashes($details[0]["password"]); ?>" autocomplete="off"  onkeyup="changeAlias();"  /> </td>
            </tr>
            <tr>
                <td></td>
                <td> <input type="submit" name="sub" value="Guardar cambios" /> &nbsp;  <input type="button" name="" onclick="javascript:window.location = 'manage_users.php';" value="Volver a la lista de usuarios" /> </td>
            </tr>       
        </table>
    </form>
</div>

<?php
include("footer.php");
?>