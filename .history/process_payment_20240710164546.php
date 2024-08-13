<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$payment_method = $_POST['payment_method'] ?? null;

if ($payment_method == 'paypal') {
    $amount = 268.00; 
    $business_email = 'sb-nxxkn31506619@business.example.com';
    $return_url = 'http://localhost:8091/webai/return_url.php';
    $notify_url = 'http://localhost:8091/webai/ipn_listener.php';

    $query = http_build_query([
        'cmd' => '_xclick',
        'business' => $business_email,
        'item_name' => 'Tên Sản Phẩm',
        'amount' => $amount,
        'currency_code' => 'USD', // Change currency to USD as PayPal doesn't support VND
        'return' => $return_url,
        'notify_url' => $notify_url,
        'custom' => $user_id
    ]);

    header("Location: https://www.sandbox.paypal.com/cgi-bin/webscr?$query");
    exit;
} else {
    // Handle other payment methods
    $stmt = $conn->prepare("INSERT INTO payments (user_id, payment_method, created_at, updated_at, status) VALUES (?, ?, NOW(), NOW(), 1)");
    if (!$stmt) {
        die("Lỗi prepare: " . $conn->error);
    }

    $stmt->bind_param("is", $user_id, $payment_method);

    if ($stmt->execute()) {
        $_SESSION['purchase_successful'] = true;
        header("Location: trangchudetail.php");
        exit;
    } else {
        die("Lỗi execute: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
