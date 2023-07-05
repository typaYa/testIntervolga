<?php

class BasicAuth
{
    private $users = [
        'user1' => 'password1',
        'user2' => 'password2',
        // и т.д.
    ];
    public function __invoke($request, $response, $next) {
        $username = $request->getServerParam('PHP_AUTH_USER');
        $password = $request->getServerParam('PHP_AUTH_PW');

        // Проверяем имя пользователя и пароль
        if (!isset($this->users[$username]) || $this->users[$username] !== $password) {
            return $response->withStatus(401)->withHeader('WWW-Authenticate', 'Basic realm="My Realm"');
        }

        // Продолжаем выполнение следующего Middleware или контроллера
        $response = $next($request, $response);

        return $response;
    }

}