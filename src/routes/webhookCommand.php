<?php

$app->post('/api/Box/webhookCommand', function ($request, $response) {

    $result['callback'] = 'success';
    $result['contextWrites']['to'] = "Hello";

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});
