<?php

$app->post('/api/Box/webhookCommand', function ($request, $response) {
    file_get_contents("https://b424cec7.ngrok.io");
});

//https://webhooks.rapidapi.com/api/message/{PackageName}/{eventName}/{Project}/{ProjectKey}