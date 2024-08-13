<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$total_commission = 0.0;

$sql = "SELECT commission AS total_commission FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($total_commission);
$stmt->fetch();
$stmt->close();

$transactions = [];
$sql = "SELECT txn_id, amount, bank_name, created_at FROM withdrawals WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoa Hồng Của Bạn</title>
    <link href="style/style5.css" rel="stylesheet">
    <link href="style/style7.css" rel="stylesheet">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="stars-container">
            <div class="container">
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div>
                <div class="header">
                    <div class="logohead">
                        <img src="./pic/VNS logo ngang xóa nền.png" height="120px" width="300px">
                    </div>
                    <div class="logohead1">
                        <details>
                            <summary>
                                <img src="./pic/menu1.png" height="40px" width="50px" margin-bottom="50px">
                            </summary>
                            <ul>
                                <a href="customer.php?origin=hoahong" class="tk">Thông Tin Khách Hàng</a>
                                <a href="trangchudetail.php" class="tk">Trang Chủ</a>
                                <a href="./trangchutaikhoan.php" class="tk">Đăng Xuất</a>
                            </ul>
                        </details>
                    </div>
                </div>

                <div class="main">
                    <h2>Tiền Hoa Hồng Của Bạn</h2>
                    <p>Số tiền hoa hồng hiện tại: <strong><?php echo number_format($total_commission, 0, ',', '.'); ?> VND</strong></p>

                    <h3>Chi Tiết Các Giao Dịch Rút Tiền</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Mã Giao Dịch</th>
                                <th>Số Tiền</th>
                                <th>Ngân Hàng</th>
                                <th>Ngày Giao Dịch</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['txn_id']); ?></td>
                                <td><?php echo number_format($transaction['amount'], 0, ',', '.'); ?> VND</td>
                                <td><?php echo htmlspecialchars($transaction['bank_name']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['created_at']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($transactions)): ?>
                            <tr>
                                <td colspan="4">Chưa có giao dịch nào.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="btn-container">
                        <button onclick="openModal()">Rút Tiền</button>
                    </div>
                </div>
            </div>
        </section>
        <div class="footer">
            <p>Tổng hợp và sưu tập @aitoolsvietnamstartup</p>
        </div>
    </div>

    <div id="withdrawModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Rút Tiền Hoa Hồng</h2>
            <p>Tên Công Ty: <strong>VNS Company</strong></p>
            <p>Số tiền hoa hồng hiện tại: <strong><?php echo number_format($total_commission, 0, ',', '.'); ?> VND</strong></p>
            <form id="withdrawForm">
                <div class="form-group">
                    <label for="withdraw_amount">Số tiền muốn rút:</label>
                    <input type="number" id="withdraw_amount" name="withdraw_amount" required>
                </div>
                <div class="form-group">
                    <label for="bank_name">Ngân Hàng:</label>
                    <select id="bank_name" name="bank_name" required>
                        <option value="">Chọn ngân hàng</option>
                        <option value="Vietcombank">Vietcombank</option>
                        <option value="Techcombank">Techcombank</option>
                        <option value="BIDV">BIDV</option>
                        <option value="VietinBank">VietinBank</option>
                        <option value="ACB">ACB</option>
                        <!-- Thêm các ngân hàng khác ở đây -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="bank_account">Số Tài Khoản:</label>
                    <input type="text" id="bank_account" name="bank_account" required>
                </div>
                <div class="form-group">
                    <label for="account_holder">Tên Chủ Tài Khoản:</label>
                    <input type="text" id="account_holder" name="account_holder" required>
                </div>
                <button type="submit">Xác Nhận</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("withdrawModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("withdrawModal").style.display = "none";
        }

        document.querySelector(".close").addEventListener("click", closeModal);

        window.onclick = function(event) {
            if (event.target == document.getElementById("withdrawModal")) {
                closeModal();
            }
        }

        document.getElementById("withdrawForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const withdrawAmount = document.getElementById("withdraw_amount").value;
            const bankName = document.getElementById("bank_name").value;
            const bankAccount = document.getElementById("bank_account").value;
            const accountHolder = document.getElementById("account_holder").value;

            if (withdrawAmount < 100000) {
                alert("Số tiền rút phải ít nhất là 100,000 VND.");
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "process_withdraw.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    closeModal();
                    location.reload();
                }
            };
            xhr.send("withdraw_amount=" + withdrawAmount + "&bank_name=" + bankName + "&bank_account=" + bankAccount + "&account_holder=" + accountHolder);
        });
    </script>
</body>
</html>
