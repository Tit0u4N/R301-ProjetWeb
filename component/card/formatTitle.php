<?php
$lengthTitle = strlen($title);
$title = str_replace("-", "&#8209;", $title);

if ($lengthTitle > 25) {
    $lengthTitle = ceil($lengthTitle / 2);
    $title = explode(" ", $title);
    $tabSplitTitle = [];
    $cpt = 0;
    foreach ($title as $elm) {
        $cpt += strlen($elm);
        array_push($tabSplitTitle, $cpt);
    }

    $i = 0;
    $temp = "<span>";
    if ($tabSplitTitle[0] >= $lengthTitle)
        $temp .= $title[0];
    while ($tabSplitTitle[$i] < ($lengthTitle)) {
        $temp .= $title[$i] . "&nbsp;";
        $i++;
    }
    $temp .= "</span><br><span>";

    for ($j = $i; $j < count($title); $j++) {
        $temp .= $title[$j] . "&nbsp;";
    }
    $title = null;
    $title .= $temp . "</span>";
} else {
    $title = str_replace(" ","&nbsp;", $title);
    $title = str_replace("-", "&#8209;", $title);
    $title = "<span>" . $title . "</span>";
}

?>