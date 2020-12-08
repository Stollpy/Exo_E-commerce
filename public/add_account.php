<?php

require '../src/functions.php';

if(!empty($_POST)){

    // récupération des info form
    $Last_Name = $_POST['lastname'];
    $First_Name = $_POST['firstname'];
    $email = $_POST['email'];
    $password = hash(sha256, $_POST['password']);

     $error = ValidEmail($email, $password);

    if($error === null){
        // insertion user dans la BDD
        insertUser($Last_Name, $First_Name, $email, $password, ROLE_USER);


        // création d'un message falsh
        addFlashMessage('Votre compte à bien été créer !');


        // Redirection vers la page du produit
        header('Location: index.php');
        exit;
    }
    if($error !== null)
    {
        addFlashMessage('Votre e-mail n\'est sois pas valide sois déjà utilisé !');

        header('Location: create_account.php');
        exit;
    }
} 
