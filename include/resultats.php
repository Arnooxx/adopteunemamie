<header class="header header_top">
    <ul>
        <li class='li_1'><a href="index.php?item=rechercher">Retour</a></li>
        <li class='li_2'><a href="index.php?item=identification"><img src="./photos/<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" alt="<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" /></a></li>
        <li class='li_3'><a href="index.php?item=rechercher">Filtrer</a></li>
    </ul>
</header>
<div class="content content_resultats">

    <?php if(count($result)==0){ ?>
        <p style="text-align:center;">
            Aucun resultat ne correspond à votre recherche, merci d'élargir vos critères.<br /><br /><br /><br />
        </p>

        <form id="search" method="post" action="index.php?item=rechercher">
            <div class="btn_submit">
                <input type="submit" class="submit" name="nouvelle_recherche" value="MODIFIER RECHERCHE" />
            </div>
        </form>
    <?php } ?>

    <?php
        $i = 0; 
        foreach($result as $cle => $valeur){ ?>

        <?php if($i == 2){ ?>
        <div class="l_r l_r_pub">
            <a class="zone" target="_blank" href="https://www.alinea.com/fr-fr/couverts/"></a>
            <div class="profil"><img style="max-width:112px; max-height:96px;" src="./img/alinea.png" alt="Studio Danielle" /></div>
            <p class="descr"> 
                <span class="km">0.7 km</span>
                ALINEA<br />
                <span class="promo">-30% RAYON CUISINE</span><br />
                <span class="promo_bis">Annonce suggérée</span><br />
            </p>
        </div>
        <?php } ?>

        <div class="l_r" id="lr<?php echo $valeur->membre_id; ?>">
            <a class="zone" href="index.php?item=detail&id=<?php echo $valeur->membre_id; ?>"></a>
            <a class="favoris_profil" href="index.php?item=favoris&add=<?php echo $valeur->membre_id; ?>"><img src="./img/favoris_profil<?php echo in_array( $valeur->membre_id, $favoris) ? '_selection' : ''; ?>.png" alt="Ajouter en favoris" /></a>
            <div class="profil"><img style='max-width:112px; max-height:96px;' src="./photos/<?php echo $valeur->nom_photo; ?>" alt="<?php echo $valeur->nom_photo; ?>" /></div>
            <p class="descr"> 
                <span class="km"><?php echo round(($valeur->distance / 1000),2); ?> km</span>
                <?php echo ucfirst($valeur->prenom); ?><br />
                <?php echo $valeur->age; ?> ans<br />
                <img src="./img/icon_enseigner.png" title="Enseigner" alt="Enseigner" /> 
                <?php 
                    if(!empty($valeur->competance_transmettre)){
                        $tab_val = explode(';', $valeur->competance_transmettre);
                        foreach($tab_val as $cle2 => $valeur2){
                            if(!empty($valeur2)){
                                echo in_array($valeur2, $_SESSION['competance_apprendre']) ? '<span class="valorisation_competance"> ' : '';
                                echo '#'.strtoupper($valeur2);
                                echo in_array($valeur2, $_SESSION['competance_apprendre']) ? ' </span>' : '';
                                echo ' ';
                            }
                        }
                    }else{
                        echo '...';
                    }
                ?><br />
                <img src="./img/icon_apprendre.png" title="Apprendre" alt="Apprendre" /> 
                <?php 
                    if(!empty($valeur->competance_apprendre)){
                        $tab_val = explode(';', $valeur->competance_apprendre);
                        foreach($tab_val as $cle2 => $valeur2){
                            if(!empty($valeur2)){
                                echo in_array($valeur2, $_SESSION['competance_transmettre']) ? '<span class="valorisation_competance"> ' : '';
                                echo '#'.strtoupper($valeur2);
                                echo in_array($valeur2, $_SESSION['competance_transmettre']) ? ' </span>' : '';
                                echo ' ';
                            }
                        }
                    }else{
                        echo '...';
                    }
                ?>
            </p>
        </div>

    <?php 
        $i++;
        } ?>
</div>