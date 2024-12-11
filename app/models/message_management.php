<?php
// Kết nối database
include "../../config/config.php";

$sql = "SELECT * FROM contact_message ORDER BY id DESC";
$messages = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phản hồi</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="message_management.css">
    <!-- bootstrap links -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Uchen&display=swap"
      rel="stylesheet"
    />
    <!-- fonts links -->
    <!-- icons links -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- icons links -->
    <!-- animation links -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- animation links -->
</head>
<body>
    <?php include "template/navbar_admin.php"; ?>
    <h1>Danh sách phản hồi</h1>

    <!-- Bảng tin nhắn phản hồi -->
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <!-- <th>ID</th> -->
            <th>Tên Người Gửi</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Nội Dung</th>
            <th>Thời Gian</th>
        </tr>
        <?php if (mysqli_num_rows($messages) > 0): ?>
            <?php while ($message = mysqli_fetch_assoc($messages)): ?>
            <tr>
                <!-- <td><?= $message['id'] ?></td> -->
                <td><?= $message['name'] ?></td>
                <td><?= $message['email'] ?></td>
                <td><?= $message['phone'] ?></td>
                <td><?= $message['message'] ?></td>
                <td><?= $message['created_at'] ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Không tìm thấy tin nhắn nào!</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
