<?php
session_start();
require_once '../functions/bdd.php';

// Vérifie si un article doit être ajouté au panier
if(isset($_GET['add'])) {
    $articleId = $_GET['add'];

    // Obtient les détails de l'article à partir de votre base de données
    $article = fetchArticles($articleId);

    if (!$article) {
        // L'article n'existe pas, redirigez vers la page du panier ou affichez un message d'erreur
        header('Location: ../cart.php');
        exit;
    } else {
        // Initialisez le panier s'il n'existe pas encore dans la session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Vérifie si l'article est déjà dans le panier
        $itemIndex = -1;
        foreach ($_SESSION['cart'] as $index => $cartItem) {
            if ($cartItem['id'] == $articleId) {
                $itemIndex = $index;
                break;
            }
        }

        if ($itemIndex !== -1) {
            // L'article est déjà dans le panier, augmentez la quantité
            $_SESSION['cart'][$itemIndex]['quantity'] += $_GET['quantity'];
        } else {
            // Ajoutez l'article au panier avec une quantité initiale de 1
            $_SESSION['cart'][] = [
                'id' => $article[0]['id'],
                'title' => $article[0]['title'],
                'desc' => $article[0]['description'],
                'price' => $article[0]['price'],
                'platform' => $article[0]['platform'],
                'released_at' => $article[0]['released_at'],
                'image' => $article[0]['image'],
                'quantity' => 1
            ];
        }

        // Redirigez vers la page du panier
        header('Location: ../cart.php');
        exit;
    }
}