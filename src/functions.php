<?php

// Inclusion du fichier de configuration
require '../config.php';

/********************************
 **** CREATION CONNEXION PDO ****
 ********************************/
function getPDOConnection()
{
    // Construction du Data Source Name
    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;

    // Tableau d'options pour la connexion PDO
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    // Création de la connexion PDO (création d'un objet PDO)
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    $pdo->exec('SET NAMES UTF8');

    return $pdo;
}

/**
 * Prépare et exécute une requête SQL
 */
function prepareAndExecuteQuery(string $sql, array $criteria = []): PDOStatement
{
    // Connexion PDO
    $pdo = getPDOConnection();

    // Préparation de la requête SQL
    $query = $pdo->prepare($sql);

    // Exécution de la requête
    $query->execute($criteria);

    // Retour du résultat
    return $query;
}

/**
 * Exécute une requête de sélection et retourne plusieurs résultats
 */
function selectAll(string $sql, array $criteria = [])
{
    $query = prepareAndExecuteQuery($sql, $criteria);

    return $query->fetchAll();
}


/**
 * Exécute une requête de sélection et retourne UN résultat
 */
function selectOne(string $sql, array $criteria = [])
{
    $query = prepareAndExecuteQuery($sql, $criteria);

    return $query->fetch();
}

// requête de selection en column
function selectColumn(string $sql, array $criteria = [])
{
    $query = prepareAndExecuteQuery($sql, $criteria);

    return $query->fetchColumn();
}



/*********************************
 **** RECUPERATION DE PRODUIT ****
 *********************************/
function getAllProducts()
{
    $sql = 'SELECT products.id, name, price, stock, picture, label, shop_name, description
            FROM products
            INNER JOIN categories ON categories.id = products.cateroy_id
            INNER JOIN creators ON creators.id = products.creator_id';

    return selectAll($sql);
}



/***************************************************
 **** RECUPERATION DU PRODUIT EN FONCTION DE ID ****
 ***************************************************/
function getProductById(int $id)
{
    $sql = 'SELECT products.id, name, price, stock, picture, label, shop_name, description
        FROM products 
        INNER JOIN categories ON categories.id = products.cateroy_id
        INNER JOIN creators ON creators.id = products.creator_id
        WHERE products.id = ?';

    return selectOne($sql, [$id]);
}


/*********************************************
 **** INSERER / AFFICHER DES COMMENTAIRES ****
 *********************************************/


//  Insérer un commentaire 
function insertComment(string $content, int $productId)
{
    $sql = 'INSERT INTO comments (content, createdAt, product_id)
            VALUES (?, NOW(), ?)';

    prepareAndExecuteQuery($sql, [$content, $productId]);
}


// Commentaire en fonction de l'id
function getCommentsByProductId(int $productId)
{
    $sql = 'SELECT content, createdAt, product_id
            FROM comments
            WHERE product_id = ?
            ORDER BY createdAt DESC';

    return selectAll($sql, [$productId]);
}

// formatage date
function format_date($date)
{
    $objDate = new DateTime($date);
    return $objDate->format('d/m/Y');
}



/*************************************
 **** ENVOIE DU RENDU AU TEMPLATE ****
 *************************************/

function render(string $template, array $values = [], string $baseTemplate = 'base')
{
    // Extraction des variables
    extract($values);


    // Inclusion du template de base
    include '../templates/'.$baseTemplate.'.phtml';
}




/***********************************
 **** GESTION DES MESSAGE FLASH ****
************************************/

// démarre la session si aucune n'est démarer 
// Initialise un talbeau vide à la clé 'flashbag' si jamais il n'existe pas || il n'existe aucun tableau
function InitFlashBag()
{

    if(session_status() === PHP_SESSION_NONE){


        session_start();
    }

    if(!array_key_exists('flashbag', $_SESSION) || !isset($_SESSION['flashbag'])) {

        $_SESSION['flashbag'] = [];
    }

}



// Ajouter un message en session
function addFlashMessage(string $message){

    InitFlashBag();

    array_push($_SESSION['flashbag'], $message);

}



// Récuperer et retourner l'ensemble des messages flash de la session
// Pour ensuite une fois recuperer, les supprimers

function FecthAllFlashMessages() : array {

    InitFlashBag();

    
    $flashMessages = $_SESSION['flashbag'];


    $_SESSION['flashbag'] = [];


    return $flashMessages;

}

// Determiner si il y'a un message en session
function hasFlashMessage() : bool {

    InitFlashBag();

    return !empty($_SESSION['flashbag']);

}



/********************************
 **** CREATION COMPTE CLIENT ****
 ********************************/

function insertUser( string $Last_Name, string $First_Name, string $email, string $password)
{
    $sql = 'INSERT INTO user (lastname, firstname, email, password)
            VALUES (?, ?, ?, ?)';

    prepareAndExecuteQuery($sql, [$Last_Name, $First_Name, $email, $password]);
}


/********************************************
***** DETERMINE SI L ADRESS EXISTE DEJA *****
*********************************************/
function EmailExists(string $email){


    // $email = $_POST['email'];

    $sql = 'SELECT email, password, firstname, lastname, id
    FROM user
    WHERE email = ?';

    return selectOne( $sql,[$email] );

}




/*****************************************
**** VALIDATION / VERIFICATION EMAIL *****
******************************************/
function ValidEmail(string $email, string $password){

    if(!isset($_POST['email']) || empty($_POST['email'])){

        return "";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "";
    }


    if(EmailExists($email)){
        return "";
    }

    // regarde le minimun de caractère
    if(mb_strlen($password) < 8){
        return "";
    }

    return null;

}


/*******************************
 **** CONNEXION UTILISATEUR ****
********************************/


function verifyPassword(array $user, $password){
    return $user['password'] == $password;
}



function authentificate(string $email, string $password){

        $user = EmailExists($email);
        if($user){
            if(verifyPassword($user, $password)){
                return $user;
            }else{
                return 'MP';
            }
        }else{
            return 'Email incorrect';
        }
}


function validateLoginForm(string $email, string $password): array {

    $error = [];

    if(!$email){

        $error[] = 'Le champ "Email" est obligatoire.';
    }

    if(!$password){
        $error[] = 'Le champ "Mot de passe" est obligatoire.';
    }

    return $error;
}


function initSession(){
    
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
}

function userSessionRegister(int $id, string $firstname, string $lastname, string $email){
    
    initSession();
    
    $_SESSION['user'] = [
        'id' => $id,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email
    ];
}



function IsAuthentificated(): bool {

    initSession();

    return array_key_exists('user', $_SESSION) && isset($_SESSION['user']);

}


function logout(){

    if(IsAuthentificated()){

        $_SESSION['user'] = null;


        session_destroy();
    }
}



/**************************
 ***** ADMINISTRATION *****
 **************************/

function DeleteProductById(int $id)
{
    $sql = 'DELETE FROM products
        WHERE id = ?';

    return prepareAndExecuteQuery($sql, [$id]);
}