<?php

function insertBook($conn, $title, $author, $category, $status)
{
    $sql = 'INSERT INTO books (title, author, category, status) VALUES (?, ?, ?, ?)';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $title, $author, $category, $status);

    return mysqli_stmt_execute($stmt);
}

function getAllBooks($conn)
{
    $sql = 'SELECT id, title, author, category, status, created_at FROM books ORDER BY id DESC';
    $result = mysqli_query($conn, $sql);
    $books = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    return $books;
}

function getBookById($conn, $id)
{
    $sql = 'SELECT id, title, author, category, status FROM books WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}

function updateBook($conn, $id, $title, $author, $category, $status)
{
    $sql = 'UPDATE books SET title = ?, author = ?, category = ?, status = ? WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi', $title, $author, $category, $status, $id);

    return mysqli_stmt_execute($stmt);
}

function deleteBook($conn, $id)
{
    $sql = 'DELETE FROM books WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    return mysqli_stmt_execute($stmt);
}