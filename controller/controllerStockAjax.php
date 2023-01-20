<?php


function compareDate(String $date1,String $date2){
    $b = false;
    $date1 = explode("-",$date1);
    $date2 = explode("-",$date2);
    if(intval($date1[0]) < intval($date2[0])){
        $b = true;
    }
    else if(intval($date1[0]) == intval($date2[0])){ 
        if(intval($date1[1]) < intval($date2[1])){
            $b = true;
        }
        else if(intval($date1[1]) == intval($date2[1])){
            if(intval($date1[2]) < intval($date2[2])){
                $b = true;
            }
        }
    }
    return $b;
}

//Date sous la forme jj-mm-aaaa
if(isset($_POST['idProduitStock'])){
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
            $evo = array($sell[1],($sell[0]*-1));
            $stockEvo[$evo[0]] = $evo;
        }
        ksort($stockEvo,SORT_STRING);
        
        $dates = array();
        $productStocks = array();
        $stock = 0;
        foreach($stockEvo as $evo){
            if(!empty($_POST['startDateStock']) && !empty($_POST['endDateStock'])){  
                if(compareDate($evo[0],$_POST['startDateStock'])){
                    $stock = $stock + $evo[1];
                }
                else if(compareDate($evo[0],$_POST['endDateStock'])){
                    $stock = $stock + $evo[1];
                    array_push($dates, $evo[0]);
                    array_push( $productStocks, $stock);
                }
            }
            else{
                $stock = $stock + $evo[1];
                array_push($dates, $evo[0]);
                array_push( $productStocks, $stock);
            }
        }
        if(empty($dates)){
            array_push($dates, $_POST['startDateStock']);
            array_push( $productStocks, $stock);
            array_push($dates, $_POST['endDateStock']);
            array_push( $productStocks, $stock);
        }
        else if(count($dates) == 1){
            array_push($dates, $_POST['endDateStock']);
            array_push( $productStocks, $stock);
        }

    }


    
    $ventes = 0;
    $ventesArgent = 0;
    $achats = 0;
    $achatsArgent = 0;
    if(!empty($_POST['startDateStock']) && !empty($_POST['endDateStock'])){
        $reappros = $pdo->query("SELECT p.idProduit,p.prixAchat,sum(r.qte) FROM PRODUIT p, REAPPRO_STOCK r  WHERE p.idProduit = r.idProduit AND r.date BETWEEN '".$_POST['startDateStock']."' AND '".$_POST['endDateStock']."' GROUP BY p.idProduit")->fetchAll();
        $sells = $pdo->query("SELECT p.idProduit,p.prixAchat,sum(pf.nombreProduit) FROM PRODUIT p, PRODUIT_FACTURATION pf, FACTURATION f WHERE p.idProduit = pf.idProduit AND f.idFacturation = pf.idFacturation AND f.fini = TRUE AND f.date BETWEEN '".$_POST['startDateStock']."' AND '".$_POST['endDateStock']."' GROUP BY p.idProduit")->fetchAll();  
    }
    else{
        $reappros = $pdo->query("SELECT p.idProduit,p.prixAchat,sum(r.qte) FROM PRODUIT p, REAPPRO_STOCK r  WHERE p.idProduit = r.idProduit GROUP BY p.idProduit")->fetchAll();
        $sells = $pdo->query("SELECT p.idProduit,p.prixAchat,sum(pf.nombreProduit) FROM PRODUIT p, PRODUIT_FACTURATION pf, FACTURATION f WHERE p.idProduit = pf.idProduit AND f.idFacturation = pf.idFacturation AND f.fini = TRUE GROUP BY p.idProduit")->fetchAll();  
    }
    foreach($reappros as $reappro){
        $achats = $achats + $reappro[2];
        $achatsArgent = $achatsArgent + ($reappro[2]*$reappro[1]);
    }
    foreach($sells as $sell){
        $ventes = $ventes +$sell[2];
        $ventesArgent = $ventesArgent + $sell[2]*$sell[1];
    }
    $bilan = $ventesArgent-$achatsArgent;

    $seuil = $pdo->query("SELECT gs.seuilLimite FROM GESTION_STOCK gs WHERE gs.idProduit = ".$_POST['idProduitStock'])->fetchAll()[0][0];
    $fullArray = ["dates" => $dates, "productStocks" => $productStocks, "seuil" => array_fill(0, count($productStocks), $seuil), "bilan" => $bilan];
    echo json_encode($fullArray);
}

