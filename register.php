<?php

if (isset($_SESSION['user']['id'])) {
    header('Location: index.php');
    exit;
}else{
    ?>
    <form action="actions/register.php" method="post">
        <label for="username">nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">mot de passe</label>
        <input type="password" name="password" id="password">
        <label for="passwordRepeat">confirmer le mot de passe</label>
        <input type="password" name="passwordRepeat" id="passwordRepeat">
        <input type="submit" value="Register">S'inscrire
    </form>
    pour vous connecter <a href="login.php">cliquez ici</a>
    <?php
}