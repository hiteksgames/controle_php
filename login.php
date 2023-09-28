<?php

if (isset($_SESSION['user']['id'])) {
    header('Location: index.php');
    exit;
}else{
    ?>
    <form action="actions/login.php" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Login">
    </form>
    pour vous inscrire <a href="register.php">cliquez ici</a>
<?php
}