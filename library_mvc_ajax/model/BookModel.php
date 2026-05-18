<?php
require_once __DIR__ . "/../config/db.php";

function insertBook($title, $author, $category, $status)
{
    global $conn;

    $sql = "INSERT INTO books (title, author, category, availability_status)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $author, $category, $status);

    return mysqli_stmt_execute($stmt);
}

function getAllBooks()
{
    global $conn;

    $sql = "SELECT * FROM books ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    $books = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    return $books;
}

function getBookById($id)
{
    global $conn;

    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}

function updateBook($id, $title, $author, $category, $status)
{
    global $conn;

    $sql = "UPDATE books 
            SET title = ?, author = ?, category = ?, availability_status = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $author, $category, $status, $id);

    return mysqli_stmt_execute($stmt);
}

function deleteBook($id)
{
    global $conn;

    $sql = "DELETE FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    return mysqli_stmt_execute($stmt);
}
?>