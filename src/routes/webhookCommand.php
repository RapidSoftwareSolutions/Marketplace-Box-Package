<?php

$app->post('/api/Box/webhookCommand', function ($request, $response) {
    file_get_contents("http://4a1c0f62.ngrok.io/");
});

//https://webhooks.rapidapi.com/api/message/{PackageName}/{eventName}/{Project}/{ProjectKey}