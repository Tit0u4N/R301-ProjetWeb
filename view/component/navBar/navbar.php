<?php
    if (!isset($fullNavBar))
        $fullNavBar = True
?>
<nav>
    <a class="logo" href="index.php?CatalogSelection"><span>MANGA</span><span>FLOW</span></a>
    <?php
        if ($fullNavBar) {
            require "view/component/navBar/searchBar.php";
            require "view/component/navBar/account.php";
        }
    ?>
</nav>