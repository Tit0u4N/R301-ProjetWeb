<?php

    require "Tome.php";

    $naruto = new Manga("Naruto","Kishimoto Masashi","Kana","Shonen","Action");
    $testTome1 = new Tome($naruto, 1,"03/03/2000","Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/59/595.webp?1638617300","6,50",1);
    $testTome2 = new Tome($naruto, 2,"06/03/2000","Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/67/1176.webp?1585684568","6,50",2);
    $testTome3 = new Tome($naruto, -1,"06/03/2000","Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/35/mini/8653.webp?11556873652","15,50",3);

?>

<section class="catalog">
    <?php $testTome1->echoHTMLCard(); ?>
    <?php $testTome2->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>
    <?php $testTome3->echoHTMLCard(); ?>

</section>
<section class="descCardsContainer" id="descCardsContainer">
    <?php $testTome1->echoHTMLDescCard(); ?>
    <?php $testTome2->echoHTMLDescCard(); ?>
    <?php $testTome3->echoHTMLDescCard(); ?>

</section>