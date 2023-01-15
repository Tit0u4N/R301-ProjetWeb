<?php
    function mailUsed(PDO $pdo,String $email){
        $user = $pdo->query("SELECT cl.idClient FROM CLIENT cl WHERE cl.adresseMail = '".$user."'")->fetchAll();
        return !empty($user);
    }

    function checkPassword(String $password,String $passwordConfirmation){
        return $password == $passwordConfirmation;
    }

    function checkPasswordStrengh(String $password){
        $check = str_len($password) > 8;
        $check = $check && preg_match("/[a-z]+/",$check) == 1;
        $check = $check && preg_match("/[A-Z]+/",$check) == 1;
        $check = $check && preg_match("/[0-9]+/",$check) == 1;
        $check = $check && preg_match("/\W+/",$check) == 1;
        return true;
    }

    function checkSyntax(String $string){
        $check = $check && preg_match("/[a-z]+/",$check) == 1;
        $check = $check && preg_match("/[A-Z]+/",$check) == 1;
        $check = $check && preg_match("/[0-9]+/",$check) == 1;
        $check = $check && preg_match("/\W+/",$check) == 1;
        return true;
    }






$pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');






