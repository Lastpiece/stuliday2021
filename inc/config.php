<?php
try{
    $connect = new PDO("mysql:host=localhost; dbname=stuliday", 'root','');
    $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
    if(empty($_SESSION['token'] = bin2hex(random_bytes(32)))){
        $_SESSION['token'] = bin2hex(random_bytes(32));    
    }
    $token = $_SESSION['token'];

} catch(PDOException $error){
    echo 'Erreur: '.$error->getMessage();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
}

if(empty($_SESSION['id']) && (!isset($page) || $page != "Homepage" && $page != "Products" && $page != "Login" && $page != "Sign in")){
    header('Location::login.php');
}