<?php
    session_start();
	require_once('./config/config.inc.php');
	require_once("./classes/class.Content.php");
    $content = new Content();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Adopteunemamie.com - Le 1er site intergénérationnel</title>
        <link type="text/css" href="./css/style.css" rel="stylesheet">
        <link rel="icon" href="./img/favicon.ico">

        <?php if($content->selection_item() == 'rechercher' || $content->selection_item() == 'creer_compte'){ ?>
            <link rel="stylesheet" href="dist/build.min.css">
            <script src="dist/build.min.js"></script>
            <link rel="stylesheet" href="dist/fastselect.min.css">
            <script src="dist/fastselect.standalone.js"></script>
            <link rel="stylesheet" href="dist/build_bis.css">
        <?php } ?>

    </head>
    <body>
        <?php echo $content->generate(); ?>
        <footer>
            <ul class="menu">
                <li <?php if($content->selection_menu() == 'accueil'){ ?>class="selected" <?php } ?>><a href="index.php"><img src="./img/menu_home<?php if($content->selection_menu() == 'accueil'){ ?>_s<?php } ?>.png" alt="Accueil"><br />Accueil</a></li>
                <li <?php if($content->selection_menu() == 'favoris'){ ?>class="selected" <?php } ?>><a href="index.php?item=favoris"><img src="./img/favoris<?php if($content->selection_menu() == 'favoris'){ ?>_s<?php } ?>.png" alt="Favoris"><br />Favoris</a></li>
                <li <?php if($content->selection_menu() == 'rechercher'){ ?>class="selected" <?php } ?>><a href="index.php?item=rechercher"><img src="./img/rechercher<?php if($content->selection_menu() == 'rechercher'){ ?>_s<?php } ?>.png" alt="Rechercher"><br />Rechercher</a></li>
                <li <?php if($content->selection_menu() == 'compte'){ ?>class="selected" <?php } ?>><a href="index.php?item=identification"><img src="./img/mon_compte<?php if($content->selection_menu() == 'compte'){ ?>_s<?php } ?>.png" alt="Mon compte"><br />Mon compte</a></li>
            </ul>
        </footer>
    </body>
</html>