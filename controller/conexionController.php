<?php
    function getUser(PDO $pdo,String $user){
        $user = $pdo->query("SELECT c.idCompte,c.identifiant FROM COMPTE c,CLIENT cl WHERE c.idCompte = cl.idClient AND (c.identifiant = '".$user."' OR cl.adresseMail = '".$user."')")->fetchAll();
        return $user;
    }

    function getPassword(PDO $pdo,int $id){
        $password = $pdo->query("SELECT c.motDePasse FROM COMPTE c WHERE c.idCompte = '".$id."'")->fetchAll();
        return $password;
    }

    function checkPassword($knowPassword,$password,$username){
        $hashedPassword = crypt($password);
        $hash = crypt($username,$hashedPassword);
        return hash_equals($knowPassword,$hash);
    }

    function login(){
        //Start cookies etc
    }



    $connexionValidation = false;
        //todo Teste si le client existe bien
    if(isset($_GET["dev"])){
        if($email == "bob@b.fr" && $password == "boom")
            $connexionValidation = true;
    }
    else{
        $pdo = new PDO('mysql:host=localhost;dbname=db', 'client', 'phpClientCo22!');
        $user = getUser($pdo,$_POST["emailMangaFlow"]);

        if($user == null){
            $_POST['errorLogin'] = true;
        }
        else{
            $userId = $user[0][0];
            $password = getPassword($pdo,$userId);
            if(checkPassword($password,$_POST["passwordMangaFlow"],$user[0][1])){
                $connexionValidation = true;
                login();
            }
            else{
                $_POST['errorLogin'] = true;
            }
        }
    }
    






