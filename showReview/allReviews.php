<?php
require '../pdo.php';
$pdo = new ReviewController('C:\\sqlite\\main.db');
$reviews = $pdo->getAllReviews();
$count = 20;
$page_count = floor(count($reviews)/$count);
$page = $_GET['page'];
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
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Текст</th>
        <th>Дата публикации</th>

    </tr>
    </thead>
    <?php for ($i=$page*$count;$i<($page+1)*$count;$i++){

    ?>
    <tbody>
    <tr>
        <td><?php echo $reviews[$i]['id']?></td>
        <td style="min-width: 600px"><?php echo $reviews[$i]['text']?></td>
        <td><?php echo $reviews[$i]['date_added']?></td>
    </tr>
    <?php }?>
    </tbody>
</table>

<?php for($i=0;$i<$page_count;$i++){
?> <a  href="?page=<?php echo $i ?>"><?php echo $i+1 ?></a>
<?php } ?>
</body>
</html>      