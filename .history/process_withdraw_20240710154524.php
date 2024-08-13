<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để thực hiện chức năng này.";
    exit;
}

$user_id = $_SESSION['user_id'];
$withdraw_amount = $_POST['withdraw_amount'];
$bank_name = $_POST['bank_name'];
$bank_account = $_POST['bank_account'];
$account_holder = $_POST['account_holder'];

// Kiểm tra số dư hoa hồng
$sql = "SELECT commission FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($commission);
$stmt->fetch();
$stmt->close();

if ($commission >= $withdraw_amount) {
    // Thực hiện giao dịch rút tiền (giả lập)
    sleep(5); // Giả lập thời gian xử lý giao dịch

    // Cập nhật số dư hoa hồng của người dùng
    $new_commission = $commission - $withdraw_amount;
    $stmt = $conn->prepare("UPDATE users SET commission = ? WHERE id = ?");
    $stmt->bind_param("di", $new_commission, $user_id);
    $stmt->execute();
    $stmt->close();

    // Ghi lại giao dịch vào bảng withdrawals
    $txn_id = uniqid(); // Tạo mã giao dịch ngẫu nhiên
    $status = 1; // Thành công
    $stmt = $conn->prepare("INSERT INTO withdrawals (user_id, txn_id, bank_name, bank_account, account_holder, amount, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("issssdi", $user_id, $txn_id, $bank_name, $bank_account, $account_holder, $withdraw_amount, $status);
    $stmt->execute();
    $stmt->close();

    echo "Yêu cầu rút tiền thành công! Số tiền sẽ được chuyển vào tài khoản của bạn trong vòng 1-3 ngày làm việc.";
} else {
    echo "Số dư hoa hồng không đủ để thực hiện giao dịch.";
}

$conn->close();
?>
