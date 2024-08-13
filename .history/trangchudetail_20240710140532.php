<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, phone FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['name'];
    $user_phone = $row['phone'];
} else {
    $user_name = "Người dùng";
    $user_phone = "Không có số điện thoại";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNS - AI TOOL</title>
    <link href="style/style5.css" rel="stylesheet">
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
                                <a href="customer.php?origin=trangchudetail" class="tk"><?php echo $user_phone; ?></a>
                                <a href="/hoahong.php" class="tk" onclick="openWalletPopup()">Tiền Hoa Hồng</a>
                                <div id="walletPopup" class="popup">
                                    <span class="closeWallet" onclick="closeWalletPopup()">&times;</span>
                                    <p>Số tiền trong ví của bạn:</p>
                                    <input type="text" id="walletInput" readonly>
                                </div>

                                <a href="#" class="tk" onclick="openPopupLink()">Link mời</a>
                                <div id="affiliatePopup" class="popup">
                                    <span class="closelink" onclick="closePopupLink()">&times;</span>
                                    <p>Đường link mời bạn bè:</p>
                                    <input type="text" id="affiliateLink" readonly>
                                    <button class="copy-button" onclick="copyToClipboard()">Copy</button>
                                </div>
                                
                                <a href="./trangchutaikhoan.php" class="tk">Đăng Xuất</a>
                            </ul>
                        </details>
                    </div>

                    <img src="./pic/BannerAITools.png" width="100%" height="100%" margin-bottom="3px">

                    <div id="my-popup" class="popup">
                        <div class="popup-content">
                            <!-- Nội dung của popup ở đây -->
                            <img class="logo" src="./pic/logo-01.png" height="80px" width="80px" alt="Thông Báo">
                            <p>Cảm ơn Bạn đã tin dùng website của VNS. Tham gia nhóm VIP để cập nhật thêm thông tin nhanh chóng.</p>
                            <a href="https://zalo.me/g/antgyd728">
                                <img id="zal" src="./pic/zal.png">
                            </a>
                            <!-- Nút đóng popup -->
                            <button id="close-popup">Đóng</button>
                        </div>
                    </div>

                    <div class="main">
                        <h2>DANH MỤC</h2>
                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/marketing.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Marketing</h3>
                                    <button onclick="redirectToMarketingPage()">Marketing</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/social-media.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>Social Media</h3>
                                    <button onclick="redirectToSocialMediaPage()">Social Media</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/data.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>Website&Funnel</h3>
                                    <button onclick="redirectToWebsiteandFunnelPage()">Website and Funnel</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/command.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>Prompts</h3>
                                    <button onclick="redirectToPromptsPage()">Prompts</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/innovation.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Business</h3>
                                    <button onclick="redirectToBusinessPage()">Business</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/crm.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>CRM Automation</h3>
                                    <button onclick="redirectToCRMAutomationPage()">CRM Automation</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/image.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>Art and Image</h3>
                                    <button onclick="redirectToArtandImagePage()">Art and Image</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/video-marketing.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>Video</h3>
                                    <button onclick="redirectToVideoPage()">Video</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/copy-writing.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Copy Writing</h3>
                                    <button onclick="redirectToCopyWritingPage()">Copy Writing</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/chatbot.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>AI assistant</h3>
                                    <button onclick="redirectToAIAssistantPage()">AI assistant</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/chatbot (1).png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>AI Chatbot</h3>
                                    <button onclick="redirectToAIChatbotPage()">AI Chatbot</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/seo.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>SEO</h3>
                                    <button onclick="redirectToSEOPage()">SEO</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/voice-assistant.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Email Assistant</h3>
                                    <button onclick="redirectToEmailAssistantPage()">Email Assistant</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/shopping-cart.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>E-commerce</h3>
                                    <button onclick="redirectToECommercePage()">E-commerce</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/customer-service.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>Customer Support</h3>
                                    <button onclick="redirectToCustomerSupportPage()">Customer Support</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/work-tools.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>Developer Tools</h3>
                                    <button onclick="redirectToDeveloperToolsPage()">Developer Tools</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/streaming.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Audio</h3>
                                    <button onclick="redirectToAudioPage()">Audio</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/artificial-intelligence.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>ChatGPT Plugins</h3>
                                    <button onclick="redirectToChatGPTPluginsPage()">ChatGPT Plugins</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/ai.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>ChatGPT Prompts</h3>
                                    <button onclick="redirectToChatGPTPromptsPage()">ChatGPT Prompts</button>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/bot.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>AI Trading Bots</h3>
                                    <button onclick="redirectToAITradingBotsPage()">AI Trading Bots</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <div class="footer">
            <p>Tổng hợp và sưu tập @aitoolsvietnamstartup</p>
        </div>
    </div>
    <script>
        function redirectToMarketingPage() {
            window.location.href = './detail/marketing.php';
        }

        function redirectToSocialMediaPage() {
            window.location.href = './detail/social.php';
        }

        function redirectToWebsiteandFunnelPage() {
            window.location.href = './detail/website.php';
        }

        function redirectToPromptsPage() {
            window.location.href = './detail/prompts.php';
        }

        function redirectToBusinessPage() {
            window.location.href = './detail/business.php';
        }

        function redirectToCRMAutomationPage() {
            window.location.href = './detail/crm.php';
        }

        function redirectToArtandImagePage() {
            window.location.href = './detail/art.php';
        }

        function redirectToVideoPage() {
            window.location.href = './detail/video.php';
        }

        function redirectToCopyWritingPage() {
            window.location.href = './detail/copy.php';
        }

        function redirectToAIAssistantPage() {
            window.location.href = './detail/aias.php';
        }

        function redirectToAIChatbotPage() {
            window.location.href = './detail/aichat.php';
        }

        function redirectToSEOPage() {
            window.location.href = './detail/seo.php';
        }

        function redirectToEmailAssistantPage() {
            window.location.href = './detail/email.php';
        }

        function redirectToECommercePage() {
            window.location.href = './detail/e.php';
        }

        function redirectToCustomerSupportPage() {
            window.location.href = './detail/customer.php';
        }

        function redirectToDeveloperToolsPage() {
            window.location.href = './detail/dev.php';
        }

        function redirectToAudioPage() {
            window.location.href = './detail/audio.php';
        }

        function redirectToChatGPTPluginsPage() {
            window.location.href = './detail/chatplug.php';
        }

        function redirectToChatGPTPromptsPage() {
            window.location.href = './detail/chatprompts.php';
        }

        function redirectToAITradingBotsPage() {
            window.location.href = './detail/aibot.php';
        }

        // Lấy tham chiếu đến popup và nút đóng
        const popup = document.getElementById('my-popup');
        const closeBtn = document.getElementById('close-popup');

        // Hàm hiển thị popup
        function showPopup() {
            popup.style.display = 'block';
        }

        // Hàm đóng popup
        function closePopup() {
            popup.style.display = 'none';
        }

        // Gán sự kiện nhấp chuột cho nút đóng
        closeBtn.addEventListener('click', closePopup);

        // Kích hoạt hiển thị popup khi cần
        // Ví dụ: bạn có thể gọi showPopup() sau khi tài khoản user được kích hoạt
        showPopup();

        // Lấy tên đăng nhập từ Local Storage và hiển thị trên trang
        const loggedInUser = "<?php echo $user_phone; ?>";
        if (loggedInUser) {
            const userElement = document.querySelector('.tk');
            userElement.textContent = loggedInUser;
        }

        // Hàm mở popupLink
        function openPopupLink() {
            var popup = document.getElementById('affiliatePopup');
            popup.style.display = 'block';

            // Lấy và hiển thị đường link mời bạn bè (cần thay đổi logic lấy đường link)
            var affiliateLink = generateAffiliateLink(loggedInUser); // Thay đổi thành logic lấy đường link thực tế
            document.getElementById('affiliateLink').value = affiliateLink;

            // Ẩn hiện phần logohead1 khi mở popup
            document.getElementById('logohead1').style.display = 'none';
        }


        // Hàm đóng popupLink
        function closePopupLink() {
            var popup = document.getElementById('affiliatePopup');
            popup.style.display = 'none';

            // Hiển thị lại phần logohead1 khi đóng popup
            document.getElementById('logohead1').style.display = 'block';
        }

        // Hàm sao chép đường link vào clipboard và kiểm tra, chuyển hướng
        function copyToClipboard() {
            if (loggedInUser) {
                // Lấy danh sách số điện thoại đã được mời từ Local Storage
                const invitedPhoneNumbers = JSON.parse(localStorage.getItem('invitedPhoneNumbers')) || [];

                // Kiểm tra xem số điện thoại đã được mời hay chưa
                if (!invitedPhoneNumbers.includes(loggedInUser)) {
                    // Nếu số điện thoại chưa được mời, thực hiện các hành động sau:

                    // ... (code kiểm tra và chuyển hướng)

                    // Thực hiện hàm sao chép
                    var linkInput = document.getElementById('affiliateLink');
                    linkInput.select();
                    document.execCommand('copy');

                    // Thêm số điện thoại vào danh sách đã được mời
                    invitedPhoneNumbers.push(loggedInUser);
                    localStorage.setItem('invitedPhoneNumbers', JSON.stringify(invitedPhoneNumbers));

                    // Hiển thị thông báo mời thành công
                    // alert("Bạn đã mời thành công!");

                    // Hiển thị thông báo hoa hồng (có thể thêm vào hàm showCommissionMessage nếu cần)
                    // alert("Bạn nhận được 15% hoa hồng.\nTổng tiền hoa hồng: 40,200 VND");
                } else {
                    // Nếu số điện thoại đã được mời, hiển thị thông báo
                    // Thực hiện hàm sao chép
                    var linkInput = document.getElementById('affiliateLink');
                    linkInput.select();
                    document.execCommand('copy');

                    // Thêm số điện thoại vào danh sách đã được mời
                    invitedPhoneNumbers.push(loggedInUser);
                    localStorage.setItem('invitedPhoneNumbers', JSON.stringify(invitedPhoneNumbers));
                    // alert("Số điện thoại đã được mời trước đó. Bạn sẽ không nhận được hoa hồng lần này.");
                }
            }
        }

        // Hàm tạo đường liên kết Affiliate
        function generateAffiliateLink(phoneNumber) {
            // Tạo đường liên kết Affiliate dựa trên số điện thoại người dùng và URL cố định
            const encodedPhoneNumber = encodeURIComponent(phoneNumber); // Đảm bảo chuỗi an toàn cho URL
            return `http://ai-local.com:8091/dangky.php?referrer_phone=${encodedPhoneNumber}`;
        }



        //Disable text selection and right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });

    </script>

</body>

</html>
