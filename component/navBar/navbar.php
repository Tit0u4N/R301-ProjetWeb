<?php
    define('affiche',true) ;
?>
<nav>
    <a class="logo" href=""><span>MANGA</span><span>FLOW</span></a>
    <?php
        if (affiche) {
            require "./component/navBar/searchBar.html";
            require "./component/navBar/account.html";
        }

        ?>

</nav>