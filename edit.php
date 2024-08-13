<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$origin = isset($_GET['origin']) ? $_GET['origin'] : 'customer'; 

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $province = trim($_POST['province']);

    // Server-side validation
    if (empty($name)) {
        $errors[] = "Họ và Tên là bắt buộc.";
    }

    if (empty($phone) || !preg_match('/^0[0-9]{9}$/', $phone)) {
        $errors[] = "Số Điện Thoại phải bắt đầu bằng số 0 và có 10 chữ số.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email phải chứa ký tự @ và có định dạng hợp lệ.";
    }

    if (empty($address)) {
        $errors[] = "Địa chỉ là bắt buộc.";
    }

    if (empty($province)) {
        $errors[] = "Tỉnh/Thành Phố là bắt buộc.";
    }

    if (empty($errors)) {
        $sql = "UPDATE users SET name = ?, phone = ?, email = ?, address = ?, province = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $phone, $email, $address, $province, $user_id);

        if ($stmt->execute()) {
            header("Location: customer.php?origin=" . urlencode($origin) . "&success=1");
            exit;
        } else {
            $errors[] = "Lỗi cập nhật thông tin: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Không tìm thấy thông tin khách hàng.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Thông Tin Khách Hàng</title>
    <link href="style/style.css" rel="stylesheet">
    <style>
        .error { color: red; }
    </style>
    <script>
        function validateForm() {
            var name = document.forms["registration-form"]["name"].value.trim();
            var phone = document.forms["registration-form"]["phone"].value.trim();
            var email = document.forms["registration-form"]["email"].value.trim();
            var address = document.forms["registration-form"]["address"].value.trim();
            var province = document.forms["registration-form"]["province"].value.trim();

            var errors = [];

            if (name === "") {
                errors.push("Họ và Tên là bắt buộc.");
            }

            var phonePattern = /^0[0-9]{9}$/;
            if (phone === "" || !phonePattern.test(phone)) {
                errors.push("Số Điện Thoại phải bắt đầu bằng số 0 và có 10 chữ số.");
            }

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "" || !emailPattern.test(email)) {
                errors.push("Email phải chứa ký tự @ và có định dạng hợp lệ.");
            }

            if (address === "") {
                errors.push("Địa chỉ là bắt buộc.");
            }

            if (province === "") {
                errors.push("Tỉnh/Thành Phố là bắt buộc.");
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <section class="stars-container">
            <div class="container">
                <h1 class="form-title">Chỉnh Sửa Thông Tin Khách Hàng</h1>
                <?php if (!empty($errors)) : ?>
                    <div class="error">
                        <?php foreach ($errors as $error) : ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form id="registration-form" name="registration-form" method="POST" action="edit.php?origin=<?php echo urlencode($origin); ?>" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="name">Họ và Tên:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại:</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="province">Tỉnh/Thành Phố:</label>
                        <input type="text" id="province" name="province" value="<?php echo htmlspecialchars($user['province']); ?>" required>
                    </div>
                    <div class="btn-container">
                        <button type="submit" class="login-btn">Lưu Thông Tin</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
