<?php

$app->post('/api/Box/webhookCommand', function ($request, $response) {
    $result = ["text"=>"done"];
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});
