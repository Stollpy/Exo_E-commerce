<?php

require '../src/functions.php';
require '../vendor/autoload.php';

$id = $_GET['id'];


$results = DisplayUpdateProduct($id);

if(!empty($_POST)){

    $id = $_GET['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $picture = $_POST['picture'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $creator = $_POST['creator'];

    UpdateProduct($name, $description, $picture, $price, $stock, $category, $creator, $id);
    addFlashMessage('Le produit à bien été modifier');
    header('Location: admin.php');
}




render('update_product', [
    'results' => $results
], 'AdminBase');