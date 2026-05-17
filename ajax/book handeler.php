<?php

require_once __DIR__ . '/../controllers/BookController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    sendJsonResponse(false, 'Access Denied.');
    exit;
}

$action = $_POST['action'] ?? '';

$actions = [

    'get_books'   => 'handleGetBooks',
    'get_book'    => 'handleGetBook',
    'add_book'    => 'handleAddBook',
    'update_book' => 'handleUpdateBook',
    'delete_book' => 'handleDeleteBook'

];

if (array_key_exists($action, $actions)) {

    call_user_func($actions[$action]);

} else {

    sendJsonResponse(false, 'Invalid Action.');
}

?>