<?php
session_start();
require_once '../php/connection.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$userId = $_SESSION['user_id'];

$query = "SELECT * FROM lists WHERE user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$lists = [];
while ($row = $result->fetch_assoc()) {
    $lists[] = $row;
}

$stmt->close();
$con->close();

echo json_encode($lists);
?>
