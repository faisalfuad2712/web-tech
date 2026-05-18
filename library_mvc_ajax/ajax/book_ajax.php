<?php
header("Content-Type: application/json");

require_once __DIR__ . "/../controller/BookController.php";

$action = $_POST['action'] ?? $_GET['action'] ?? "";

switch ($action) {
    case "add":
        echo json_encode(addBookController($_POST));
        break;

    case "view":
        echo json_encode(viewBooksController());
        break;

    case "get":
        $id = $_POST['id'] ?? 0;
        echo json_encode(getSingleBookController($id));
        break;

    case "update":
        echo json_encode(updateBookController($_POST));
        break;

    case "delete":
        $id = $_POST['id'] ?? 0;
        echo json_encode(deleteBookController($id));
        break;

    default:
        echo json_encode([
            "success" => false,
            "message" => "Invalid request."
        ]);
}
?>