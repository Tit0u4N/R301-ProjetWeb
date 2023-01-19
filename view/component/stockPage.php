<?php
$options = ["MHA Tome 1", "Made in Abyss tome 2", "One piece Tome 3"]
?>


<section>
    <h2>Stocks :</h2>
    <article>
        <p>
            Graphique des stocks par tome, sélectionner :
        </p>
        <ul>
            <li>Tome de voulu</li>
            <li>Date de debut (facultatif)</li>
            <li>Date de fin (facultatif)</li>
        </ul>
    </article>


    <div id="formStock">

        <select name="product" required>
            <?php
            $first = true;
            foreach ($options as $option)
                if ($first) {
                    echo '<option value="' . $option . '">' . $option . '</option selected>';
                    $first = false;
                } else {
                    echo '<option value="' . $option . '">' . $option . '</option>';
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

