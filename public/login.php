<?php
 
 require '../vendor/autoload.php';
 require '../src/functions.php';

 session_start();

$error = null;
if(!empty($_POST)){

    $email = $_POST['email'];
    $password = hash(sha256, $_POST['password']);

    $error = validateLoginForm($email, $password);

    if(empty($error)){


        $result = authentificate($email, $password);

        if(is_array($result)){
         
            userSessionRegister(
                $result['id'],
                 $result['firstname'],
                 $result['lastname'],
                $result['email'], 
                $result['role']
            );
          
            addFlashMessage('Vous êtes connecter '.$result['firstname'].' !');
            header('Location: index.php');
            exit;

        }else{

            // $flashMessages = addFlashMessage('Votre E-mail ou mot de passe est incorrect');
        }
    }
}


 $pageTitle = "Connexion";


render('login', [
    'pageTitle' => $pageTitle,
    // 'flashMessages' => $flashMessages
    ]);