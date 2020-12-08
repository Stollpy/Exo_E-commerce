<?php
    require '../src/functions.php';


    if(!IsAuthentificated() || $_SESSION['user']['role'] != ROLE_ADMIN){
        echo'Vous n\'êtes pas autorisé à accéder à cette page.';
        exit;
    }

    $comments = GetAllComments();

    $flashMessages = FecthAllFlashMessages();

render('admin_comment', [
    'comments' => $comments,
    'flashMessages' => $flashMessages
], 'AdminBase');