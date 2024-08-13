<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);

if ($is_logged_in) {
    include 'db.php';

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    $username = isset($user['username']) ? $user['username'] : 'Người dùng';
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="VNS - AI TOOL">
    <meta property="og:description" content="Tổng hợp 200 Công cụ AI đáp ứng mọi nhu cầu của bạn.">
    <meta property="og:image" content="./pic/bg.png">
    <meta property="og:url" content="https://aitools.vietnamstartup.io">
    <title>VNS - AI TOOL</title>
    <link rel="shortcut icon" href="./pic/link.png" type="image/x-icon" id="pageTitle">
    <link href="style/style4.css" rel="stylesheet">
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
                        <img src="./pic/VNS logo ngang xóa nền.png" height="120px" , width="300px">
                    </div>

                    <div class="logohead1">
                        <details>
                            <summary>
                                <img src="./pic/menu1.png" height="40px" , width="50px" , margin-bottom="50px">
                            </summary>
                            <ul>
                            <?php if (!$is_logged_in): ?>
                                    <a href="./dangnhap.php" class="tk">Đăng Nhập</a>
                                    <a href="./dangky.php" class="tk">Đăng Ký</a>
                                <?php else: ?>
                                    <a href="./dangnhap.php" class="tk">Đăng Nhập</a>
                                    <a href="./dangky.php" class="tk">Đăng Ký</a>
                                <?php endif; ?>
                            </ul>
                        </details>
                    </div>
                </div>

                <img src="./pic/BannerAITools.png" width="100%" , height="100%" , margin-bottom="3px">

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
        </section>

        <div class="footer">
            <p>Tổng hợp và sưu tập @aitoolsvietnamstartup</p>
        </div>
    </div>
    <script>
    function redirectToLoginPage() {
        window.location.href = './dangnhap.php';
    }

    function redirectToMarketingPage() {
        redirectToLoginPage();
    }

    function redirectToSocialMediaPage() {
        redirectToLoginPage();
    }

    function redirectToWebsiteandFunnelPage() {
        redirectToLoginPage();
    }

    function redirectToPromptsPage() {
        redirectToLoginPage();
    }

    function redirectToBusinessPage() {
        redirectToLoginPage();
    }

    function redirectToCRMAutomationPage() {
        redirectToLoginPage();
    }

    function redirectToArtandImagePage() {
        redirectToLoginPage();
    }

    function redirectToVideoPage() {
        redirectToLoginPage();
    }

    function redirectToCopyWritingPage() {
        redirectToLoginPage();
    }

    function redirectToAIAssistantPage() {
        redirectToLoginPage();
    }

    function redirectToAIChatbotPage() {
        redirectToLoginPage();
    }

    function redirectToSEOPage() {
        redirectToLoginPage();
    }

    function redirectToEmailAssistantPage() {
        redirectToLoginPage();
    }

    function redirectToECommercePage() {
        redirectToLoginPage();
    }

    function redirectToCustomerSupportPage() {
        redirectToLoginPage();
    }

    function redirectToDeveloperToolsPage() {
        redirectToLoginPage();
    }

    function redirectToAudioPage() {
        redirectToLoginPage();
    }

    function redirectToChatGPTPluginsPage() {
        redirectToLoginPage();
    }

    function redirectToChatGPTPromptsPage() {
        redirectToLoginPage();
    }

    function redirectToAITradingBotsPage() {
        redirectToLoginPage();
    }

    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    document.addEventListener('selectstart', function(e) {
        e.preventDefault();
    });

    function openPopupLink() {
        var popup = document.getElementById('affiliatePopup');
        popup.style.display = 'block';

        var affiliateLink = generateAffiliateLink('<?php echo $username; ?>');
        document.getElementById('affiliateLink').value = affiliateLink;
    }

    function closePopupLink() {
        var popup = document.getElementById('affiliatePopup');
        popup.style.display = 'none';
    }

    function copyToClipboard() {
        var linkInput = document.getElementById('affiliateLink');
        linkInput.select();
        document.execCommand('copy');
        alert("Đã sao chép đường link!");
    }

    function generateAffiliateLink(username) {
        const encodedUsername = encodeURIComponent(username);
        return `https://aitools.vietnamstartup.io/?ref=${encodedUsername}`;
    }
</script>


</body>

</html>
