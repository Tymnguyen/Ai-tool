<?php
include 'db.php'; 
session_start(); 

$registration_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $province = $_POST['province'];
    $referrer_id = isset($_POST['referrer_id']) ? $_POST['referrer_id'] : null;

    // Kiểm tra hợp lệ của dữ liệu nhập vào
    if (!preg_match("/^0[0-9]{9}$/", $phone)) {
        die("Số điện thoại không hợp lệ. Vui lòng nhập đủ 10 chữ số và bắt đầu bằng số 0.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email không hợp lệ. Vui lòng nhập lại email.");
    }
    if ($password !== $confirm_password) {
        die("Mật khẩu và mật khẩu xác nhận không trùng khớp. Vui lòng thử lại.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, address, password, province, referrer_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $name, $phone, $email, $address, $hashed_password, $province, $referrer_id);

if ($stmt->execute()) {
    $registration_successful = true;
    $user_id = $stmt->insert_id; 

   
    error_log("User registered: user_id = $user_id, referrer_id = $referrer_id");

    
    if ($referrer_id) {
        $commission_amount = 268000 * 0.15; // 15% của 268.000 VND

        $update_commission = $conn->prepare("UPDATE users SET commission = commission + ? WHERE phone = ?");
        $update_commission->bind_param("di", $commission_amount, $referrer_id);
        if ($update_commission->execute()) {
            error_log("Commission updated: referrer_id = $referrer_id, commission_amount = $commission_amount");
        } else {
            error_log("Failed to update commission: " . $update_commission->error);
        }
        $update_commission->close();

        // Ghi lại thông tin vào bảng payments
        // $record_payment = $conn->prepare("INSERT INTO payments (user_id, payment_method, txn_id, referrer_id, status, created_at, updated_at) VALUES (?, 'register', ?, ?, ?, 0, NOW(), NOW())");
        // $txn_id = bin2hex(random_bytes(16)); // Tạo mã giao dịch ngẫu nhiên
        // $record_payment->bind_param("isdi", $user_id, $txn_id, $referrer_id, $commission_amount);
        // if ($record_payment->execute()) {
        //     error_log("Payment recorded: user_id = $user_id, referrer_id = $referrer_id, commission_amount = $commission_amount");
        // } else {
        //     error_log("Failed to record payment: " . $record_payment->error);
        // }
        //$record_payment->close();
    }
} else {
    die("Lỗi: " . $stmt->error);
}

$stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNS - AI TOOL</title>
    <link rel="shortcut icon" href="./pic/link.png" type="image/x-icon" id="pageTitle">
    <link href="style/style.css" rel="stylesheet"> 
</head>

<body>
    <div class="wrapper">
        <section class="stars-container">
            <div class="container">
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div>
                <div class="img">
                    <img src="./pic/logo-01.png" height="120px" width="120px" alt="Hình ảnh mô tả">
                </div>
                <h2 id="form-title">Đăng Ký Tài Khoản</h2>
                <form id="registration-form" method="POST" action="dangky.php">
                    <input type="hidden" name="referrer_id" value="<?php echo isset($_GET['referrer_phone']) ? htmlspecialchars($_GET['referrer_phone']) : ''; ?>">

                    <div class="form-group">
                        <label for="phone">Họ và Tên:</label>
                        <input type="tel" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" id="password" name="password" required>
                        <span class="show-password" id="show-password">Hiện</span>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Nhập lại Mật khẩu:</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                        <span class="show-confirm-password" id="show-confirm-password">Hiện</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ:</label>
                        <input type="text" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="province">Tỉnh/Thành Phố:</label>
                        <select id="province" name="province">
                            <option value="">Chọn tỉnh thành</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                            <option value="Hải Phòng">Hải Phòng</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                            <option value="Cần Thơ">Cần Thơ</option>
                            <option value="An Giang">An Giang</option>
                            <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                            <option value="Bắc Giang">Bắc Giang</option>
                            <option value="Bắc Kạn">Bắc Kạn</option>
                            <option value="Bạc Liêu">Bạc Liêu</option>
                            <option value="Bắc Ninh">Bắc Ninh</option>
                            <option value="Bến Tre">Bến Tre</option>
                            <option value="Bình Định">Bình Định</option>
                            <option value="Bình Dương">Bình Dương</option>
                            <option value="Bình Phước">Bình Phước</option>
                            <option value="Bình Thuận">Bình Thuận</option>
                            <option value="Cà Mau">Cà Mau</option>
                            <option value="Cao Bằng">Cao Bằng</option>
                            <option value="Đắk Lắk">Đắk Lắk</option>
                            <option value="Đắk Nông">Đắk Nông</option>
                            <option value="Điện Biên">Điện Biên</option>
                            <option value="Đồng Nai">Đồng Nai</option>
                            <option value="Đồng Tháp">Đồng Tháp</option>
                            <option value="Gia Lai">Gia Lai</option>
                            <option value="Hà Giang">Hà Giang</option>
                            <option value="Hà Nam">Hà Nam</option>
                            <option value="Hà Tĩnh">Hà Tĩnh</option>
                            <option value="Hải Dương">Hải Dương</option>
                            <option value="Hậu Giang">Hậu Giang</option>
                            <option value="Hòa Bình">Hòa Bình</option>
                            <option value="Hưng Yên">Hưng Yên</option>
                            <option value="Khánh Hòa">Khánh Hòa</option>
                            <option value="Kiên Giang">Kiên Giang</option>
                            <option value="Kon Tum">Kon Tum</option>
                            <option value="Lai Châu">Lai Châu</option>
                            <option value="Lâm Đồng">Lâm Đồng</option>
                            <option value="Lạng Sơn">Lạng Sơn</option>
                            <option value="Lào Cai">Lào Cai</option>
                            <option value="Long An">Long An</option>
                            <option value="Nam Định">Nam Định</option>
                            <option value="Nghệ An">Nghệ An</option>
                            <option value="Ninh Bình">Ninh Bình</option>
                            <option value="Ninh Thuận">Ninh Thuận</option>
                            <option value="Phú Thọ">Phú Thọ</option>
                            <option value="Phú Yên">Phú Yên</option>
                            <option value="Quảng Bình">Quảng Bình</option>
                            <option value="Quảng Nam">Quảng Nam</option>
                            <option value="Quảng Ngãi">Quảng Ngãi</option>
                            <option value="Quảng Ninh">Quảng Ninh</option>
                            <option value="Quảng Trị">Quảng Trị</option>
                            <option value="Sóc Trăng">Sóc Trăng</option>
                            <option value="Sơn La">Sơn La</option>
                            <option value="Tây Ninh">Tây Ninh</option>
                            <option value="Thái Bình">Thái Bình</option>
                            <option value="Thái Nguyên">Thái Nguyên</option>
                            <option value="Thanh Hóa">Thanh Hóa</option>
                            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                            <option value="Tiền Giang">Tiền Giang</option>
                            <option value="Trà Vinh">Trà Vinh</option>
                            <option value="Tuyên Quang">Tuyên Quang</option>
                            <option value="Vĩnh Long">Vĩnh Long</option>
                            <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                            <option value="Yên Bái">Yên Bái</option>
                        </select>
                    </div>
                    <button type="submit" class="login-btn">Đăng Ký</button>
                    <p>Nếu bạn đã có tài khoản, <a href="./dangnhap.php">Đăng Nhập</a>.</p>
                </form>
                <div id="success-message" style="display: none;">
                    <h2>Đăng ký thành công!</h2>
                </div>
            </div>
        </section>
    </div>
    <script>
        const passwordInput = document.getElementById("password");
        const showPasswordToggle = document.getElementById("show-password");

        const conpasswordInput = document.getElementById("confirm-password");
        const showPasswordAgainToggle = document.getElementById("show-confirm-password");

        showPasswordToggle.addEventListener("click", function() {
            togglePasswordVisibility(passwordInput, showPasswordToggle);
        });

        showPasswordAgainToggle.addEventListener("click", function() {
            togglePasswordVisibility(conpasswordInput, showPasswordAgainToggle);
        });

        function togglePasswordVisibility(inputElement, toggleElement) {
            if (inputElement.type === "password") {
                inputElement.type = "text";
                toggleElement.textContent = "Ẩn";
            } else {
                inputElement.type = "password";
                toggleElement.textContent = "Hiện";
            }
        }

        <?php if ($registration_successful): ?>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('registration-form').style.display = 'none';
            document.getElementById('success-message').style.display = 'block';
            document.getElementById('form-title').innerText = 'Chúc mừng!';
            setTimeout(function() {
                window.location.href = 'dangnhap.php';
            }, 1000); 
        });
        <?php endif; ?>

        document.addEventListener('DOMContentLoaded', function() {
            const registrationForm = document.getElementById('registration-form');
            registrationForm.addEventListener('submit', function(event) {
                const phoneInput = document.getElementById('phone').value;
                const passwordInput = document.getElementById('password').value;
                const confirmPasswordInput = document.getElementById('confirm-password').value;
                const phonePattern = /^0[0-9]{9}$/;

                if (!phonePattern.test(phoneInput)) {
                    alert('Số điện thoại không hợp lệ. Vui lòng nhập đủ 10 chữ số và bắt đầu bằng số 0.');
                    event.preventDefault();
                } else if (passwordInput !== confirmPasswordInput) {
                    alert('Mật khẩu và mật khẩu xác nhận không trùng khớp. Vui lòng thử lại.');
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>