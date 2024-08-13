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
$purchase_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];

    if ($payment_method == 'qr') {
        echo '<script>document.getElementById("qrModal").style.display = "block";</script>';
    } else {
        $stmt = $conn->prepare("INSERT INTO payments (user_id, payment_method, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
        $stmt->bind_param("is", $user_id, $payment_method);

        if ($stmt->execute()) {
            // Cập nhật trạng thái của giao dịch
            $payment_id = $stmt->insert_id;
            $update_stmt = $conn->prepare("UPDATE payments SET status = 1 WHERE id = ?");
            $update_stmt->bind_param("i", $payment_id);
            if ($update_stmt->execute()) {
                $purchase_successful = true;
                $_SESSION['purchase_successful'] = true;
                header("Location: trangchudetail.php");
                exit;
            } else {
                die("Lỗi: " . $update_stmt->error);
            }
        } else {
            die("Lỗi: " . $stmt->error);
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thông Tin Mua Hàng</title>
        <link rel="shortcut icon" href="./pic/link.png" type="image/x-icon" id="pageTitle">
        <link href="style/style.css" rel="stylesheet">
        <link href="style/style6.css" rel="stylesheet">
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
                    <h2 id="form-title">Thông Tin Mua Hàng</h2>
                    <form id="purchase-form" method="POST" action="process_payment.php" onsubmit="return handleFormSubmit(event)">
                        <div class="form-group">
                            <label for="user_id">Họ và tên:</label>
                            <input type="text" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số Điện Thoại:</label>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="amount">Số tiền cần thanh toán:</label>
                            <input type="text" id="amount" name="amount" value="268.000 VND" readonly>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Phương Thức Thanh Toán:</label>
                            <select id="payment_method" name="payment_method" required>
                                <option value="qr">QR</option>
                                <option value="momo">MoMo</option>
                                <option value="atm">ATM</option>
                                <option value="visa">Visa Card</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <button type="submit" class="login-btn">Xác Nhận Mua Hàng</button>
                    </form>
                    <form id="paypal-form" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display: none;">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="P5H7S7B7M7F3J" />
                        <input type="hidden" name="return" value="http://ai-local.com:8091/return_url.php">
                        <input type="hidden" name="notify_url" value="http://ai-local.com:8091/ipn_listener.php">
                        <input type="hidden" name="custom" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="amount" value="268.00">
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
                    </form>
                    <div id="success-message" style="display: none;">
                        <h2>Mua hàng thành công!</h2>
                    </div>
                </div>
            </section>
        </div>

        <!-- The Modal -->
        <div id="qrModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img src="./pic/qr.jpg" alt="QR Code">
            </div>
        </div>

        <script>
            function handleFormSubmit(event) {
                const paymentMethod = document.getElementById('payment_method').value;
                if (paymentMethod === 'qr') {
                    event.preventDefault();
                    document.getElementById('qrModal').style.display = 'block';
                    return false;
                } else if (paymentMethod === 'paypal') {
                    event.preventDefault();
                    document.getElementById('paypal-form').submit();
                    return false;
                }
                return true;
            }

            document.addEventListener("DOMContentLoaded", function() {
                var modal = document.getElementById("qrModal");
                if (modal) {
                    var span = document.getElementsByClassName("close")[0];
                    if (span) {
                        span.addEventListener("click", function() {
                            modal.style.display = "none";
                        });
                    }

                    window.addEventListener("click", function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    });
                }
            });
        </script>
    </body>
</html>




