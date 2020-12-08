<?php

    require '../src/functions.php';

    if(!IsAuthentificated() || $_SESSION['user']['role'] != ROLE_ADMIN){
        echo'Vous n\'êtes pas autorisé à accéder à cette page.';
        exit;
    }
    
        $id = $_GET['id'];

        DeleteCommentById($id);

        addFlashMessage("Le commentaire #$id à bien été supprimé");

        header('Location: admin_comment.php');
        exit;