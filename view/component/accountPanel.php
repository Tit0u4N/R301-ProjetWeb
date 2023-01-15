<?php
    $emailView = "Bob@b.fr";
    $surnameView = "Le Crampon";
    $nameView = "Bob";

?>
    <div id="account" class="default-panel hide">
        <h2>Compte :</h2>
        <form action="index.php" method="post">
            <div>
                <label for="emailSubcribe">Email :</label>
                <input name="emailSubcribe" type="email" placeholder="lelouch@code-geass.fr" value="<?= $emailView ?>">
            </div>
            <div>
                <label for="surnameSubcribe">Nom :</label>
                <input name="surnameSubcribe" type="text" placeholder="Lamperouge" value="<?= $surnameView ?>">
            </div>
            <div>
                <label for="nameSubcribe">Prénom :</label>
                <input name="nameSubcribe" type="text" placeholder="Lelouche" value="<?= $nameView ?>">
            </div>
    </div>

