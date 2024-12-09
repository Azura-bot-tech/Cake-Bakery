<?php
// Kết nối database
include '../../config/config.php'; 

// Xử lý tìm kiếm sản phẩm
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = trim($_GET['search']);
    $sql = "SELECT * FROM product WHERE name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchParam = '%' . $searchQuery . '%';
    $stmt->bind_param('ss', $searchParam, $searchParam);
} else {
    $sql = "SELECT * FROM product";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

// Xử lý thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $distribution = $_POST['distribution'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO product (name, price, description, image_url, distribution) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsss", $name, $price, $description, $image_url, $distribution);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm sản phẩm thành công!');</script>";
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=true");
        exit();
    } else {
        echo "<script>alert('Thêm sản phẩm thất bại!');</script>";
    }

    $stmt->close();
}

// Xử lý xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $id = intval($_POST['id']);

    // Chuẩn bị câu lệnh SQL để xóa sản phẩm
    $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Thực thi câu lệnh và kiểm tra kết quả
    if ($stmt->execute()) {
        // Chuyển hướng sau khi xóa thành công
        header("Location: " . $_SERVER['PHP_SELF'] . "?delete_success=true");
        exit();
    } else {
        echo "<script>alert('Xóa sản phẩm thất bại!');</script>";
    }
}

// Xử lý lấy dữ liệu sản phẩm (khi nhấn nút sửa)
if (isset($_GET['get_product']) && isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Sản phẩm không tồn tại']);
    }
    exit();
}

// Xử lý cập nhật dữ liệu sản phẩm (khi submit form)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];
    $distribution = $_POST['distribution'];
    $image_url = $_POST['image_url'];

    $sql = "UPDATE product SET name = ?, price = ?, description = ?, distribution = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdsssi', $name, $price, $description, $distribution, $image_url, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='';</script>";
    } else {
        echo "<script>alert('Cập nhật thất bại!'); window.location.href='';</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="edit_product.css">
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
    <h1>Danh sách sản phẩm</h1>
    <!-- Thanh tìm kiếm -->
    <form method="GET" class="search-bar">
        <input type="text" name="search" class="search-input" placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($searchQuery) ?>">
        <button type="submit" class="search-btn">Tìm kiếm</button>
    </form>

    <!-- Nút mở form thêm sản phẩm-->
    <button class="add_btn" id="add-product">Thêm Sản Phẩm</button>

    <!-- Form Thêm sản phẩm -->
    <div id="editModal-add" class="modal-add">
        <div class="modal-content-add">
            <span class="close-btn-add">&times;</span>
            <form id="editForm-add" method="POST">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="add-productName" required>

                <label for="price">Giá:</label>
                <input type="number" name="price" id="add-productPrice" step="0.01" required>

                <label for="description">Mô tả:</label>
                <textarea name="description" id="add-productDescription" rows="4" required></textarea>

                <label for="distribution">Phân phối:</label>
                <textarea name="distribution" id="add-productDistribution" rows="2" required></textarea>

                <label for="image_url">Link ảnh:</label>
                <textarea name="image_url" id="add-productImage_url" rows="2" required></textarea>

                <button type="submit" name="add_product" class="btn">Thêm sản phẩm</button>
            </form>
        </div>
    </div>

    <!-- Bảng sản phẩm -->
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Phân phối</th>
            <th>Ảnh hiển thị</th>
            <th>Hành động</th>
        </tr>
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['distribution'] ?></td>
                <td><?= $product['image_url'] ?></td>
                <td>
                    <button class="edit-btn" data-id="<?= $product['id'] ?>">Sửa</button>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Không tìm thấy sản phẩm nào!</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <form id="editForm" method="POST">
                <input type="hidden" name="id" id="productId">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="productName" required>

                <label for="price">Giá:</label>
                <input type="number" name="price" id="productPrice" step="0.01" required>

                <label for="description">Mô tả:</label>
                <textarea name="description" id="productDescription" rows="4" required></textarea>

                <label for="distribution">Phân phối:</label>
                <textarea name="distribution" id="productDistribution" rows="2" required></textarea>

                <label for="image_url">Link ảnh:</label>
                <textarea name="image_url" id="productImage_url" rows="2" required></textarea>

                <button type="submit" name="update_product" class="btn">Lưu thay đổi</button>
                <button type="submit" name="delete_product" class="delete-btn">Xóa sản phẩm</button>
            </form>
        </div>
    </div>

    <script>
        const editButtons = document.querySelectorAll('.edit-btn');
        const modal = document.getElementById('editModal');
        const closeBtn = document.querySelector('.close-btn');

        const productIdInput = document.getElementById('productId');
        const productNameInput = document.getElementById('productName');
        const productPriceInput = document.getElementById('productPrice');
        const productDescriptionInput = document.getElementById('productDescription');
        const productDistributionInput = document.getElementById('productDistribution');
        const productImage_urlInput = document.getElementById('productImage_url');
            
        // Hiển thị modal và điền dữ liệu
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                fetch(`?get_product=1&id=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            // Điền dữ liệu vào form
                            productIdInput.value = data.id;
                            productNameInput.value = data.name;
                            productPriceInput.value = data.price;
                            productDescriptionInput.value = data.description;
                            productDistributionInput.value = data.distribution;
                            productImage_urlInput.value =data.image_url;
                            // Hiển thị modal
                            modal.style.display = 'block';
                        }
                    });
            });
        });

        // Đóng modal
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', event => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Mở form thêm sản phẩm
        const addButtons = document.querySelectorAll('.add_btn');
        const modal_add = document.getElementById('editModal-add');
        const closeBtn_add = document.querySelector('.close-btn-add');
            
        // Hiển thị modal và điền dữ liệu
        addButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal_add.style.display = 'block';
            });
        });

        // Đóng modal
        closeBtn_add.addEventListener('click', () => {
            modal_add.style.display = 'none';
        });

        window.addEventListener('click', event => {
            if (event.target === modal) {
                modal_add.style.display = 'none';
            }
        });
    </script>
</body>
</html>
