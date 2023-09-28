<?php
session_start();
require_once '../functions/bdd.php';

if ($_SESSION['user']['admin'] != 1) {
    header('Location: index.php');
} else {
    if (isset($_GET['title'], $_GET['price'])) {
        $title = $_GET['title'];
        $price = $_GET['price'];
        if (isset($_GET['description'])) {
            $description = $_GET['description'];
        } else {
            $description = '';
        }
        if (isset($_GET['image'])) {
            $image = $_GET['image'];
        } else {
            $image = '';
        }
        if (isset($_GET['platform'])) {
            $platform = $_GET['platform'];
        } else {
            $platform = '';
        }
        if (isset($_GET['release_date']) && $_GET['release_date'] != '') {
            $release_date = $_GET['release_date'];
        } else {
            $release_date = date(format: "Y-m-d H:i:s");
        }
        createArticle($title, $price, $_GET['description'], $_GET['platform'], $_GET['image'], $release_date);
        header('Location: ../index.php');
    }

}
