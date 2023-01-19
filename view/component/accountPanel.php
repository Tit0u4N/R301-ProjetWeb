<?php
    $emailView = "Bob@b.fr";
    $surnameView = "Le Crampon";
    $nameView = "Bob";
?>
<section id="account" class="default-panel hide">
    <h2>Compte :</h2>
    <form action="" method="post">
        <div>
            <label for="emailSubcribe">Email :</label>
            <input name="emailSubcribe" type="email" placeholder="lelouch@code-geass.fr" value="<?= $emailView ?>" readonly>
        </div>
        <div>
            <label for="surnameSubcribe">Nom :</label>
            <input name="surnameSubcribe" type="text" placeholder="Lamperouge" value="<?= $surnameView ?>" readonly>
        </div>
        <div>
            <label for="nameSubcribe">Prénom :</label>
            <input name="nameSubcribe" type="text" placeholder="Lelouche" value="<?= $nameView ?>" readonly>
        </div>
    </form>
    <a href="index.php?Connexion=Disconnect"></a>
</section>

