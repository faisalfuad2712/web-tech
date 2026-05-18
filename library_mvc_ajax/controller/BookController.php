<?php
require_once __DIR__ . "/../model/BookModel.php";

function addBookController($data)
{
    $title = trim($data['title']);
    $author = trim($data['author']);
    $category = trim($data['category']);
    $status = trim($data['availability_status']);

    if ($title == "" || $author == "" || $category == "" || $status == "") {
        return [
            "success" => false,
            "message" => "All fields are required."
        ];
    }

    if (insertBook($title, $author, $category, $status)) {
        return [
            "success" => true,
            "message" => "Book added successfully."
        ];
    }

    return [
        "success" => false,
        "message" => "Failed to add book."
    ];
}

function viewBooksController()
{
    return [
        "success" => true,
        "data" => getAllBooks()
    ];
}

function getSingleBookController($id)
{
    $book = getBookById($id);

    if ($book) {
        return [
            "success" => true,
            "data" => $book
        ];
    }

    return [
        "success" => false,
        "message" => "Book not found."
    ];
}

function updateBookController($data)
{
    $id = intval($data['id']);
    $title = trim($data['title']);
    $author = trim($data['author']);
    $category = trim($data['category']);
    $status = trim($data['availability_status']);

    if ($id <= 0 || $title == "" || $author == "" || $category == "" || $status == "") {
        return [
            "success" => false,
            "message" => "Invalid input."
        ];
    }

    if (updateBook($id, $title, $author, $category, $status)) {
        return [
            "success" => true,
            "message" => "Book updated successfully."
        ];
    }

    return [
        "success" => false,
        "message" => "Failed to update book."
    ];
}

function deleteBookController($id)
{
    $id = intval($id);

    if ($id <= 0) {
        return [
            "success" => false,
            "message" => "Invalid book ID."
        ];
    }

    if (deleteBook($id)) {
        return [
            "success" => true,
            "message" => "Book deleted successfully."
        ];
    }

    return [
        "success" => false,
        "message" => "Failed to delete book."
    ];
}
?>