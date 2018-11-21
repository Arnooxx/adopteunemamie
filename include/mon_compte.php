<header class="header header_top">
<ul>
        <li class='li_1'></li>
        <li class='li_2'><a href="index.php?item=identification"><img src="./photos/<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" alt="<?php echo isset($_SESSION['connecte_photo']) ? $_SESSION['connecte_photo'] : 'arnaud_c.jpg'; ?>" /></a></li>
        <li class='li_3'></li>
    </ul>
</header>
<div class="content content_identification">
    <p style="text-align:center;">
    
        Bienvenue sur votre compte AdopteUneMamie !<br /><br />
        <img src="./img/giphy.gif" style="max-width:300px;" alt="Good job" />
        <br /><br /><br /><br />
        
        </p>
    <form id="identification" method="post" action="index.php?item=mon_compte&deco=true">
        <div class="btn_submit">
            <input type="submit" class="submit" name="se_deconnecter" value="SE DECONNECTER" />
        </div>
    </form>
 </div>
        