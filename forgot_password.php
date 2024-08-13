<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Số điện thoại không tồn tại.");
    }
    
    $verification_code = rand(100000, 999999);
    $expires_at = date("Y-m-d H:i:s", strtotime('+1 hour'));

    $stmt = $conn->prepare("UPDATE users SET verification_code = ?, expires_at = ? WHERE phone = ?");
    $stmt->bind_param("iss", $verification_code, $expires_at, $phone);

    if ($stmt->execute()) {
        echo "Mã xác nhận của bạn là: " . $verification_code;
    } else {
        echo "Error updating verification code: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
