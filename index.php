<?php
require_once('config.php');
//var_dump($_POST);



$stmt = $pdo->query("SELECT * FROM massages ORDER BY created_at DESC");
$massages = $stmt->fetchall(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel=stylesheet href = style.css>
</head>


<body>
    <div class="container">
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
                    <div class = "name">
                         <?= htmlspecialchars($msg['name']) ?> 
                    </div>
                    <div>
                        <?= htmlspecialchars($msg['massage']) ?>
                    </div>
                    <div class="date">
                        <?= $msg['created_at'] ?>
                    </div>
                        <a href="delete.php?id=<?= $msg['id'] ?>" 
                            class="message_delete"
                            onclick="return confirm('Вы уверены, что хотите удалить это сообщение? <?= $msg['name']?>')">
                            Удалить
                        </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>.
    </div>
</body>
</html>