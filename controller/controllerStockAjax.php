<?php
//$_GET['dev'] = true;

//$_SESSION['idUser'];

//Date sous la forme jj-mm-aaaa
//echo $_POST['idProduitStock'] . "   "  . $_POST['startDateStock'] .  "   " . $_POST['endDateStock'];
if(isset($_POST['idProduitStock']) && isset($_POST['startDateStock']) && isset($_POST['endDateStock'])){

    if(isset($_GET['dev'])){
        $dates = array();
        for ($i=0; $i<20; $i++) {
            $day = rand(1, 28);
            $month = rand(1, 12);
            $year = rand(2000, 2022);
            $date = str_pad($day, 2, "0", STR_PAD_LEFT) . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" . $year;
            array_push($dates, $date);
        }

        $productStocks = [];
        for ($i=0; $i<20; $i++) {
            array_push($productStocks, rand(10,200));
        }

    }
    else{
        $dates = array();
        for ($i=0; $i<20; $i++) {
            $day = rand(1, 28);
            $month = rand(1, 12);
            $year = rand(2000, 2022);
            $date = str_pad($day, 2, "0", STR_PAD_LEFT) . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" . $year;
            array_push($dates, $date);
        }


        $pdo = new PDO('mysql:host=localhost;dbname=db', 'webmaster', 'phpWebMaster22!');
        $stockEvo = array();
        $reappros = $pdo->query("SELECT r.qte,r.date FROM REAPPRO_STOCK r WHERE r.idProduit = ".$_POST['idProduitStock'])->fetchAll();
        foreach($reappros as $reappro){
            $evo = array($reappro[1],$reappro[0]);
            $stockEvo[$evo[0]] = $evo;
        }
        $sells = $pdo->query("SELECT pf.nombreProduit,f.date FROM PRODUIT_FACTURATION pf, FACTURATION f WHERE f.idFacturation = pf.idFacturation AND pf.idProduit = ".$_POST['idProduitStock'])->fetchAll();
        foreach($sells as $sell){
            $evo = array($sell[1],$sell[0]*-1);
            $stockEvo[$evo[0]] = $evo;
        }
        ksort($stockEvo,SORT_STRING);
        
        $dates = array();
        $productStocks = array();
        $stock = 0;
        foreach($stockEvo as $evo){
            $stock = $stock + $evo[1];
            array_push($dates, $evo[0]);
            array_push( $productStocks, $stock);
        }

    }

    //todo faire la requete SQL qui prend les donnée entre les deux dates si date < a l'apparition prendre la premiere possible


    $fullArray = ["dates" => $dates, "productStocks" => $productStocks];
    echo json_encode($fullArray);
}

