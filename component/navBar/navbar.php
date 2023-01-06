<?php
    if (!isset($fullNavBar))
        $fullNavBar = True
?>
<nav>
    <a class="logo" href=""><span>MANGA</span><span>FLOW</span></a>
    <?php
        if ($fullNavBar) {
            require "./component/navBar/searchBar.php";
            require "./component/navBar/account.php";
        }

        ?>

</nav>