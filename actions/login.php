<?php
session_start();
include_once '../functions/bdd.php';

if (isset($_SESSION['user']['id'])) {
header('Location: index.php');
exit;
}

if (!isset($_POST['username'], $_POST['password'])) {
header('Location: ../login.php');
exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$user = checkUser($username, $password);

if ($user) {
    $_SESSION['user']['id'] = $user['id'];
    $_SESSION['user']['username'] = $user['username'];
    $_SESSION['user']['admin'] = $user['isAdmin'];
    header('Location: ../index.php');
    exit;
} else {
    header('Location: ../login.php?error=1'); // Redirige avec un code d'erreur
    exit;
}