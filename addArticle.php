<?php
include_once 'templates/header.php';

if ($_SESSION['user']['admin'] != 1) {
    header('Location: index.php');
} else {
    ?>
    <form action="actions/addArticle.php" method="get">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title">

        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>

        <label for="price">Prix</label>
        <input type="number" name="price" id="price">

        <label for="image">Image</label>
        <input type="text" name="image" id="image">

        <label for="platform">Plateforme</label>
        <input type="text" name="platform" id="platform">

        <label for="release_date">Date de sortie</label>
        <input type="date"  name="release_date" id="release_date">

        <input type="submit" value="Ajouter">
    </form>
    <?php
}