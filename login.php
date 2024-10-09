<?php
  include './classes/userlogin.php';
?>
<?php
  $class = new userlogin();
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $pasword = $_POST['password'];

  }
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - FriendFinder</title>
    <meta name="description" content="Đăng nhập vào FriendFinder để kết nối và tìm kiếm bạn bè mới.">
    <meta name="keywords" content="đăng nhập, FriendFinder, kết bạn, mạng xã hội">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    
    <style>
      body {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      }
      .card-signin {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }
      .btn-social {
        width: 100%;
        margin-bottom: 10px;
      }
      .btn-facebook {
        background-color: #3b5998;
        color: white;
      }
      .btn-facebook:hover {
        background-color: #2d4373;
        color: white;
      }
      .btn-zalo {
        background-color: #00c853;
        color: white;
      }
      .btn-zalo:hover {
        background-color: #009624;
        color: white;
      }
    </style>
  </head>
  <body>
    <header class="bg-primary text-white">
      <nav class="navbar navbar-expand-lg navbar-dark container" aria-label="Main Navigation">
        <a class="navbar-brand d-flex align-items-center" href="index.html">
          <img src="img/logo/logo.png" alt="FriendFinder Logo" class="d-inline-block align-text-top me-2" style="height: 40px;" loading="lazy">
          <strong>FriendFinder</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.html"><i class="bi bi-house-door-fill me-1"></i>Trang Chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="find-friends.html"><i class="bi bi-search me-1"></i>Tìm Bạn Bè</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="messages.html"><i class="bi bi-chat-dots-fill me-1"></i>Tin Nhắn</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="notifications.html"><i class="bi bi-bell-fill me-1"></i>Thông Báo</a>
            </li>
          </ul>
          <form class="d-flex me-3" role="search" action="search-results.html" method="GET">
            <label for="searchFriends" class="visually-hidden">Tìm kiếm bạn bè</label>
            <input id="searchFriends" class="form-control me-2" type="search" placeholder="Nhập tên bạn bè..." aria-label="Search" name="query">
            <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
          </form>
          <div class="d-flex">
            <!-- Nút Đăng Nhập và Đăng Ký -->
            <a href="login.html" class="btn btn-outline-light me-2"><i class="bi bi-box-arrow-in-right me-1"></i>Đăng Nhập</a>
            <a href="register.html" class="btn btn-light text-primary"><i class="bi bi-person-plus-fill me-1"></i>Đăng Ký</a>
            
            <!-- Dropdown Tài Khoản Người Dùng (Ẩn ban đầu) -->
            <div class="dropdown d-none" id="userDropdown">
              <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i>Tài Khoản
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.html"><i class="bi bi-person me-1"></i>Hồ Sơ</a></li>
                <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear me-1"></i>Cài Đặt</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.html"><i class="bi bi-box-arrow-right me-1"></i>Đăng Xuất</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <!-- Phần Main: Form Đăng Nhập -->
    <main class="container my-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card card-signin">
            <div class="card-body">
              <h3 class="card-title text-center mb-4">Đăng Nhập</h3>
              <form action="login.php" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Tên Đăng Nhập hoặc Email</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập hoặc email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Mật Khẩu</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                  <label class="form-check-label" for="rememberMe">Ghi nhớ tôi</label>
                </div>
                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                </div>
                <div class="text-center mb-3">
                  <a href="forgot-password.html" class="text-decoration-none">Quên mật khẩu?</a>
                </div>
                <hr>
                <div class="text-center mb-3">
                  <p class="mb-2">Hoặc đăng nhập với:</p>
                  <button type="button" class="btn btn-facebook btn-social"><i class="bi bi-facebook me-2"></i>Facebook</button>
                  <button type="button" class="btn btn-zalo btn-social"><i class="bi bi-telephone me-2"></i>Zalo</button>
                </div>
                <div class="text-center">
                  <p class="mb-0">Chưa có tài khoản? <a href="register.html" class="text-decoration-none">Đăng ký ngay</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> <!-- /.row -->
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
      <div class="container p-4">
        <p>&copy; 2024 FriendFinder. Bảo lưu mọi quyền.</p>
      </div>
    </footer>

    <!-- jQuery và jQuery UI (nếu sử dụng autocomplete) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
      // Hiển thị dropdown tài khoản người dùng khi đăng nhập
      // Giả sử bạn có một biến JS xác định trạng thái đăng nhập
      const isLoggedIn = false; // Thay đổi giá trị này dựa trên trạng thái thực tế

      if (isLoggedIn) {
        document.getElementById('userDropdown').classList.remove('d-none');
        document.querySelectorAll('.d-flex > a.btn').forEach(btn => btn.classList.add('d-none'));
      } else {
        document.getElementById('userDropdown').classList.add('d-none');
        document.querySelectorAll('.d-flex > a.btn').forEach(btn => btn.classList.remove('d-none'));
      }
    </script>
  </body>
</html>
