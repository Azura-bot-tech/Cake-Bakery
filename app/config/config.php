<?php
// connect to database
$conn = mysqli_connect('localhost', 'root', '', 'database');

// check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>