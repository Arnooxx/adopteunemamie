<header class="header header_top">
    <ul>
        <li class='li_1'><a href="index.php?item=resultats">Retour</a></li>
        <li class='li_2'><a href="index.php?item=identification"><img src="./photos/<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" alt="<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" /></a></li>
        <li class='li_3'></li>
    </ul>
</header>
<div class="content content_resultats">
    <?php if(count($result)==0){ ?>
        <p style="text-align:center;">
            Aucun profil enregistré dans vos favoris pour le moment.<br /><br />
            Pour ajouter un nouveau profil, vous pouvez cliquer sur la petite etoile lors de votre recherche.<br /><br /><br /><br />
        </p>
    <?php } ?>
    <?php foreach($result as $cle => $valeur){ ?>
    <div class="l_r">
        <a class="zone" href="index.php?item=detail&id=<?php echo $valeur->id_membre_favoris; ?>"></a>
        <a class="favoris_profil" href="index.php?item=favoris&add=<?php echo $valeur->id_membre_favoris; ?>"><img src="./img/favoris_profil_selection.png" alt="Ajouter en favoris" /></a>
        <a class="croix_favoris" href="index.php?item=favoris&del=<?php echo $valeur->favoris_id; ?>">X</a>
        <div class="profil"><img style='max-width:112px; max-height:96px;' src="./photos/<?php echo $valeur->nom_photo; ?>" alt="<?php echo $valeur->nom_photo; ?>" /></div>
        <p class="descr"> 
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
    <?php } ?>
            
    <form id="search" method="post" action="index.php?item=rechercher">
        <div class="btn_submit">
            <input type="submit" class="submit" name="nouvelle_recherche" value="NOUVELLE RECHERCHE" />
        </div>
    </form>
</div>
        