<?php
include_once 'templates/header.php';

if ($_SESSION['user']['admin'] == 1) {
    echo '<br><a href="addArticle.php">Ajouter un article</a>';
}

$articles = fetchAllArticles();

foreach ($articles as $article) {
    echo '<div class="article"><a href="product.php?id=' . $article['id'] . '"><img alt="img de bg" src="' . $article['image'] . '">';
    echo '<h2>' . $article['title'] . '</h2>';
    echo '<p>Price: ' . $article['price'] . '</p>';
    echo '</div></a>';
}
?>




</body>
</html>
