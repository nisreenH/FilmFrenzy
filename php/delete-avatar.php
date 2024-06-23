<?php
session_start();
require_once 'connection.php';

define('DEFAULT_AVATAR', '../img/user-avatar.png');
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch the current avatar
    $query = "SELECT avatar FROM users WHERE username = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($avatar);
    $stmt->fetch();
    $stmt->close();

    // Delete the avatar file from the server
    if ($avatar && $avatar !== DEFAULT_AVATAR && file_exists($avatar)) {
        unlink($avatar);
    }

    // Update the database to set the avatar to the default
    $query = "UPDATE users SET avatar = ? WHERE username = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', DEFAULT_AVATAR, $username);
    if ($stmt->execute()) {
        $_SESSION['avatar'] = DEFAULT_AVATAR;
        echo json_encode(['success' => true, 'avatarUrl' => DEFAULT_AVATAR]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();

    // Fetch the updated avatar to ensure the database has been updated correctly
    $query = "SELECT avatar FROM users WHERE username = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($updatedAvatar);
    $stmt->fetch();
    $stmt->close();

    // Return the updated avatar path to verify the update
    echo json_encode(['updatedAvatar' => $updatedAvatar]);
} else {
    echo json_encode(['success' => false]);
}
?>
