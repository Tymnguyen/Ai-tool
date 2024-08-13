<?php
session_start();
$message = "";
$redirect = "trangchudetail.php";

include 'db.php'; 

if (isset($_GET['PayerID']) && isset($_SESSION['user_id'])) {
    $txnID = $_GET['PayerID'];
    $userID = $_SESSION['user_id']; 
    $paymentMethod = "PayPal"; 
    $paymentAmount = 268000; // Giả sử số tiền thanh toán là 268,000 VND
    $commissionRate = 0.15; // 15% hoa hồng
    $commission = $paymentAmount * $commissionRate;

    // Bắt đầu giao dịch
    $conn->begin_transaction();

    try {

        $stmt = $conn->prepare("INSERT INTO payments (user_id, payment_method, status, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        $paymentMethod = 'paypal';
        $paymentStatus = 1;
        $stmt->bind_param("isd", $userID, $paymentMethod, $paymentStatus);
        $stmt->execute();
        $stmt->close();

        // Kiểm tra xem người dùng có referrer_id hay không
        $stmt = $conn->prepare("SELECT referrer_id FROM users WHERE id = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $referrer_id = $row['referrer_id'];

            if ($referrer_id) {
                // Cập nhật số tiền hoa hồng cho người giới thiệu
                $stmt = $conn->prepare("UPDATE users SET commission = commission + ? WHERE id = ?");
                $stmt->bind_param("di", $commission, $referrer_id);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Hoàn tất giao dịch
        $conn->commit();

        $message = "Thanh toán thành công! Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.";
    } catch (Exception $e) {
        // Hủy giao dịch nếu có lỗi
        $conn->rollback();
        $message = "Thanh toán thất bại hoặc bị hủy. Vui lòng thử lại hoặc liên hệ với chúng tôi để được hỗ trợ.";
    }

    $conn->close();
} else {
    $message = "Thanh toán thất bại hoặc bị hủy. Vui lòng thử lại hoặc liên hệ với chúng tôi để được hỗ trợ.";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo</title>
    <link rel="shortcut icon" href="./pic/link.png" type="image/x-icon">
    <link href="style2.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #141e30, #243b55);
            font-family: Arial, sans-serif;
            color: #fff;
            text-align: center;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .success-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            animation: fadeIn 1s ease-in-out;
        }

        .success-container h2 {
            margin: 0;
            font-size: 24px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="stars-container">
            <div class="container">
                <div class="success-container">
                    <h2><?php echo $message; ?></h2>
                </div>
            </div>
        </section>
    </div>
    <script>
        setTimeout(() => {
            window.location.href = '<?php echo $redirect; ?>';
        }, 3000); 
    </script>
</body>
</html>
