<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require 'pdo.php';

$app = AppFactory::create();
$app->addErrorMiddleware(false, true, true);

$reviewController= new ReviewController("C:\\sqlite\\main.db");

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});


$app->get('/api/feedbacks/{id}', function (Request $request, Response $response, $args) use ($reviewController) {
    $id = $args['id'];

    // Вызываем метод getReviewById() из ReviewController
    $review = $reviewController->getReviewById($id);

    // Отображаем результат в формате JSON
    $response->getBody()->write(json_encode($review));
    return $response;
});

$app->get('/review/{page}', function (Request $request, Response $response, $args) use ($reviewController) {
    $page = $args['page']; // Получаем значение {page} из URL
    $perPage = 20;

    $reviews = $reviewController->getReviewsByPage($page, $perPage);
    //print_r($reviews);

    $response->getBody()->write(json_encode($reviews));
    return $response;

});

$app->get('/reviewsDelete/{id}', function (Request $request, Response $response, $args) use ($reviewController) {
    $id = $args['id'];
    $result = $reviewController->deleteReviewById($id);
    if ($result > 0) {
        // Запись успешно удалена
        $response->getBody()->write("Успешно");
        return $response;
    } else {
        $response->getBody()->write("Запись с таким id не найдена");
        return $response;
    }
});

$app->run();

