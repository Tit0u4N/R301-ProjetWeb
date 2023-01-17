<?php
    function mailUsed(PDO $pdo,String $email){
        $user = $pdo->query("SELECT cl.idClient FROM CLIENT cl WHERE cl.adresseMail = '".$email."'")->fetchAll();
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
        $check = preg_match("/(%|\\)+/",$string) == 0;
        return !$check;
    }


    function addUser(PDO $pdo,String $email, String $name, String $surname, String $password){
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        $pdo->query("INSERT INTO COMPTE(identifiant,motDePasse) VALUES('".$email."','".$hashPassword."')");
        $id = $pdo->query("SELECT c.idCompte FROM COMPTE c WHERE c.identifiant = '".$email."'")->fetchAll()[0][0];

        
        $pdo->query("INSERT INTO CLIENT(idClient,adresseMail,nom,prenom) VALUES('".$id."','".$email."','".$surname."','".$name."')");


    }

    


    $errorEmailAlreadyUsed = false;
    $errorEmailSyntax = false;
    $errorSurnameSyntax = false;
    $errorNameSyntax = false;
    $errorPasswordStrength = false;
    $errorPasswordSyntax = false;
    $errorPasswordConfirmation = false;

 

    $email= $_POST["emailSubcribe"];
    $surname = $_POST["surnameSubcribe"];
    $name = $_POST["nameSubcribe"];
    $password = $_POST["passwordConnexion"];
    $passwordConfirmation = $_POST["passwordConnexionConfirmation"];
    /*
    if(!checkPasswordStrengh($password)){
        $errorPasswordStrength = true;
    }
    else*/
    if(checkSyntax($email)){
        $errorEmailSyntax = true;
    }
    else if(checkSyntax($surname)){
        $errorSurnameSyntax = true;
    }
    else if(checkSyntax($name)){
        $errorNameSyntax = true;
    }
    else if(checkSyntax($password)){
        $errorPasswordSyntax = true;
    }
    else if(!checkPassword($password,$passwordConfirmation)){
        $errorPasswordConfirmation = true;
    } 
    else{
        $pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');
        if(mailUsed($pdo,$email)){
            $errorEmailAlreadyUsed = true;
        }
        else{
            addUser($pdo,$email,$name,$surname,$password);
        }
    }
                    
                
            
       








