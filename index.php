<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response as ps7;
use Slim\Psr7\Request as ps77;


require __DIR__ . '/vendor/autoload.php';
require 'pdo.php';

$app = AppFactory::create();


$reviewController= new ReviewController("C:\\sqlite\\main.db");
$validUsers = [
    'user1'=>'password1'
];

// Middleware для BASIC-аутентификации






$basicAuthMiddleware = function (Request $request, RequestHandlerInterface $handler) use ($validUsers) {
    $response = new ps7();

// Проверяем наличие заголовка Authorization в запросе
    $authHeader = $request->getHeaderLine('Authorization');
    if (empty($authHeader) || !preg_match('/Basic (.+)/', $authHeader, $matches)) {
        $response->getBody()->write('Authorization required');
        return $response->withStatus(401)->withHeader('WWW-Authenticate', 'Basic realm="My Realm"');
    }

// Декодируем имя пользователя и пароль из заголовка Authorization
    list($username, $password) = explode(':', base64_decode($matches[1]));

// Проверяем соответствие учетных данных
    if (!isset($validUsers[$username]) || $validUsers[$username] !== $password) {
        $response->getBody()->write('Invalid credentials');
        return $response->withStatus(403);
    }

// Пользователь аутентифицирован, передаем запрос обработчику маршрута
    return $handler->handle($request);
};

// Применение middleware BASIC-аутентификации ко всем маршрутам

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Hello World!');
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

$app->get('/showReview',function (Request $request, Response $response) use ($reviewController){
    $text = 'qweqwe';
    $result = $reviewController->addReview($text);

    if(isset($result['error'])){
        $response->getBody()->write("Что-то не так");
    }
    else{$response->getBody()->write("Добавлено");}

    return $response;
});

/*$app->get('/reviewsDelete/{id}', function (ps77 $request, ps7 $response, $args) use ($reviewController) {
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
});*/
$app->group('/reviewsDelete', function ($group) use ($reviewController, $basicAuthMiddleware) {
    $group->get('/{id}', function (Request $request, Response $response, $args) use ($reviewController) {
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
})->add($basicAuthMiddleware);
$app->run();

