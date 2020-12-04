<?php

    require '../src/functions.php';
    
        $id = $_GET['id'];

        DeleteProductById($id);

        addFlashMessage('Le produit à bien été supprimé');

        header('Location: admin.php');
        exit;