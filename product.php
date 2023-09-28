<?php
include_once 'templates/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}else{
    $article = fetchArticles($_GET['id']);
    if (!$article) {
        header('Location: index.php');
        exit;
    }else{
        echo '<br>';
        echo '<div class="article" style="margin-top: 50px;">';
        echo '<img src="' . $article[0]['image'] . '">';
        echo '<h2>' . $article[0]['title'] . '</h2>';
        echo '<p>' . $article[0]['description'] . '</p>';
        echo '<p> jouable sur ' . $article[0]['platform'] . '</p>';
        echo '<p> sortie le ' . $article[0]['released_at'] . '</p>';
        echo '<p>Prix: ' . $article[0]['price'] . '</p>';
        echo '<form action="actions/addToCart.php" method="get">
        <input type="number" name="quantity" value="1">
        <input type="hidden" name="add" value="' . $article[0]['id'] . '">
        <input type="submit" value="Ajouter au panier">';
        echo '</div>';
        if ($_SESSION['user']['admin']){
            echo '<a href="actions/deleteArticle.php?id=' . $article[0]['id'] . '">Supprimer l\'article</a>';
        }
    }
}