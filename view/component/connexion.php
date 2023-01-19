<?php
function errorPrintLogin()
{
    if (isset($_POST['errorLogin'])) {
        if ($_POST['errorLogin']) {
            ?>
            <div>
                <span>Adresse e-mail ou le mot de passe est incorrect.</span>
            </div>
            <?php
        }
    }
}

?>


<div>
    <div id="switchConnexion" onclick="toggleConnexion()">
        <div>
            <h2>CONNEXION</h2>
            <h2>INSCRIPTION</h2>
        </div>
        <rect>&nbsp;</rect>
    </div>
    <section id="connexionContainer">
        <h3>Replonger dans le FLOW ? </h3>
        <form action="index.php" method="post">
            <div>
                <label for="emailMangaFlow">Email :</label>
                <input name="emailMangaFlow" type="email" placeholder="lelouch@code-geass.fr">
            </div>
            <div>
                <label for="passwordMangaFlow">Mot de passe :</label>
                <input name="passwordMangaFlow" type="password" placeholder="**************">
            </div>
            <?= errorPrintLogin() ?>
            <div class="submitContainer">
                <button name="submitConnexion" value="Connexion" type="submit"><span>Connexion</span></button>
                <label for="submit">Mot de passe oublié ?</label>
            </div>
        </form>
    </section>
    <section id="susbribeContainer" class="hide">
        <h3>Rejoinre le flow</h3>
        <form action="index.php" method="post">
            <div>
                <label for="emailSubcribe">Email :</label>
                <input name="emailSubcribe" type="email" placeholder="lelouch@code-geass.fr" required>
            </div>
            <div>
                <label for="surnameSubcribe">Nom :</label>
                <input name="surnameSubcribe" type="text" placeholder="Lamperouge" required>
            </div>
            <div>
                <label for="nameSubcribe">Prénom :</label>
                <input name="nameSubcribe" type="text" placeholder="Lelouche" required>
            </div>
            <div>
                <label for="passwordConnexion">Mot de passe :</label>
                <input name="passwordConnexion" type="password" placeholder="**************" required>
            </div>
            <div>
                <label for="passwordConnexionConfirmation">Confirmation :</label>
                <input name="passwordConnexionConfirmation" type="password" placeholder="**************" required>
            </div>
            <div class="submitContainer">
                <button name="submitSubcribe" value="Inscritpion" type="submit"><span>Inscritpion</span></button>
            </div>
        </form>
    </section>
</div>