<?php
session_start();
require_once '../php/connection.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

if (isset($_POST['list_name'])) {
    $userId = $_SESSION['user_id'];
    $listName = $_POST['list_name'];

    $query = "INSERT INTO lists (user_id, list_name) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("is", $userId, $listName);

    if ($stmt->execute()) {
        echo "List created successfully.";
    } else {
        echo "Error: Could not create list.";
    }

    $stmt->close();
    $con->close();
}
?>