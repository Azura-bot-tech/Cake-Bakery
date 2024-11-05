<?php
    // connect to database
    $conn = mysqli_connect('localhost', 'root', '', 'cake');

    // check connection
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
?>