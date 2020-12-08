<?php

require '../src/functions.php';

if(!IsAuthentificated() || $_SESSION['user']['role'] != ROLE_ADMIN){
    echo'Vous n\'êtes pas autorisé à accéder à cette page.';
    exit;
}


        $validate = $_GET['validate'];

        

        $id = $_GET['id'];
        ValidateComment($validate, $id);
        
        if($validate){
            addFlashMessage("Le commentaire #$id à bien été validé");
        }else{
            addFlashMessage("Le commentaire #$id à bien été masqué");
        }
    
    header('Location: admin_comment.php');
    exit;