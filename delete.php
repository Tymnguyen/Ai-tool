<?php
include 'db.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_account'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: dangnhap.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        session_unset();
        session_destroy();
        header("Location: success.php?message=Tài khoản đã được xóa thành công!&redirect=trangchutaikhoan.php");
        exit;
    } else {
        echo "Lỗi xóa tài khoản: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: customer.php");
    exit;
}
?>
