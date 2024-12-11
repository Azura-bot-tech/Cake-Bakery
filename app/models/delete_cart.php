<?php
session_start();
include "../../config/config.php";

$id = $_GET['id'];
$sql = "DELETE FROM cart WHERE id = '$id'";
$result = $conn->query($sql);

echo "<script>alert('Delete Success!'); window.location.href = '../controller/cart.php';</script>";
?>

