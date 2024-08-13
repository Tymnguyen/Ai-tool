<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];

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

$origin = isset($_GET['origin']) ? $_GET['origin'] : 'trangchudetail';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Khách Hàng</title>
    <link href="style/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .login-btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-align: center;
            color: #000;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            white-space: nowrap;
            min-width: 150px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-container form {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="stars-container">
            <div class="container">
                <h1 class="form-title">Thông Tin Khách Hàng</h1>
                <form id="registration-form" method="POST">
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
                </form>
                <div class="btn-container">
                    <form action="./edit.php" method="GET">
                        <input type="hidden" name="origin" value="<?php echo htmlspecialchars($origin); ?>">
                        <button type="submit" class="login-btn">Sửa Thông Tin</button>
                    </form>
                    <form action="delete.php" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')">
                        <input type="hidden" name="delete_account" value="1">
                        <button type="submit" class="login-btn">Xoá Tài Khoản</button>
                    </form>
                    <form action="<?php echo htmlspecialchars($origin); ?>.php" method="GET">
                        <button type="submit" class="login-btn">Thoát</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
