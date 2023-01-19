<?php
    $emailView = $_SESSION["emailMangaFlow"];
    $surnameView = "";
    $nameView = "";
    if(!$_SESSION['webmaster']){
        $pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');
        $user = $pdo->query("SELECT c.nom,c.prenom FROM CLIENT c WHERE c.idClient = ".$_SESSION['userId'])->fetchAll()[0];
        $surnameView = $user[0];
        $nameView = $user[1];
    }
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

