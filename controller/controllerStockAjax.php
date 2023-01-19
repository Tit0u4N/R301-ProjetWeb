<?php
//todo devMod
$_GET['dev'] = true;

//todo controller que ce spoit bien un admin

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

    //todo faire la requete SQL qui prend les donnée entre les deux dates si date < a l'apparition prendre la premiere possible


    $fullArray = ["dates" => $dates, "productStocks" => $productStocks];
    echo json_encode($fullArray);
}

