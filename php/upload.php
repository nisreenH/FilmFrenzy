<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $newUsername = isset($_POST['username']) ? $_POST['username'] : '';
    $newPassword = isset($_POST['password']) ? $_POST['password'] : '';
    $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : null;

    // Update username and password if provided
    if ($newUsername || $newPassword) {
        $query = "UPDATE users SET ";
        $params = [];
        $types = '';
        if ($newUsername) {
            $query .= "username = ?, ";
            $params[] = $newUsername;
            $types .= 's';
        }
        if ($newPassword) {
            $query .= "password = ?, ";
            $params[] = password_hash($newPassword, PASSWORD_BCRYPT);
            $types .= 's';
        }
        $query = rtrim($query, ', ') . " WHERE username = ?";
        $params[] = $username;
        $types .= 's';

        $stmt = $con->prepare($query);
        $stmt->bind_param($types, ...$params);

        if (!$stmt->execute()) {
            echo json_encode(array("success" => false, "message" => "Sorry, there was an error updating your profile."));
            exit;
        }

        // Update session username if changed
        if ($newUsername) {
            $_SESSION['username'] = $newUsername;
        }
    }

    // Handle avatar upload if provided
    if ($avatar) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($avatar["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($avatar["tmp_name"]);
        if($check === false) {
            echo json_encode(array("success" => false, "message" => "File is not an image."));
            exit;
        }

        if ($avatar["size"] > 1000000) {
            echo json_encode(array("success" => false, "message" => "Sorry, your file is too large."));
            exit;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo json_encode(array("success" => false, "message" => "Sorry, only JPG, JPEG, & PNG files are allowed."));
            exit;
        }

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($avatar["tmp_name"], $target_file)) {
            $query = "UPDATE users SET avatar = ? WHERE username = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('ss', $target_file, $username);
            if ($stmt->execute()) {
                echo json_encode(array("success" => true, "avatarUrl" => $target_file));
                exit;
            } else {
                echo json_encode(array("success" => false, "message" => "Sorry, there was an error updating your profile."));
                exit;
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Sorry, there was an error uploading your file."));
            exit;
        }
    }

    echo json_encode(array("success" => true));
    exit;
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
    exit;
}
?>
