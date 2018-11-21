<header class="header header_top">
    <ul>
        <li class='li_1'><a href="index.php?item=resultats#lr<?php echo $result->membre_id; ?>"">Retour</a></li>
        <li class='li_2'><a href="index.php?item=identification"><img src="./photos/<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" alt="<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" /></a></li>
        <li class='li_3'></li>
    </ul>
</header>
<div class="content content_detail">
    <div class="photo_xl"><img style="max-height:250px; max-width:250px;" src="./photos/<?php echo $result->nom_photo; ?>" alt="<?php echo $result->nom_photo; ?>" /></div>
    <p class="infos">
        <a class="favoris" href="index.php?item=favoris&add=<?php echo $result->membre_id; ?>"><img src="./img/favoris_profil_xl<?php echo in_array( $result->membre_id, $favoris) ? '_selection' : ''; ?>.png" alt="favoris" /></a>
        <span class="prenom"><?php echo $result->prenom; ?></span> &nbsp; &bull; &nbsp; <span class="age"><?php echo $result->age; ?> ans</span><br/><br/>
        <img src="./img/map.png" alt="Situé à" /> <?php echo round(($result->distance / 1000),2); ?> km<br/><br/>
    </p>

    <?php if(!empty($transmettre)){ ?>
        <div class="titre_spe">Spécilité(s) : <span>#<?php echo strtoupper($transmettre->nom); ?></span></div>
        <p><?php echo $transmettre->description; ?></p>
    <?php } ?>

    <?php if(!empty($a_acquerir)){ ?>
        <div class="titre_spe_rec">Spécialité(s) recherchée(s) : <span>#<?php echo strtoupper($a_acquerir->nom); ?></span></div>
        <p><?php echo $a_acquerir->description; ?></p>
    <?php } ?>

    <form id="search" method="post" action="tel:<?php echo $result->tel; ?>">
        <div class="btn_submit">
            <input type="submit" class="submit" name="contacter" value="ENTRER EN CONTACT" />
        </div>
    </form>

</div>
