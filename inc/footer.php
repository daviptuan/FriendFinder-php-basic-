
<!-- Footer (Có thể thêm sau) -->
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

      // Xử lý sự kiện thêm bạn bè
      document.getElementById('addFriendBtn').addEventListener('click', function() {
        // Hiển thị thông báo xác nhận
        if (confirm('Bạn có chắc chắn muốn thêm Nguyễn Văn A làm bạn bè không?')) {
          // Thực hiện hành động thêm bạn bè, ví dụ: gửi yêu cầu tới server
          alert('Yêu cầu kết bạn đã được gửi!');
          // Bạn có thể thay đổi hành động này theo nhu cầu thực tế
        }
      });
    </script>
  </body>
</html>