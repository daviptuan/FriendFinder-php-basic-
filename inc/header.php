
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendFinder - Tìm Kiếm Bạn Bè Mới</title>
    <meta name="description" content="Kết nối và tìm kiếm bạn bè mới dễ dàng với FriendFinder.">
    <meta name="keywords" content="tìm kiếm bạn bè, kết bạn, mạng xã hội, FriendFinder">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- jQuery UI CSS (nếu sử dụng autocomplete) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
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
              <a class="nav-link active" aria-current="page" href="index.html"><i class="bi bi-house-door-fill me-1"></i>Trang Chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="find-friends.html"><i class="bi bi-search me-1"></i>Tìm Bạn Bè</a>
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
            <a href="login.php" class="btn btn-outline-light me-2"><i class="bi bi-box-arrow-in-right me-1"></i>Đăng Nhập</a>
            <a href="register.php" class="btn btn-light text-primary"><i class="bi bi-person-plus-fill me-1"></i>Đăng Ký</a>
            
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
