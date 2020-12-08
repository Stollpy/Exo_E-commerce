<?php

require '../src/functions.php';
require '../vendor/autoload.php';


if(!empty($_POST)){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $picture = $_POST['picture'];
    $price = str_replace(',', '.', $_POST['price']);
    $stock = $_POST['stock'];
    $category = intval($_POST['category']);
    $creator = intval($_POST['creator']);
    $productId = intval($_POST['id']);

    UpdateProduct($name, $description, $picture, $price, $stock, $category, $creator, $productId);
    addFlashMessage('Le produit à bien été modifier');
    header('Location: admin.php');
}

$id = $_GET['id'] ?? $productId;


$results = DisplayUpdateProduct($id);



render('update_product', [
    'results' => $results
], 'AdminBase');