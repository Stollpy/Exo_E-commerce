<?php
    require '../src/functions.php';

    $products = getAllProducts();

    $flashMessages = FecthAllFlashMessages();

render('admin', [
    'products' => $products,
    'flashMessages' => $flashMessages
], 'AdminBase');