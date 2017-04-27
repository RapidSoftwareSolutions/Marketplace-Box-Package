<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        
        'api_url' => 'https://api.box.com/oauth2/',
        'default_url' => 'https://api.box.com/2.0/',
        'files_url' => 'https://api.box.com/2.0/files/',
        'upload_url' => 'https://upload.box.com/api/2.0/files/',
        'folder_url' => 'https://api.box.com/2.0/folders/',
        'shared_url' => 'https://api.box.com/2.0/shared_items',
        'users_url' => 'https://api.box.com/2.0/users/',
        'invites_url' => 'https://api.box.com/2.0/invites/',
        'uploadServiceUrl' => 'http://104.198.149.144:8080/'
    ],
];


//https://account.box.com/api/oauth2/authorize?response_type=code&client_id=epw40m5ugzgvzptynixenw3mr8e9e9ry&redirect_uri=https://rapidapi.com/&state=security_token%3DKnhMJatFipTAnM0nHlZA