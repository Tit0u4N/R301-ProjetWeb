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

function errorPwConfirmPrintRegister(bool $error){
    if($error){
        ?>
        <div>
            <span>Les mots de passes doivent correspondre!</span>
        </div>
        <?php
    }
}

function errorPwStrengthPrintRegister(bool $error){
    if($error){
        ?>
        <div>
            <span>Le mot de passes doit contenir au moins 8 caractère dont au moins une minuscule, une majuscule, un chiffre et un caractère spécial!</span>
        </div>
        <?php
    }
}

function errorSyntaxRegister(bool $error){
    if($error){
        ?>
        <div>
            <span>Veuillez ne pas utiliser les caractères(%,\)!</span>
        </div>
        <?php
    }
}


function errorEmailUsedRegister(bool $error){
    if($error){
        ?>
        <div>
            <span>Adresse mail déja utilisé</span>
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
if(!isset($errorPasswordStrength)){
    $errorPasswordStrength = false;
}
if(!isset($errorPasswordSyntax)){
    $errorPasswordSyntax = false;
}
if(!isset($errorEmailSyntax)){
    $errorEmailSyntax = false;
}
if(!isset($errorEmailAlreadyUsed)){
    $errorEmailAlreadyUsed = false;
}
if(!isset($errorSurnameSyntax)){
    $errorSurnameSyntax = false;
}
if(!isset($errorNameSyntax)){
    $errorNameSyntax = false;
}
?>



<div>
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
                <input name="emailMangaFlow" type="username" autocomplete ="username" placeholder="lelouch@code-geass.fr">
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
                <?= errorSyntaxRegister($errorEmailSyntax)?>
                <?= errorEmailUsedRegister($errorEmailAlreadyUsed)?>
            </div>
            <div>
                <label for="surnameSubcribe">Nom :</label>
                <input name="surnameSubcribe" type="text" placeholder="Lamperouge" required pattern="[^']*" title= "gnegne">
                <?= errorSyntaxRegister($errorSurnameSyntax)?>
            </div>
            <div>
                <label for="nameSubcribe">Prénom :</label>
                <input name="nameSubcribe" type="text" placeholder="Lelouche" required>
                <?= errorSyntaxRegister($errorNameSyntax)?>
            </div>
            <div>
                <label for="passwordConnexion">Mot de passe :</label>
                <input name="passwordConnexion" type="password" placeholder="**************" required>
            </div>
            <div>
                <label for="passwordConnexionConfirmation">Confirmation :</label>
                <input name="passwordConnexionConfirmation" type="password" placeholder="**************" required>  
                <?= errorSyntaxRegister($errorPasswordSyntax)?>
                <?= errorPwConfirmPrintRegister($errorPasswordConfirmation)?> 
                <?= errorPwStrengthPrintRegister($errorPasswordStrength)?> 
            </div>
            <div class="submitContainer">
                <button name="submitSubcribe" value="Inscritpion" type="submit"><span>Inscritpion</span></button>
            </div>
        </form>
    </section>
</div>
