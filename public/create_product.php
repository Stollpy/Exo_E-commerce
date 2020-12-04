<?php

require '../src/functions.php';

if(!empty($_POST)){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $picture = $_POST['picture'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $creator = $_POST['creator'];

    insertProduct($name, $description, $picture, $price, $stock, $category, $creator);
    addFlashMessage('Le produit à bien été supprimé');
    header('Location: admin.php');

}


render('create_product', [], 'AdminBase');

