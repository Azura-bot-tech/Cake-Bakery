<?php
// Kết nối database
include '../../config/config.php'; 

// Lấy danh sách user
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);

// Xử lý yêu cầu lấy thông tin user
if (isset($_GET['get_user']) && $_GET['get_user'] == 1) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'Người dùng không tồn tại']);
    }
    exit();
}

// Xử lý thêm user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO user (full_name, username, password, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $full_name, $username, $password, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm user thành công!'); window.location.href='';</script>";
    } else {
        echo "<script>alert('Thêm user thất bại!'); window.location.href='';</script>";
    }
    exit();
}

// Xử lý sửa user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $id = intval($_POST['id']);
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE user SET full_name = ?, username = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $full_name, $username, $email, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật user thành công!'); window.location.href='';</script>";
    } else {
        echo "<script>alert('Cập nhật user thất bại!'); window.location.href='';</script>";
    }
    exit();
}

// Xử lý xóa user
if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Xóa user thành công!');
                window.location.href = window.location.origin + window.location.pathname;
              </script>";
    } else {
        echo "<script>
                alert('Xóa user thất bại!');
                window.location.href = window.location.origin + window.location.pathname;
              </script>";
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
    <title>Quản lý User</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="user_management.css">
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
    <h1>Quản lý User</h1>

    <button class="btn add-btn" id="addUserBtn">Thêm User</button>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['full_name'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <button class="btn edit-btn" data-id="<?= $user['id'] ?>">Sửa</button>
                    <button class="btn delete-btn" data-id="<?= $user['id'] ?>">Xóa</button>
                    <button class="btn order-btn" data-username="<?= $user['username'] ?>" style="background: #DEB887 !important;
                    color: #8B4513 !important;">Order History</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h3>Form User</h3>
            <form id="userForm" method="POST">
                <input type="hidden" name="id" id="userId">
                <input type="text" name="full_name" id="fullName" placeholder="Full Name" required>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" name="add_user" id="formSubmitBtn" class="btn add-btn">Thêm</button>
            </form>
        </div>
    </div>

    <!-- Modal sửa user -->
    <div id="userModal-fix" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-btn close-btn-fix">&times;</span>
            <h3 id="modalTitle">Form User</h3>
            <form id="userForm" method="POST">
                <input type="hidden" name="id" id="userIdFix">
                <div>
                    <label for="fullName">Full Name</label>
                    <input type="text" name="full_name" id="fullNameFix" placeholder="Full Name" required>
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="usernameFix" placeholder="Username" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="emailFix" placeholder="Email" required>
                </div>
                
                <button type="submit" name="update_user" id="formSubmitBtnFix" class="btn fix-btn" style="background: #DEB887 !important;
                    color: #8B4513 !important;">Cập nhật</button>
            </form>
        </div>
    </div>

    <!-- Modal coi lịch sử order -->
    <div id="userModal-order" class="modal" style="display:none;">
        <span class="close-btn close-btn-order">&times;</span>
        <div class="modal-content">
        
        </div>
    </div>

    <script>
        const addUserBtn = document.getElementById('addUserBtn');
        const modal = document.getElementById('userModal');
        const closeBtn = document.querySelector('.close-btn');
        const formSubmitBtn = document.getElementById('formSubmitBtn');
        const userForm = document.getElementById('userForm');

        const modalFix = document.getElementById('userModal-fix');
        const closeBtnFix = document.querySelector('.close-btn-fix');
        const userIdFix = document.getElementById('userIdFix');
        const fullNameInput = document.getElementById('fullNameFix');
        const usernameInput = document.getElementById('usernameFix');
        const emailInput = document.getElementById('emailFix');

        const orderButtons = document.querySelectorAll('.order-btn');
        const orderModal = document.getElementById('userModal-order');
        const closeBtnOrder = document.querySelector('.close-btn-order');
        const modalContent = orderModal.querySelector('.modal-content');

        // Mở modal thêm user
        addUserBtn.addEventListener('click', () => {
            modal.style.display = 'block';
            formSubmitBtn.innerText = 'Thêm';
            passwordInput.style.display = 'block';
            userForm.reset();
            userForm.action = '';
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

        // Xóa user
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                const userId = button.getAttribute('data-id');
                if (confirm('Bạn có chắc chắn muốn xóa user này không?')) {
                    window.location.href = `?delete_user=${userId}`;
                }
            });
        });

        // Sửa user
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const userId = button.getAttribute('data-id');
                // Gửi yêu cầu AJAX lấy thông tin user
                fetch(`?get_user=1&id=${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            modalFix.style.display = 'block';
                            // Điền dữ liệu vào form
                            userIdFix.value =data.id
                            fullNameInput.value = data.full_name;
                            usernameInput.value = data.username;
                            emailInput.value = data.email;
                             
                        }
                    });
            });
        });
        // Đóng modal
        closeBtnFix.addEventListener('click', () => {
            modalFix.style.display = 'none';
        });

        window.addEventListener('click', event => {
            if (event.target === modal) {
                modalFix.style.display = 'none';
            }
        });

        // Hiển thị lịch sử order
        document.querySelectorAll('.order-btn').forEach(button => {
            button.addEventListener('click', function() {
                const username = button.dataset.username;
            
                // Gửi AJAX để lấy lịch sử order
                fetch(`get_order_history.php?username=${username}`)
                    .then(response => response.text())
                    .then(html => {
                        modalContent.innerHTML = html; // Chèn HTML lịch sử order vào modal
                        orderModal.style.display = 'block'; // Hiển thị modal
                    })
                    .catch(error => console.error('Lỗi:', error));
            });
        });

        // Đóng modal
        closeBtnOrder.addEventListener('click', () => {
            orderModal.style.display = 'none';
        });

        window.addEventListener('click', event => {
            if (event.target === modal) {
                orderModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>
