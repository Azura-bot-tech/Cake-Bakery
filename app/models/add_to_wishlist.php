<?php
session_start();
include '../../config/config.php';

$data = json_decode(file_get_contents("php://input"), true);
$productId = $data['id'];
$username = $_SESSION['username'];

// Insert product ID into wishlist
$sql = "INSERT INTO wishlist (product_id, username) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $productId, $username);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>