<?php
session_start();
include_once '../functions/bdd.php';
if (isset($_SESSION['user']['id'])) {
    header('Location: ../index.php');
    exit;
}elseif(!isset($_POST['username'], $_POST['password'], $_POST['passwordRepeat'])){
    header('Location: ../register.php');
    exit;
}elseif($_POST['password'] !== $_POST['passwordRepeat']) {
    header('Location: ../register.php');
    exit;
}else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = checkUser($username, $password);
    if ($user) {
        header('Location: ../register.php');
        exit;
    }else{
        $user = addUser($username, $password);
        if (!$user) {
            header('Location: ../register.php');
            exit;
        }else{
            $_SESSION['user']['id'] = $user[0]['id'];
            $_SESSION['user']['username'] = $user[0]['username'];
            $_SESSION['user']['admin'] = $user[0]['admin'];
            header('Location: ../index.php');
            exit;
        }
    }
}