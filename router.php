<?php

$route = str_replace('/api', '', $_SERVER["REQUEST_URI"]);

switch($route) {
    case '/send-mail':
        require_once('endpoints/send-mail/index.php');
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
        exit;
}