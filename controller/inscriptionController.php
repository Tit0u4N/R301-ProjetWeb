<?php
    function mailUsed(PDO $pdo,String $email){
        $user = $pdo->query("SELECT cl.idClient FROM CLIENT cl WHERE cl.adresseMail = '".$user."'")->fetchAll();
        return !empty($user);
    }

    function checkPassword(String $password,String $passwordConfirmation){
        return $password == $passwordConfirmation;
    }

    function checkPasswordStrengh(String $password){
        $check = strlen($password) > 8;
        $check = $check && (preg_match("/[a-z]+/",$password) == 1);
        $check = $check && preg_match("/[A-Z]+/",$password);
        $check = $check && preg_match("/[0-9]+/",$password);
        $check = $check && preg_match("/\W+/",$password);
        return $check;
    }

    function checkSyntax(String $string){
        $check = preg_match("/(\"|\'|\\)+/",$check) == 0;
        return $check;
    }

    




    //$pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');
    if(isset($_POST["passwordConnexion"])){

        $test1 = $_POST["passwordConnexion"];
        //$test3 = preg_match("/[a-z]+/","asdadsDFG1523");
        $test2 = checkPasswordStrengh($_POST["passwordConnexion"]);
        $test1 = $_POST["passwordConnexion"];
    }

    $password = $_POST["passwordConnexion"];
    if(!checkPasswordStrengh($password)){
        $errorPasswordStrength = true;
    }
    else{
    }






