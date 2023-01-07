<?php
require_once "Tome.php";


if (isset($_GET['dev'])) {
    if ($_GET['dev'] == True) {
        $JJK = new Manga("Jujutsu Kaisen", "Kishimoto Masashi", "Kana", "Shonen", "Action");
        $code = new Manga("Code Geass - Lelouch of the Rebellion", "Kishimoto Masashi", "Kana", "Shonen", "Action");
        $love = new Manga("Kaguya-sama - Love is War", "Kishimoto Masashi", "Kana", "Shonen", "Action");

        $testTome1 = new Tome($JJK, 1, "03/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/11/54/jujutsu_kaisen_11931845.webp?1649609261", "6.50", 1);
        $testTome2 = new Tome($JJK, 2, "06/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga_volumes/00/48/35484.webp?1649609175", "6.50", 2);
        $testTome3 = new Tome($code, -1, "06/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "https://www.nautiljon.com/images/manga/00/57/code_geass_-_lelouch_of_the_rebellion_75.webp?1666957492", "15.50", 3);
        $testTome4 = new Tome($love, -1, "06/03/2000", "Naruto est un garçon un peu spécial. Il est toujours tout seul et son caractère fougueux ne l'aide pas vraiment à se faire apprécier dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un maître Hokage, la plus haute distinction dans l'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs.", "http://165.227.152.225/img/Kaguya-sama-LoveisWar/1.1.webp", "15.50", 3);

    }
}


?>

