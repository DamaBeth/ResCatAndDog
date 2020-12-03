<?php

require("libs/config.php");
$page = easy_decrypt($_GET["id"]);
$pageDetails = getPageDetailsByName($currentPage);

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
    $tipo       = db_prepare_input($_POST["tipo"]);

    $status = ($status <> "") ? $status : "I";

    if($nombre <> ""  && $correo <> "" && $password <> "" && $username <> ""){
            $sqlUS = "INSERT INTO " . TABLE_USUARIO . " (`nombre`,`calle`, `colonia`, `estado`, `noExterior`, `noInterior`, `correo`, `password`, `telefono`, `username`, `tipo`) VALUES 
                (:pt, :ca, :col, :es, :nex, :nint, :correo, :pdsc, :mkey, :mdesc, :tipo)";
            
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
                    $stmt->bindValue(":tipo", $tipo);
                   
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
    }else {
        $msg = errorMessage("Todos los campos son obligatorios");
    }
}

include("header.php");
?>

<style>
.rows{ width:100%; height:auto; overflow:hidden; margin-bottom:10px; margin-right:30px; padding-left:30px;}
.label{ width:100px;color:#000; float:left;padding:3px; margin-bottom:10px; margin-right:30px; padding-left:30px;}
.input-row{ width:280px; height:32px; background-color:#FFF; float:left; position:relative; }
.input-textarea-row{ width:280px; height:65px; background-color:#FFF; float:left; position:relative; }
.textbox{ width:100%; height:24px;  border:2px solid #007294;outline:none; background:transparent; color:#000; padding:0px;  }
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
            <h1><?php echo stripslashes($pageDetails["page_title"]); ?></h1>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>
        </section>



        <!--Interfaz de registro-->
        <section class="left-content">
            <form method="post" action="" name="registrar">
            <p>Datos personales:</p>
                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Nombre completo: </div>
                    <div class="input-row" ><input name="nombre" id="nombre" type="text" class="textbox" autocomplete="off"></div>
                </div>
                
                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Telefono: </div>
                    <div class="input-row" ><input name="telefono" id="telefono" type="text" class="textbox" autocomplete="off"></div>
                </div>

                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Calle: </div>
                    <div class="input-row" ><input name="calle" id="calle" type="text" class="textbox" autocomplete="off"></div>
                </div>

                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Colonia: </div>
                    <div class="input-row" ><input name="colonia" id="colonia" type="text" class="textbox" autocomplete="off"></div>
                </div>

                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Estado: </div>
                    <div class="input-row" ><input name="estado" id="estado" type="text" class="textbox" autocomplete="off"></div>
                </div>

                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Número exterior: </div>
                    <div class="input-row" ><input name="noExterior" id="noExterior" type="text" class="textbox" autocomplete="off"></div>
                </div>

                <div class="rows">
                    <div class="label">Número interior: </div>
                    <div class="input-row" ><input name="noInterior" id="noInterior" type="text" class="textbox" autocomplete="off"></div>
                </div>

                <p>Datos de usuario:</p>

                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Nombre de usuario: </div>
                    <div class="input-row" ><input name="username" id="username" type="text" class="textbox" autocomplete="off"></div>
                </div>
                
                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Correo: </div>
                    <div class="input-row" ><input name="correo" id="correo" type="text" class="textbox" autocomplete="off"></div>
                </div>
                
                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Contraseña: </div>
                    <div class="input-row" ><input name="password" id="password" type="text" class="textbox" autocomplete="off"></div>
                </div>

                <div class="rows">
                    <div class="label"><span style="color:#F00;">*</span>Seleccione el tipo de función que desea desempeñar: </div>
                        <label><input type="radio" name="tipo" value="B" checked  />Adoptante</label> &nbsp; 
                        <label><input type="radio" name="tipo" value="C"  />Organización u colaborador</label>
                </div>
                
                <div class="rows">
                <div class="label"></div>
                    <input type="submit" value="Registrar" name="sub" class="submit_button" />
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