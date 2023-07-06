<?php
require '../pdo.php';
$pdo = new ReviewController('C:\\sqlite\\main.db');
$comment_on_page = 20;
$count  = count($pdo->getAllReviews());
$page_count = ceil($count/$comment_on_page);
if (!isset($_POST['page'])){
    $page =1;
}else{
    $page = $_POST['page'];
}
$offset = ($page - 1) * $comment_on_page;
$reviews = $pdo->getReviewsByPage($offset,$comment_on_page);
print_r($reviews);
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
<div>
    <nav>
        <ul class="pagination">
            <li class="prev">
                <a href="">
                    <<
                </a>
            </li>
                <?php for($i=0;$i<$page_count;$i++) {
                    if ($page ==$i){
                        $class = 'class= "active"';
                    }else{
                        $class = '';
                    }

                    echo "<li $class data-id='$i'><a class='page-link' >$i</a>";
                }?>

            <li class="next">
                <a href="">
                    >>
                </a>
            </li>
        </ul>
    </nav>
</div>
</body>
</html>
