<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    ?>


<?php

    class customer
    {
        private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data)
    {
        // Sử dụng hàm htmlspecialchars để tránh các lỗ hổng XSS
        $name = mysqli_real_escape_string($this->db->link, htmlspecialchars($data['Hoten']));
        $email = mysqli_real_escape_string($this->db->link, htmlspecialchars($data['Email']));
        $pass = mysqli_real_escape_string($this->db->link, htmlspecialchars($data['Pass']));
        $cfpass = mysqli_real_escape_string($this->db->link, htmlspecialchars($data['confirmPassword']));
        $img = mysqli_real_escape_string($this->db->link, htmlspecialchars($data['Image']));

        // Kiểm tra các trường bắt buộc
        if ($name == "" || $email == "" || $pass == "") {
            $alert = "<span class='error'>Không được bỏ trống các trường bắt buộc.</span>";
            return $alert;
        }

        // Kiểm tra định dạng email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $alert = "<span class='error'>Email không hợp lệ.</span>";
            return $alert;
        }

        // Kiểm tra mật khẩu và xác nhận mật khẩu
        if ($pass !== $cfpass) {
            $alert = "<span class='error'>Mật khẩu và xác nhận mật khẩu không khớp.</span>";
            return $alert;
        }

        // Mã hóa mật khẩu trước khi lưu
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

        // Kiểm tra email đã tồn tại
        $check_email = "SELECT * FROM adduser WHERE Email='$email' LIMIT 1";
        $result_check = $this->db->select($check_email);
        if ($result_check) {
            $alert = "<span class='error'>Email đã tồn tại.</span>";
            return $alert;
        } else {
            // Nếu người dùng không upload hình ảnh, có thể đặt mặc định
            if ($img == "") {
                $img = 'uploads/default.png'; // Đảm bảo bạn có hình ảnh mặc định này
            }

            // Chuẩn bị câu truy vấn để chèn dữ liệu
            $query = "INSERT INTO adduser (Hoten, Email, Pass, Image) VALUES ('$name', '$email', '$hashed_pass', '$img')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Tạo Tài Khoản Thành Công.</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Tạo Tài Khoản Không Thành Công.</span>";
                return $alert;
            }
        }
    }
        public function login_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $pass = mysqli_real_escape_string($this->db->link, $data['pass']);
            if($name=="" || $pass==""){
                $alert = "<span class='error'>Không được bỏ trống</span>";
                return $alert;
            }else{
                $check_login = "SELECT * FROM tbl_customer WHERE name='$name' AND pass='$pass' ";
                $result_check = $this->db->select($check_login);
                if($result_check){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_id',$value['ID']);
                    Session::set('customer_login',$value['name']);
                    header('Location:index.php');
                }else{
                   
                        $alert = "<span class='error'>Tạo Tài Khoản Không Thành Công</span>";
                        return $alert;
                    
                }
            }
        }
        public function show_customers($id){
            $query = "SELECT * FROM tbl_customer WHERE ID='$id' ";
            $result = $this->db->select($query);
            return $result;
        }

    }
?>