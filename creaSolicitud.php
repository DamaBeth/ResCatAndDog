<?php

require("libs/config.php");
$page = easy_decrypt($_GET["id"]);
$pageDetails = getPageDetailsByName($currentPage);
$idM = ($_GET["idM"]);

$msg = '';
if (isset($_POST["sub"])) {
    $comentarios     = db_prepare_input($_POST["comentarios"]);
    $idCuidador     = db_prepare_input($_POST["idCuidador"]);
    $idAdoptante   = db_prepare_input($_POST["idAdoptante"]);
    //$idMascota   = db_prepare_input($_POST["idMascota"]);

    if($comentarios <> ""){
            $sqlUS = "INSERT INTO " . TABLE_SOLICITUD . " (`comentarios`,`idCuidador`, `idAdoptante`, `idMascota`) VALUES 
                (:com, :cui, :ado, :mas)";
            
                try {
                    $stmt = $DB->prepare($sqlUS);
                    $stmt->bindValue(":com", $comentarios);
                    $stmt->bindValue(":cui",$idCuidador);
                    $stmt->bindValue(":ado",$idAdoptante);
                    $stmt->bindValue(":mas",$idM);
                   
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $msg = successMessage("Solicitud enviada satisfactoriamente");
                    } else if ($stmt->rowCount() == 0) {
                        $msg = successMessage("No changes affected");
                    } else {
                        $msg = errorMessage("Failed to add page");
                    }
                } catch (Exception $ex) {
                    echo errorMessage($ex->getMessage());
                }
    }else {
        $msg = errorMessage("Por favor, agregue algún motivo o comentario para el cuidador que verá esta solicitud");
    }
}
/*
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
    $pageTitle = "Agregar usuario";
}
*/


include("header.php");
?>
<style>
.rows{ width:100%; height:auto; overflow:hidden; margin-bottom:10px; }
.label{ width:100px;color:#000; float:left;padding-top:5px;}
.input-row{ width:280px; height:32px; background-color:#FFF; float:left; position:relative; }
.input-textarea-row{ width:280px; height:65px; background-color:#FFF; float:left; position:relative; }
.textbox{ width:100%; height:24px;  border:1px solid #007294;outline:none; background:transparent; color:#000; padding:0px;  }
.textarea{ width:100%; height:57px;  border:1px solid #007294; outline:none; background:transparent; color:#000; padding:0px;  }
.submit_button{background:#118eb1;padding:15px;border:10px;cursor:pointer;}
.submit_button:hover{background:#007294;padding:15px;border:10px;cursor:pointer;}
.success{padding-bottom:30px; color:#009900;}
.error{padding-bottom:30px; color:#F00;}
</style>
<?php echo $msg; ?>
<div class="row main-row">
    <div class="9u">
        <section class="left-content">
            <h2><?php echo stripslashes($pageDetails["page_title"]); ?></h2>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>
        </section>



        <!--Interfaz de registro-->
        <section class="left-content">
            <form method="post" action="" name="registrar">
            <p>Dile algo al cuidador actual de esta huellita, puedes agregar tu número o alguna forma de contactarte con él/ella</p>
                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Comentarios: </div>
                    <div class="input-textarea-row" ><input name="comentarios" id="comentarios" type="text" class="textarea" autocomplete="off"></div>
                </div>
                <br>
                <div class="rows">
                <div class="form-actions">
                      <a class="btn btn-primary" href="catalog.php"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </div>
                <div class="label"></div>
                    <input type="submit" style="color:#FFF;" value="Enviar solicitud" name="sub" class="submit_button" />
                </div>

            </form>

        </section>


    </div>
    <!--sidebar starts-->
	<?php include("sidebar.php"); ?>    
    <!--sidebar ends-->
</div>
<?php
include("footer.php");
?>