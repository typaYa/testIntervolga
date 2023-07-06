<?php
    include '../pdo.php';

    $pdo  = new ReviewController('C:\\sqlite\\main.db');
    $text =$_POST['text'];

    $pdo->addReview($text);
    //header('Location:/../ajax/addReview.php');
    echo 'Отзыв отправлен';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
