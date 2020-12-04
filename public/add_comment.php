<?php 


// Inclusion des dépendances
require '../vendor/autoload.php';
require '../src/functions.php';



 // Récupérer les données du formulaire
 $content = $_POST['content'];
 $productId = $_POST['product-id'];

// Insertion du commentaire dans la table comments
insertComment($content, $productId);

// création d'un message falsh
addFlashMessage('Votre commentraire à bien été enregistrer !');


// Redirection vers la page du produit
header('Location: product.php?id=' . $productId);
exit;