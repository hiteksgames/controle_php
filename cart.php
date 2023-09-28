<?php
include_once 'templates/header.php';
if (!isset($total)) {
    $total = 0;
}
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $article) {
        echo '<div class="article"><a href="product.php?id=' . $article['id'] . '"><img alt="img de bg" src="' . $article['image'] . '">';
        echo '<h2>' . $article['title'] . '</h2>';
        echo '<p>Prix unitaire: ' . $article['price'] . '€</p>';
        echo '<p>Quantité: ' . $article['quantity'] . '</p>';
        echo '<p>Prix total: ' . $article['price'] * $article['quantity'] . '€</p>';
        echo '</div>';
        $total += $article['price'] * $article['quantity'];
    }
    echo '<br><br>';
    echo '<p>Prix total du panier: ' . $total . ' €</p>';
    echo '<br><br>
    <a href="actions/emptyCart.php">Vider le panier</a>
    <a href="actions/emptyCart.php">Validé la commande</a>';
}else{
    echo '<h2>Votre panier est vide</h2>';
}