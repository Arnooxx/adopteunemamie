<header class="header header_top">
    <ul>
        <li class='li_1'></li>
        <li class='li_2'><img src="./img/mamie2.png" alt="AdopteUneMamie" /></li>
        <li class='li_3'></li>
    </ul>
</header>
<div class="content content_identification">
    <form id="identification" method="post" action="index.php?item=identification">
        <p>
            <?php
            if(count($erreur)!=0){
                foreach($erreur as $cle => $value){
                    echo $value.'<br />';
                }
            }
            ?>
        </p>
        <ul class="form">
            <li>
                <input class="sc-input" name="email" placeholder="Email" type="text" />
            </li>
            <li>
                <input class="sc-input" name="password" placeholder="Mot de passe" type="password" />
            </li>
        </ul>  
        <div class="btn_submit">
            <input type="submit" class="submit" name="se_connecter" value="SE CONNECTER" />
        </div>
    </form>
    <div class="ligne_separation"></div>
    <p class="ph_inscription">Pas encore de compte ? Inscrivez vous :</p>
    <ul class="new_insc">
        <li>
            <div class="rect"><a href="index.php?item=creer_compte"><img src="./img/mamie_inscription.png" alt="Je suis une mamie / papy" /></a></div>
            <p class="pst">Je suis un(e) mamie / papy</p>
        </li>
        <li class="ct"></li>
        <li>
            <div class="rect"><a href="index.php?item=creer_compte"><img src="./img/jeune_inscription.png" alt="Adopter une mamie" /></a></div>
            <p class="pst">Adopter un(e) mamie / papy</p>
        </li>
    </ul>
 </div>
        