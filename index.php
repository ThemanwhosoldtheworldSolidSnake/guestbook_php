<?php
require_once('config.php');
var_dump($_POST);

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

$stmt = $pdo->query("SELECT * FROM massages ORDER BY created_at DESC");
$massages = $stmt->fetchall(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {font-family: Arial; margin: 40px; background: #f0f0f0;}
        .container {max-width: 600px; margin : auto; background: white; padding : 20px; boder-radius: 8px}
        .message {padding:15px; border-bottom: 1px solid #eee;}
        .name {font-weight: bold; color: #333;}
        .date {font-size: 0.8em; color: #888;}
        input, textarea {width: 100%; padding: 5px 0 15px;}
        button {padding: 10px 20px; background: #007BFF; color: white; border: none; cursor: pointer;}
        button:hover {background: #0056b3;}
        .error {color: red;}

    </style>
</head>


<body>
    <form method="POST">
        <input type = "text" name="name" placeholder = "Ваше имя" required >

        <textarea name="massage" rows = "4" placeholder = "Ваше сообщение" required></textarea>

        <button type = "sumbit">Отправить</button>
    </form>

    <hr>

    <h3>Сообщения<?= count($massages)?></h3>
    <?php if (empty($massages)): ?>
        <p>Пока нет сообщений</p>
    <?php else: ?>
        <?php foreach ($massages as $msg): ?>
            <div class = "message">
                <div class = "name"> <?= htmlspecialchars($msg['name']) ?> </div>
                 <div><?= htmlspecialchars($msg['massage']) ?></div>
                <div class="date">Шиш <?= $msg['created_at'] ?></div>
               
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>