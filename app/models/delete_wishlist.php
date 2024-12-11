<?php
session_start();
include "../../config/config.php";

$id = $_GET['id'];
$sql = "DELETE FROM wishlist WHERE id = '$id'";
$result = $conn->query($sql);

echo "<script>alert('Delete Success!'); window.location.href = '../controller/wishlist.php';</script>";
?>

