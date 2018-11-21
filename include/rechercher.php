<header class="header header_top">
    <ul>
        <li class='li_1'><a href="index.php?item=rechercher&new_s=true">Réinitialiser</a></li>
        <li class='li_2'><a href="index.php?item=identification"><img src="./photos/<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" alt="<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" /></a></li>
        <li class='li_3'></li>
    </ul>
</header>
<div class="content content_rechercher">
    <p class="titre_p">Rechercher un profil</p>
    <form id="search" method="post" action="index.php?item=resultats">
        <ul class="form">
            <li>
                <select name="competance_transmettre[]" class="multipleSelect sc-input" placeholder="Compétances à transmettre..." multiple name="language">
                    <?php foreach($result as $cle => $valeur){ ?>
                        <option <?php echo (isset($_SESSION['competance_transmettre'])) && in_array($valeur->nom, $_SESSION['competance_transmettre']) ? 'selected="selected"': '';  ?> value="<?php echo $valeur->nom; ?>"><?php echo ucfirst($valeur->nom); ?></option>
                    <?php } ?>
                </select>
            </li>
            <li>
                <select name="competance_apprendre[]" class="multipleSelect sc-input" placeholder="Compétances à apprendre..." multiple name="language">
                    <?php foreach($result as $cle => $valeur){ ?>
                        <option <?php echo (isset($_SESSION['competance_apprendre'])) && in_array($valeur->nom, $_SESSION['competance_apprendre']) ? 'selected="selected"': '';  ?> value="<?php echo $valeur->nom; ?>"><?php echo ucfirst($valeur->nom); ?></option>
                    <?php } ?>
                </select>
                <script>
                            $('.multipleSelect').fastselect();
                </script>
            </li>
            <li>
                <select class="sc-input" id="distance" name="distance">
                    <option value="0" class="def">A quelle distance maximum ?</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 2000) ? "selected='selected'" : '';  ?> value="2000">2 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 5000) ? "selected='selected'" : '';  ?> value="5000">5 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 10000) ? "selected='selected'" : '';  ?> value="10000">10 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 20000) ? "selected='selected'" : '';  ?> value="20000">20 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 30000) ? "selected='selected'" : '';  ?> value="30000">30 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 40000) ? "selected='selected'" : '';  ?> value="40000">40 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 50000) ? "selected='selected'" : '';  ?> value="50000">50 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 75000) ? "selected='selected'" : '';  ?> value="75000">75 km</option>
                    <option <?php echo (isset($_SESSION['distance'])) && ($_SESSION['distance'] == 100000) ? "selected='selected'" : '';  ?> value="100000">100 km</option>
                </select>
            </li>
        </ul>
        <div class="btn_submit">
            <input type="submit" class="submit" name="rechercher" value="RECHERCHER" />
        </div>
    </form>
</div>
       