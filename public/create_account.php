<?php
 
 require '../src/functions.php';


$pageTitle = "Créer un compte";

$flashMessages = FecthAllFlashMessages();

render('create_account', [
    'pageTitle' => $pageTitle,
    'flashMessages' => $flashMessages
]);