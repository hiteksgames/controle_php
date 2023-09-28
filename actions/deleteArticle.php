<?php
session_start();
require_once '../functions/bdd.php';

if(isset($_GET['id'])){
    if($_SESSION['user']['admin'] == 1) {
        deleteArticle($_GET['id']);
    }
}
header('Location: ../index.php');