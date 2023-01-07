<?php
if (isset($_GET['dev'])) {
    if ($_GET['dev'] == True) {

        $testTome1->echoHTMLCard();
        $testTome2->echoHTMLCard();
        $testTome3->echoHTMLCard();
        $testTome4->echoHTMLCard();
        $testTome1->echoHTMLCard();
        $testTome2->echoHTMLCard();
        $testTome3->echoHTMLCard();
        $testTome4->echoHTMLCard();
        $testTome1->echoHTMLCard();
        $testTome2->echoHTMLCard();
        $testTome3->echoHTMLCard();
        $testTome4->echoHTMLCard();

    }
} else {

    $mysqli = new mysqli("165.227.152.225", "p2", "FicsiT22!", "db", 3306);

    $index = rand(1, 10);
    $result = $mysqli->query("SELECT * FROM MANGA m WHERE m.idManga  =" . $index);
    $result->data_seek(1);
    $mangaSQL = $result->fetch_assoc();


    $resultType = $mysqli->query("SELECT t.nom FROM TYPE t WHERE t.idType  = " . $mangaSQL['idType']);
    $resultType->data_seek(1);
    $TypeSQL = $resultType->fetch_assoc();

    $mangaTest = new Manga($mangaSQL['nomManga'], $mangaSQL['auteur'], " ", $TypeSQL['nom'], "A recup");

    $tomeArray = array();
    $result = $mysqli->query("SELECT * FROM PRODUIT p WHERE p.idManga =" . $mangaSQL['idManga']);
    for ($row_no = 0; $row_no < $result->num_rows; $row_no++) {
        $result->data_seek($row_no);
        $row = $result->fetch_assoc();

        $resultImg = $mysqli->query("SELECT * FROM IMAGE i WHERE i.idProduit =" . $row['idProduit']);
        $resultImg->data_seek(1);
        $Img = $resultImg->fetch_assoc();

        array_push($tomeArray, new Tome($mangaTest, (int)$row['numTome'], $row['dateParution'], $row['description'], $Img['lienImage'], $row['prixPublic'], $row['idProduit']));
    }

    foreach ($tomeArray as $tome) {
        $tome->echoHTMLCard();
    }
}

?>