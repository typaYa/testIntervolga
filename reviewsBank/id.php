<?php
require 'pdo.php';
$reviewController= new ReviewController("C:\\sqlite\\main.db");

print_r($reviewController->getReviewById(2));