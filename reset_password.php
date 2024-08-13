<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $verification_code = trim($_POST['verification-code']);
    $new_password = $_POST['new-password'];

    if (!preg_match("/^[0-9]+$/", $phone)) {
        error_log("Số điện thoại không hợp lệ: " . $phone);
        die("Số điện thoại không hợp lệ. Vui lòng chỉ nhập số.");
    }

    if (!preg_match("/^[0-9]+$/", $verification_code)) {
        error_log("Mã xác nhận không hợp lệ: " . $verification_code);
        die("Mã xác nhận không hợp lệ.");
    }

    $stmt = $conn->prepare("SELECT verification_code, expires_at FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->bind_result($db_verification_code, $db_expires_at);
    $stmt->fetch();
    $stmt->close();

    error_log("DB Verification Code: " . $db_verification_code);
    error_log("DB Expires At: " . $db_expires_at);
    error_log("Input Verification Code: " . $verification_code);

    if ($db_verification_code != $verification_code || strtotime($db_expires_at) < time()) {
        error_log("Mã xác nhận không đúng hoặc đã hết hạn. Phone: " . $phone . ", Verification Code: " . $verification_code);
        die("Mã xác nhận không đúng hoặc đã hết hạn.");
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    error_log("Password hashed successfully for phone: " . $phone);

    $stmt = $conn->prepare("UPDATE users SET password = ?, verification_code = NULL, expires_at = NULL WHERE phone = ?");
    $stmt->bind_param("ss", $hashed_password, $phone);
    if ($stmt->execute()) {
        error_log("Password updated successfully for phone: " . $phone);
        echo "success"; 
    } else {
        error_log("Error updating password for phone: " . $phone . " - " . $stmt->error);
        echo "Error updating password: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
