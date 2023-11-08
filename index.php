<?php

$requestPath = $_SERVER['REQUEST_URI'];
echo 'run';

switch ($requestPath) {
    case '/register':
        require_once './Models/Classess/';
        break;
    // Other cases for different endpoints
    default:
        http_response_code(404);
        echo json_encode(array('message' => 'Not Found'));
        break;
}
