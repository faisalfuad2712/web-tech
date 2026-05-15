<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/BookModel.php';

function sendJsonResponse($success, $message, $data = null)
{
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

function cleanInput($value)
{
    return trim($value ?? '');
}

function validateBookInput($title, $author, $category, $status)
{
    $allowedStatuses = ['Available', 'Unavailable'];

    if ($title === '' || $author === '' || $category === '' || $status === '') {
        return 'All fields are required.';
    }

    if (!in_array($status, $allowedStatuses, true)) {
        return 'Invalid availability status.';
    }

    return null;
}

function handleGetBooks()
{
    global $conn;
    sendJsonResponse(true, 'Books loaded successfully.', getAllBooks($conn));
}

function handleGetBook()
{
    global $conn;
    $id = (int) ($_POST['id'] ?? 0);

    if ($id <= 0) {
        sendJsonResponse(false, 'Invalid book ID.');
    }

    $book = getBookById($conn, $id);

    if (!$book) {
        sendJsonResponse(false, 'Book record was not found.');
    }

    sendJsonResponse(true, 'Book loaded successfully.', $book);
}

function handleAddBook()
{
    global $conn;
    $title = cleanInput($_POST['title'] ?? '');
    $author = cleanInput($_POST['author'] ?? '');
    $category = cleanInput($_POST['category'] ?? '');
    $status = cleanInput($_POST['status'] ?? '');
    $validationError = validateBookInput($title, $author, $category, $status);

    if ($validationError) {
        sendJsonResponse(false, $validationError);
    }

    if (insertBook($conn, $title, $author, $category, $status)) {
        sendJsonResponse(true, 'Book added successfully.');
    }

    sendJsonResponse(false, 'Unable to add book.');
}

function handleUpdateBook()
{
    global $conn;
    $id = (int) ($_POST['id'] ?? 0);
    $title = cleanInput($_POST['title'] ?? '');
    $author = cleanInput($_POST['author'] ?? '');
    $category = cleanInput($_POST['category'] ?? '');
    $status = cleanInput($_POST['status'] ?? '');
    $validationError = validateBookInput($title, $author, $category, $status);

    if ($id <= 0) {
        sendJsonResponse(false, 'Invalid book ID.');
    }

    if ($validationError) {
        sendJsonResponse(false, $validationError);
    }

    if (updateBook($conn, $id, $title, $author, $category, $status)) {
        sendJsonResponse(true, 'Book updated successfully.');
    }

    sendJsonResponse(false, 'Unable to update book.');
}

function handleDeleteBook()
{
    global $conn;
    $id = (int) ($_POST['id'] ?? 0);

    if ($id <= 0) {
        sendJsonResponse(false, 'Invalid book ID.');
    }

    if (deleteBook($conn, $id)) {
        sendJsonResponse(true, 'Book deleted successfully.');
    }

    sendJsonResponse(false, 'Unable to delete book.');
}