<?php
// Kết nối cơ sở dữ liệu
include '../../config/config.php'; 

// Lấy username từ GET request
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Truy vấn lịch sử order theo username
$sqlOrderHistory = "SELECT * FROM order_history WHERE username = '$username'";
$resultOrderHistory = $conn->query($sqlOrderHistory);


// Tạo bảng HTML
echo '<h3>Lịch sử Order</h3>';
echo '<table border="1" cellpadding="10" cellspacing="0">';
echo '<tr><th>Tên Sản Phẩm</th><th>Mô Tả</th><th>Giá</th><th>Loại</th></tr>';

if (mysqli_num_rows($resultOrderHistory) > 0) {
    while ($orderHistory = mysqli_fetch_assoc($resultOrderHistory)) {
        $productId = $orderHistory['product_id'];
        $sqlProduct = "SELECT * FROM product WHERE id = '$productId'";
        $resultProduct = $conn->query($sqlProduct);
        $rowProduct = $resultProduct->fetch_assoc();

        echo '<tr>';
        echo '<td>' . htmlspecialchars($rowProduct['name']) . '</td>';
        echo '<td>' . htmlspecialchars($rowProduct['description']) . '</td>';
        echo '<td>' . htmlspecialchars($rowProduct['price']) . '</td>';
        echo '<td>' . htmlspecialchars($rowProduct['distribution']) . '</td>';
        echo '</tr>';

    }
} else {
    echo '<tr><td colspan="4">Không tìm thấy sản phẩm nào!</td></tr>';
    echo $username;
}

echo '</table>';
$conn->close();
?>
