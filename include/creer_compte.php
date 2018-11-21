<header class="header header_top">
    <ul>
        <li class='li_1'><a href="index.php?item=identification">Retour</a></li>
        <li class='li_2'><img src="./img/mamie2.png" alt="AdopteUneMamie" /></li>
        <li class='li_3'></li>
    </ul>
</header>
<div class="content content_compte">
    <p class="titre_p">Créer mon compte</p>
    <form id="search" method="post" action="index.php?item=creer_compte">
        <ul class="form">
            <li>
                <input class="sc-input" name="prenom" placeholder="Prénom" type="text" />
            </li>
            <li>
                <input class="sc-input sc-input-reduit" name="age" placeholder="Age" type="text" />
            </li>
            <li>
                <!--<select class="sc-input" id="marque" name="marque">-->
                <select name="competance_transmettre" class="multipleSelect sc-input" placeholder="Compétances à transmettre..." multiple name="language">
                    <option value="1">Couture</option>
                    <option value="2">Cuisine</option>
                    <option value="3">Bricolage</option>
                    <option value="4">Informatique</option>
                </select>
            </li>
            <li>
                <!--<select class="sc-input" id="marque" name="marque">-->
                <select name="competance_apprendre" class="multipleSelect sc-input" placeholder="Compétances à apprendre..." multiple name="language">
                    <option value="1">Couture</option>
                    <option value="2">Cuisine</option>
                    <option value="3">Bricolage</option>
                </select>
                <script>
                    $('.multipleSelect').fastselect();
                </script>
            </li>
            <li>
                &nbsp;- - -
            </li>
            <li>
                <input class="sc-input" name="adresse" placeholder="Adresse" type="text" />
            </li>
            <li>
                <input class="sc-input sc-input-reduit" name="cp" placeholder="CP" type="text" />
            </li>
            <li>
                <input class="sc-input" name="ville" placeholder="Ville" type="text" />
            </li>
            <li>
                <input class="sc-input" name="tel" placeholder="Numéro de téléphone" type="text" />
            </li>
            <li>
                <input class="sc-input" name="email" placeholder="Email de contact" type="text" />
            </li>
            <li>
                <input class="sc-input" name="mdp" placeholder="Mot de passe" type="password" />
            </li>
            <li>
                <input class="sc-input" name="mdp_confirm" placeholder="Confirmation mot de passe" type="password" />
            </li>
        </ul>
        <div class="btn_submit">
            <input type="submit" class="submit" name="Creer_compte" value="CREER MON COMPTE" />
        </div>
    </form>
</div>