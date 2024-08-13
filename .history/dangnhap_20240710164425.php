<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE phone = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log('mysqli prepare error: ' . $conn->error);
        die('Internal server error');
    }
    
    $stmt->bind_param("s", $phone);
    if ($stmt->execute() === false) {
        error_log('mysqli execute error: ' . $stmt->error);
        die('Internal server error');
    }
    
    $result = $stmt->get_result();
    if ($result === false) {
        error_log('mysqli get_result error: ' . $stmt->error);
        die('Internal server error');
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        error_log('User found: ' . json_encode($user));
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];

            $user_id = $user['id'];
            $sql = "SELECT * FROM payments WHERE user_id = ? AND status = 1";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                error_log('mysqli prepare error: ' . $conn->error);
                die('Internal server error');
            }

            $stmt->bind_param("i", $user_id);
            if ($stmt->execute() === false) {
                error_log('mysqli execute error: ' . $stmt->error);
                die('Internal server error');
            }

            $result = $stmt->get_result();
            if ($result === false) {
                error_log('mysqli get_result error: ' . $stmt->error);
                die('Internal server error');
            }

            if ($result->num_rows > 0) {
                echo json_encode(['status' => 'ordered']);
            } else {
                echo json_encode(['status' => 'not_ordered']);
            }
        } else {
            error_log('Password does not match for user: ' . $user['id']);
            echo json_encode(['status' => 'failed']);
        }
    } else {
        error_log('No user found with phone: ' . $phone);
        echo json_encode(['status' => 'failed']);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - VNS AI TOOL</title>
    <link rel="shortcut icon" href="./pic/link.png" type="image/x-icon" id="pageTitle">
    <link href="style/style2.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <section class="stars-container">
            <div class="container">
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div>
                <div class="login-container">
                    <h2>Đăng Nhập</h2>
                    <form id="login-form" method="POST">
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu:</label>
                            <input type="password" id="password" name="password" required>
                            <span class="show-password" id="show-password">Hiện</span>
                        </div>
                        <button type="submit" class="login-btn">Đăng Nhập</button>
                        <button type="button" class="forgot-password-btn">Quên mật khẩu</button>
                    </form>
                    <div class="register-link">
                        <p>Bạn chưa có tài khoản? <a href="./dangky.php">Đăng ký ngay</a></p>
                    </div>
                    <div class="register-link">
                        <p>Bạn là Admin? <a href="./dangnhapad.php">Đăng nhập tại đây!</a></p>
                    </div>
                    <div class="img">
                        <img src="./pic/BannerAITools.png" height="200px" width="100%" alt="Hình ảnh mô tả">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const showPasswordToggle = document.getElementById('show-password');

            showPasswordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    showPasswordToggle.textContent = 'Ẩn';
                } else {
                    passwordInput.type = 'password';
                    showPasswordToggle.textContent = 'Hiện';
                }
            });
            const loginForm = document.getElementById('login-form');
            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(loginForm);

                fetch('login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'ordered') {
                        window.location.href = 'trangchudetail.php';
                    } else if (data.status === 'not_ordered' || data.status === 'success') {
                        window.location.href = 'trangchuthanhtoan.php';
                    } else {
                        alert('Đăng nhập không thành công. Vui lòng kiểm tra lại số điện thoại và mật khẩu.');
                    }
                })
                //Xử lý lỗi trong quá trình gửi yêu cầu:
                .catch(error => {
                    console.error('Error:', error);
                });
            });

            const forgotPasswordBtn = document.querySelector('.forgot-password-btn');
            forgotPasswordBtn.addEventListener('click', function() {
                const phoneInputValue = document.getElementById('phone').value;
                showPhoneForm(phoneInputValue);
            });

            function showPhoneForm(phone = '') {
                const loginContainer = document.querySelector('.login-container');
                loginContainer.innerHTML = `
                    <h2>Quên Mật Khẩu</h2>
                    <form id="forgot-password-form">
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="tel" id="phone" name="phone" value="${phone}" required>
                        </div>
                        <button type="submit" class="reset-password-btn">Lấy lại mật khẩu</button>
                    </form>
                `;

                //Lấy phần tử biểu mẫu và thêm sự kiện submit:
                const forgotPasswordForm = document.getElementById('forgot-password-form');
                forgotPasswordForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    //Lấy giá trị số điện thoại và gửi yêu cầu AJAX:
                    const enteredPhone = document.getElementById('phone').value;
                    fetch('forgot_password.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'phone=' + encodeURIComponent(enteredPhone)
                    })

                    //Xử lý phản hồi từ máy chủ:
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        showNewPasswordForm(enteredPhone);
                    })

                    //Xử lý lỗi trong quá trình gửi yêu cầu:
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            }

            function showNewPasswordForm(phone) {
                const loginContainer = document.querySelector('.login-container');
                loginContainer.innerHTML = `
                    <h2>Đặt Lại Mật Khẩu</h2>
                    <form id="new-password-form" action="reset_password.php" method="POST">
                        <input type="hidden" name="phone" value="${phone}">
                        <div class="form-group">
                            <label for="verification-code">Mã xác nhận:</label>
                            <input type="text" id="verification-code" name="verification-code" required>
                            <button type="button" class="resend-code-btn" style="display: none;">Gửi lại mã</button>
                        </div>
                        <div class="form-group">
                            <label for="new-password">Mật khẩu mới:</label>
                            <input type="password" id="new-password" name="new-password" required>
                            <span class="show-password" id="show-new-password">Hiện</span>
                        </div>
                        
                        <button type="submit" class="reset-password-btn">Đổi mật khẩu</button>
                        
                    </form>
                    <div id="success-message" style="display: none;">
                        <h2>Mật khẩu đã được thay đổi thành công!</h2>
                    </div>
                `;

                const showNewPasswordButton = document.getElementById('show-new-password');
                showNewPasswordButton.addEventListener('click', function() {
                    const newPasswordInput = document.getElementById('new-password');
                    if (newPasswordInput.type === 'password') {
                        newPasswordInput.type = 'text';
                        showNewPasswordButton.textContent = 'Ẩn';
                    } else {
                        newPasswordInput.type = 'password';
                        showNewPasswordButton.textContent = 'Hiện';
                    }
                });

                const newPasswordForm = document.getElementById('new-password-form');
                newPasswordForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    const formData = new FormData(newPasswordForm);
                    const verificationCodeInput = document.getElementById('verification-code');
                    verificationCodeInput.value = verificationCodeInput.value.trim();

                    fetch('reset_password.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log("Response from server:", data);
                        if (data.trim() === "success") {
                            window.location.href = 'success.php';
                        } else {
                            alert(data);
                            document.querySelector('.resend-code-btn').style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });

                const resendCodeButton = document.querySelector('.resend-code-btn');
                resendCodeButton.addEventListener('click', function() {
                    fetch('forgot_password.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'phone=' + encodeURIComponent(phone)
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            }
        });

        // Disable text selection and right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    </script>
</body>
</html>

