<?php
// register.php

// Bắt đầu session
include 'lib/session.php';
Session::init();

// Lấy đường dẫn thực của file hiện tại
$filepath = realpath(dirname(__FILE__));

// Bao gồm các file cần thiết
include_once $filepath . '/lib/database.php';
include_once $filepath . '/helpers/format.php';

// Autoloader để tự động bao gồm các lớp từ thư mục 'classes'
spl_autoload_register(function($className) use ($filepath){
    $path = $filepath . '/classes/' . $className . '.php';
    if (file_exists($path)) {
        include_once $path;
    } else {
        // Xử lý lỗi khi không tìm thấy lớp
        die("Không thể tải lớp: " . $className);
    }
});

// Khởi tạo các đối tượng
$db = new Database();
$fm = new Format();
$cs = new customer(); // Đảm bảo lớp 'customer' được viết đúng (có thể viết hoa 'Customer' tùy tên lớp)
?>
<?php
// Kiểm tra xem form đã được submit hay chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer = new customer();

    // Xử lý upload hình ảnh
    if (isset($_FILES['avatarImage']) && $_FILES['avatarImage']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['avatarImage']['name'];
        $file_tmp = $_FILES['avatarImage']['tmp_name'];
        $file_size = $_FILES['avatarImage']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Kiểm tra định dạng file
        if (in_array($file_ext, $allowed)) {
            // Kiểm tra kích thước file (ví dụ: tối đa 2MB)
            if ($file_size <= 2 * 1024 * 1024) {
                // Tạo tên file duy nhất để tránh trùng lặp
                $new_file_name = uniqid('', true) . '.' . $file_ext;
                $upload_dir = $filepath . '/uploads/';
                
                // Tạo thư mục uploads nếu chưa tồn tại
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $upload_path = $upload_dir . $new_file_name;

                // Di chuyển file từ thư mục tạm đến thư mục uploads
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    $image = 'uploads/' . $new_file_name;
                } else {
                    $image = '';
                    $msg = "<span class='error'>Có lỗi xảy ra khi tải lên hình ảnh.</span>";
                }
            } else {
                $image = '';
                $msg = "<span class='error'>Kích thước hình ảnh quá lớn. Tối đa 2MB.</span>";
            }
        } else {
            $image = '';
            $msg = "<span class='error'>Định dạng hình ảnh không hợp lệ. Chỉ hỗ trợ JPG, JPEG, PNG, GIF.</span>";
        }
    } else {
        // Nếu không có hình ảnh, có thể đặt mặc định hoặc để trống
        $image = '';
        // $msg = "<span class='error'>Vui lòng tải lên hình ảnh đại diện.</span>";
    }

    // Thu thập dữ liệu từ form
    $data = array(
        'Hoten' => $_POST['Hoten'],
        'Email' => $_POST['Email'],
        'Pass' => $_POST['Pass'],
        'confirmPassword' => $_POST['confirmPassword'],
        'Image' => $image
    );

    // Kiểm tra và insert khách hàng
    $insertMsg = $customer->insert_customer($data);

    // Chuyển hướng trở lại form với thông báo
    header("Location: register_form.php?msg=" . urlencode($insertMsg));
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .image-section {
            text-align: center;
        }
        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .image-section input[type="file"] {
            display: none;
        }
        .image-section label {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <a class="navbar-brand" href="index.html">FriendFinder</a>
        </nav>
    </header>

    <!-- Main Form Section -->
    <main class="container my-5">
        <h1 class="text-center mb-5">Đăng Ký Tài Khoản</h1>
        <div class="row">
            <!-- Phần Hình Ảnh Đại Diện -->
            <div class="col-md-4 image-section">
                <img id="avatarPreview" src="https://via.placeholder.com/300x300?text=No+Image" alt="Avatar Preview">
                <label for="avatarImage" class="btn btn-primary">Chọn Ảnh Đại Diện</label>
                <input type="file" id="avatarImage" name="avatarImage" accept="image/*">
            </div>

            <!-- Phần Thông Tin Đăng Ký -->
            <div class="col-md-8">
                <form action="register.php" method="POST" id="registerForm" class="mt-4" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" id="fullname" name="Hoten" placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="Email" placeholder="Nhập email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" id="password" name="Pass" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Xác Nhận Mật Khẩu</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Xác nhận mật khẩu" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Đăng Ký</button>
                    </div>
                </form>
                <!-- Hiển thị thông báo từ backend -->
                <?php
                    if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
                ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-auto py-4">
        <div class="container">
            <p>&copy; 2024 FriendFinder. Bảo lưu mọi quyền.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script>
        // Hiển thị preview ảnh đại diện
        document.getElementById('avatarImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatarPreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = 'https://via.placeholder.com/300x300?text=No+Image';
            }
        });
    </script>
</body>
</html>
