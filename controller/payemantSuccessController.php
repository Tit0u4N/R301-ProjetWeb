<?php


if(isset($_SESSION["userId"])){
    unset($_SESSION['payementIdTest']);
    if(hash_equals($_GET['id'],$_SESSION['payementId'])){
        unset($_SESSION['payementId']);
        unset($_SESSION['basket']);
        $pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');
        $basketId = $pdo->query("SELECT f.idFacturation FROM FACTURATION f WHERE f.idClient = ".$_SESSION["userId"]." AND f.fini = FALSE")->fetchAll()[0][0];
        $pdo->query("UPDATE FACTURATION f SET f.date = '".date("Y-m-d")."', f.fini = 1 WHERE f.idFacturation = ".$basketId);
    }
}

header("Location: index.php?Success");
exit;