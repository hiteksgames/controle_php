<?php
session_start();
require_once 'functions/bdd.php';

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Macromania</title>
</head>
<body>

<div>
    <a href="/index.php">Accueil</a>
    <a href="/cart.php">Panier</a>
</div>

<?php
if (isset($_SESSION['user']['id'])) {
    echo 'Bonjour ' . $_SESSION['user']['username'];
    echo '<br><a href="/actions/logout.php">Déconnexion</a>';
} else {
    echo '<a href="/login.php">Connexion</a><br>';
    echo '<a href="/register.php">inscription</a>';
}

?>
