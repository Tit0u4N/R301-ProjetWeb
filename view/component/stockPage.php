<?php
$pdo = new PDO('mysql:host=localhost;dbname=db', 'webmaster', 'phpWebMaster22!');
$products = $pdo->query("SELECT p.titreTome,p.idProduit FROM PRODUIT p")->fetchAll();
$options = array(array("s","s"));

$options = array();
foreach ($products as $product){
    $prod = array($product[0],$product[1]);
    array_push($options,$prod);
}
?>


<section>
    <h2>Stocks :</h2>
    <div id="formStock">

        <select name="product" required>
            <?php
            $first = true;
            foreach ($options as $option)
                if ($first) {
                    echo '<option value="' . $option[1] . '">' . $option[0] . '</option selected>';
                    $first = false;
                } else {
                    echo '<option value="' . $option[1] . '">' . $option[0] . '</option>';
                }
            ?>
        </select>

        <input type="date" name="startDate" required>
        <span>-></span>
        <input type="date" name="endDate" required>


        <button onclick="getDataStock()">OK</button>
    </div>

    <canvas id="ChartStock"></canvas>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

