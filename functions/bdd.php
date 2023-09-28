<?php
function connectToDB(): PDO
{
    try {
        $host = '127.0.0.1';
        $db = 'phpdemo';
        $username = 'root';
        $password = '';

        $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$sql = "SELECT * FROM articles";
        //$stmt = $pdo->query($sql);
        //$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //echo '<pre>';
        //var_dump($articles);
        //echo '</pre>';

        return $pdo;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function fetchAllArticles(): array
{
    $sql = "SELECT * FROM product";
    $pdo = connectToDB();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $articles;
}

function fetchArticles(int $id): array
{
    $sql = "SELECT * FROM product WHERE id = :id";
    $pdo = connectToDB();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $articles;
}

function deleteArticle(int $id): array
{
    $sql = "DELETE FROM product WHERE id = :id ";
    $pdo = connectToDB();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param string $title
 * @param string $description
 * @param string $platform
 * @param string $image
 * @param string $released_at
 * @param float $price
 * @return array
 */
function createArticle(string $title, float $price, string $description = "un jeux", string $platform = "teste et on verra bien", string $image = "none.png", string $released_at = "1969-12-11 05:00:00")
{
    $sql = "INSERT INTO product (title, description, platform, image, released_at, price) VALUES (:title, :description, :platform, :image, :released_at, :price)";
    $pdo = connectToDB();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':platform', $platform);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':released_at', $released_at);
    $stmt->bindParam(':price', $price);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addUser(string $username, string $password, int $is_admin = 0): ?array
{
    $date = date(format: "Y-m-d H:i:s");
    $pdo = connectToDB();
    $sql = "SELECT * FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return null;
    }
    $password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO user (username, password, created_at, isAdmin) VALUES (:username, :password, :created_at, :isAdmin)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':created_at', $date);
    $stmt->bindParam(':isAdmin', $is_admin);
    $stmt->execute();
    $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function checkUser(string $username, string $password): ?array
{
    $sql = "SELECT * FROM user WHERE username = :username";
    $pdo = connectToDB();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($user);
    if ($user && password_verify($password, $user['password'])) {
        // Mot de passe vérifié
        //$_SESSION['user']['id'] = $user['id'];
        //echo 'ça marche';
        return $user;
    } else {
        return null; // Aucun utilisateur trouvé ou mot de passe incorrect
    }
}