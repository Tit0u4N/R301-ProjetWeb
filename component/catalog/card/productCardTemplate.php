<?php

// Définition des variables
//    $title = "Code Geass - Lelouch of the Rebellion";
//    $img = "https://www.nautiljon.com/images/manga/00/50/berserk_205.webp?1659201541";
//    $vol = "Vol. 1";
//    $price = "6.50€";
//    $id = 1;


$alt = "Cover de " . $title . " " . $vol;
//$title = str_replace(" ","&nbsp;",$title);
$lengthTitle = ceil(strlen($title) / 2);
$title = explode(" ",$title);
$tabSplitTitle = [];
$cpt = 0;
foreach($title as $elm){
    $cpt += strlen($elm);
    array_push($tabSplitTitle,$cpt);
}
//print_r($tabSplitTitle);
//print_r($title);
$i = 0;
$temp = "<span>";
//echo $lengthTitle;
while ($tabSplitTitle[$i] < ($lengthTitle)){
    $temp .= $title[$i]."&nbsp;";
    $i++;
} 
$temp .= "</span><br><span>";
//echo "<br>".$i;
//echo "<br>".count($title);
for($j = $i ; $j < count($title) ; $j++){
    $temp .= $title[$j]."&nbsp;";
}
$title = null;
$title .= $temp . "</span>"
//foreach($title as $elm){
//    $temp .= "<span>" . $elm . "&nbsp;</span>";
//}
//

?>

<article class="productCard" onclick="openPanel('<?= $id ?>')">
    <img src=<?= $img ?> alt="<?= $alt ?>">
    <div class="productTitle">
        <h3><?= $title ?></h3>
        <h4 class="vol"><?= $vol ?></h4>
    </div>
    <hr class="divider">
    <div class="priceContainer">
        <h4><?= $price ?></h4>
        <button>
            <img src="../../../ressources/icons/basket.svg">
        </button>
    </div>
</article>