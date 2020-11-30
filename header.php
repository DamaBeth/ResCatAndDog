<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo stripslashes($pageDetails["page_title"]); ?> - <?php echo SITE_NAME; ?> - RescatAndDog</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="<?php echo stripslashes($pageDetails["meta_desc"]); ?>" />
        <meta name="keywords" content="<?php echo stripslashes($pageDetails["meta_keywords"]); ?>" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <script src="js/jquery.min.js"></script>
        <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-desktop.css" />
        </noscript>
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    </head>
    <body>
        <!-- ********************************************************* -->
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="12u">
                        <header id="header">
                            <h1><a href="<?php echo getHomeURL(); ?>" id="logo"><?php echo SITE_NAME; ?></a></h1>
                            <nav id="nav">
                                <a href="index.php" <?php echo ($currentPage == "index") ? ' class="current-page-item"' : '' ?> >inicio</a>
                                <a href="about-us.php" <?php echo ($currentPage == "about-us") ? ' class="current-page-item"' : '' ?> >Nosotros</a>
                                <a href="catalog.php" <?php echo ($currentPage == "catalog") ? ' class="current-page-item"' : '' ?>>Catálogo</a>
                                <a href="signin.php" <?php echo ($currentPage == "signin") ? ' class="current-page-item"' : '' ?> >Registrarse</a>
                                <a href="login.php" <?php echo ($currentPage == "login") ? ' class="current-page-item"' : '' ?>>Iniciar sesión</a>
                                <a href="manage-site" target="_blank">Adm-Quitaralfinal</a>
                            </nav>
                        </header>

                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($currentPage == "index") {
            try {
                $stmt = $DB->prepare("SELECT * FROM " . TABLE_TAGLINE . " WHERE 1 LIMIT 1");
                $stmt->bindValue(":pname", $pageAlias);
                $stmt->execute();
                $details = $stmt->fetchAll();
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }
            ?>
            <div id="banner-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="12u">

                            <div id="banner">
                                <h2><?php echo stripslashes($details[0]["tagline1"]); ?></h2>
                                <span><?php echo stripslashes($details[0]["tagline2"]); ?></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div id="main">
            <div class="container">