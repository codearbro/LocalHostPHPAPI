<?php

// Set headers for JSON responses

header('Content-Type: application/json');

// Include necessary files

include_once '../config/DbConnect.php';

// Get the HTTP request method

$method = $_SERVER['REQUEST_METHOD'];
echo "<pre>"; print_r($method);

// Get the request URI to determine the correct API file

$path = explode('/', $_SERVER['REQUEST_URI']);
print_r($path); 
$api = isset($path[2]) ? $path[2] : '';

// Include corresponding API file based on the request path
switch ($api) {
    case 'assets':
        include_once '../api/assets.php';
        break;
    case 'booking':
        include_once '../api/assets/booking.php';
        break;
    case 'user':
            include_once '../api/assets/users.php';
            break;
    default:
        echo json_encode(['error' => 'Invalid API endpoint.']);
        break;
}
