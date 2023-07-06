<?php
require '../pdo.php';
if (isset($_POST['submit'])){
    $pdo = new ReviewController('C:\\sqlite\\main.db');
    $id = $_POST['id'];
    $review = $pdo->getReviewById($id);
}


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
<style>

    .text{
        color: #656565;
        margin-top: 30px;
        flex-direction: column;
        min-width: 500px;
        outline: none;
        border: none;
        border-bottom: 1px solid black;
    }
    .submit{
        background: none;
        border: 1px solid #a2a2a2;
        margin-top: 20px;
        transition: 0.3s;
        min-width: 500px;
    }
    .submit:hover{
        background-color: #d2d1d1;
    }
    .form{
        background-color: #ffffff;
        margin:auto;

        max-width: 500px;

    }
    .table {
        margin-top: 30px;
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #dddddd;
        border-collapse: collapse;
    }
    .table th {
        font-weight: bold;
        padding: 5px;
        background: #efefef;
        border: 1px solid #dddddd;
    }
    .table td {
        border: 1px solid #dddddd;
        padding: 5px;
    }
</style>
<?php
if (isset($review)){
    ?> <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Текст</th>
            <th>Дата публикации</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $review['id']?></td>
            <td style="min-width: 600px"><?php echo $review['text']?></td>
            <td><?php echo $review['date_added']?></td>

        </tr>
        </tbody>
    </table>
<?php }?>
<form class="form" action="" method="post" >
    <p style=" margin-top: 120px;color: #656565">Поиск отзыва по Id</p>
    <input class="text" type="text" name="id" placeholder="Введите id отзыва">
    <input class="submit" type="submit" name="submit" >
</form>





</body>
</html>
