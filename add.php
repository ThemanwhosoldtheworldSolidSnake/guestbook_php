<?php

require_once('config.php');

if ($_POST) {
    $name = trim($_POST['name']);
    $massage = trim($_POST['massage']);
    if ($name && $massage) {
        $stmt = $pdo->prepare("INSERT INTO massages (name,massage) VALUES (?, ?)");
        $stmt->execute([$name, $massage]);
        header('Location: index.php');
        exit;
    }
    else{
        $error = "Пожалуйста заполините все поля";

    }
    
}
?>