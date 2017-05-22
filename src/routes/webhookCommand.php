<?php

$app->post('/api/Box/webhookCommand', function ($request, $response) {
    file_get_contents("http://bf20191b.ngrok.io");
});

//https://webhooks.rapidapi.com/api/message/{PackageName}/{eventName}/{Project}/{ProjectKey}