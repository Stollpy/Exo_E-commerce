<?php
    require '../src/functions.php';


    if(!IsAuthentificated() || $_SESSION['user']['role'] != ROLE_ADMIN){
        echo'Vous n\'êtes pas autorisé à accéder à cette page.';
        exit;
    }

    $products = getAllProducts();

    $flashMessages = FecthAllFlashMessages();

render('admin', [
    'products' => $products,
    'flashMessages' => $flashMessages
], 'AdminBase');