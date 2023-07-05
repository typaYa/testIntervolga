<?php
require '../pdo.php';
$reviewController= new ReviewController("C:\\sqlite\\main.db");

$num = $_SERVER['REQUEST_URI'];
$key = strrchr($num,'/');
$key = substr($key,1);
echo $key;
$perPage = 20;
print_r($reviewController->getReviewsByPage($key,20));
