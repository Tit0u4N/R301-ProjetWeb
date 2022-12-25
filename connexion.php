<?php 

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/styleConnexion.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>MangaFlow | Connexion</title>
</head>
<body>
    <?php
        $fullNavBar = False;
        require "component/navBar/navbar.php"
    ?>

    <main>

        <section>
            <div>
                <h2>CONNEXION</h2>
                <h2>INSCRIPTION</h2>
            </div>
            <rect></rect>
        </section>
        <section id="connexionContainer">
            <h3></h3>
            <form action="">
                <label for="emailConnexion">Email :</label>
                <input name="emailConnexion" type="email" placeholder="lelouch@code-geass.fr">
                <label for="passwordConnexion">Mot de passe :</label>
                <input name="passwordConnexion" type="password" placeholder="**************">
                <input name="submitConnexion" value="Connexion" type="submit">
                <label for="submitConnexion">Mot de passe oublié ?</label>
            </form>
        </section>
        <section id="susbribeContainer">
            <h3>Rejoinre le flow</h3>
            <form action="">
                <label for="emailSubcribe">Email :</label>
                <input name="emailSubcribe" type="email" placeholder="lelouch@code-geass.fr">
                <label for="surnameSubcribe">Nom :</label>
                <input name="surnameSubcribe" type="text" placeholder="Monkey D">
                <label for="nameSubcribe">Prénom :</label>
                <input name="nameSubcribe" type="text" placeholder="Luffy">

                <label for="passwordConnexion">Mot de passe :</label>
                <input name="passwordConnexion" type="password" placeholder="**************">
                <label for="passwordConnexion">Confirmation :</label>
                <input name="passwordConnexion" type="password" placeholder="**************">
                <input name="submitConnexion" value="Inscritpion" type="submit">
            </form>
        </section>
    </main>
</body>
</html>