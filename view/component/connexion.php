<?php
function errorPrintLogin(){
    if(isset($_POST['errorLogin'])){
        if($_POST['errorLogin']){
            ?>
            <div>
                <span>Adresse e-mail ou le mot de passe est incorrect.</span>
            </div>
            <?php
        }
    }
}

function errorPwConfirmPrintRegister(bool $error){
    if($error){
        ?>
        <div>
            <span>Les mot de passes doivent correspondre!</span>
        </div>
        <?php
    }
}

function isHide($element){
    if($element == "suscribe"){
        if(!($_GET["method"] == "register")){
            echo 'class="hide"';
        }
    }
    else{
        if($_GET["method"] == "register"){
            echo 'class="hide"';
        }
    }
}

if(!isset($errorPasswordConfirmation)){
    $errorPasswordConfirmation = false;
}
?>



<div id="switchConnexion" onclick="toggleConnexion()" <?= isHide("switch")?>>
    <div>
        <h2>CONNEXION</h2>
        <h2>INSCRIPTION</h2>
    </div>
    <rect>&nbsp;</rect>
</div>
<section id="connexionContainer" <?= isHide("connexion")?>>
    <h3>Replonger dans le FLOW ? </h3>
    <form action="index.php?Connexion&method=login" method="post">
        <div>
            <label for="emailMangaFlow">Email :</label>
            <input name="emailMangaFlow" type="email" placeholder="lelouch@code-geass.fr">
        </div>
        <div>
            <label for="passwordMangaFlow">Mot de passe :</label>
            <input name="passwordMangaFlow" type="password" placeholder="**************">
        </div>
        <?= errorPrintLogin()?>
        <div class="submitContainer">
            <button name="submitConnexion" value="Connexion" type="submit"><span>Connexion</span></button>
            <label for="submit">Mot de passe oublié ?</label>
        </div>
    </form>
</section>
<section id="suscribeContainer" <?= isHide("suscribe")?>>
    <h3>Rejoinre le flow</h3>
    <form action="index.php?Connexion&method=register" method="post">
        <div>
            <label for="emailSubcribe">Email :</label>
            <input name="emailSubcribe" type="email" placeholder="lelouch@code-geass.fr" required>
        </div>
        <div>
            <label for="surnameSubcribe">Nom :</label>
            <input name="surnameSubcribe" type="text" placeholder="Lamperouge" required pattern="[^']*" title= "gnegne">
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
            <?= errorPwConfirmPrintRegister($errorPasswordConfirmation)?>
        </div>
        <div class="submitContainer">
            <button name="submitSubcribe" value="Inscritpion" type="submit"><span>Inscritpion</span></button>
        </div>
    </form>
</section>
