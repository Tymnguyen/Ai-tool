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
    $user_phone = "";
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
    <link rel="shortcut icon" href="./pic/link.png" type="image/x-icon" id="pageTitle">
    <link href="style/style3.css" rel="stylesheet"> 
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
                        <details class="details-menu">
                            <summary>
                                <img src="./pic/menu1.png" height="40px" , width="50px" , margin-bottom="50px">
                            </summary>
                            <ul>
                                <a href="customer.php?origin=trangchuthanhtoan" class="tk"><?php echo $user_phone; ?></a>
                                <a href="#" class="tk" onclick="openPopupLink()">Link mời</a>
                                <div id="affiliatePopup" class="popup">
                                    <span class="closelink" onclick="closePopupLink()">&times;</span>
                                    <p>Đường link mời bạn bè:</p>
                                    <input type="text" id="affiliateLink" readonly>
                                    <button class="copy-button" onclick="copyToClipboard()">Copy</button>
                                </div>
                                <a href="./logout.php" class="tk">Đăng Xuất</a>
                            </ul>
                        </details> 
                    </div>
                    <img src="./pic/BannerAITools.png" width="100%" , height="100%" , margin-bottom="3px">
                    <div class="main">
                        <h2>DANH MỤC</h2>
                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/marketing.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Marketing</h3>
                                    <button id="open-popup-Marketing">Marketing</button>
                                    <div id="popup-Marketing" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" width="70px">

                                            <!-- Các phần tử cần ẩn/hiển thị -->
                                            <p id="contentToHide" style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3 id="amountToHide">Số tiền cần thanh toán: 268.000VND</h3>
                                            <p id="messageToHide" style="margin-bottom: 10px;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/social-media.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>Social Media</h3>
                                    <button id="open-popup-SocialMedia">Social Media</button>
                                    <div id="popup-SocialMedia" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom: 10px;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>

                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/data.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>Website&Funnel</h3>
                                    <button id="open-popup-WebsiteandFunnel">Website and Funnel</button>
                                    <div id="popup-WebsiteandFunnel" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/command.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>Prompts</h3>
                                    <button id="open-popup-Prompts">Prompts</button>
                                    <div id="popup-Prompts" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>

                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/innovation.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Business</h3>
                                    <button id="open-popup-Business">Business</button>
                                    <div id="popup-Business" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/crm.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>CRM Automation</h3>
                                    <button id="open-popup-CRMAutomation">CRM Automation</button>
                                    <div id="popup-CRMAutomation" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/image.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>Art and Image</h3>
                                    <button id="open-popup-ArtAndImage">Art and Image</button>
                                    <div id="popup-ArtAndImage" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/video-marketing.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>Video</h3>
                                    <button id="open-popup-Video">Video</button>
                                    <div id="popup-Video" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>

                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/copy-writing.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Copy Writing</h3>
                                    <button id="open-popup-CopyWriting">Copy Writing</button>
                                    <div id="popup-CopyWriting" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/chatbot.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>AI assistant</h3>
                                    <button id="open-popup-AIAssistant">AI assistant</button>
                                    <div id="popup-AIAssistant" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/chatbot (1).png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>AI Chatbot</h3>
                                    <button id="open-popup-AIChatbot">AI Chatbot</button>
                                    <div id="popup-AIChatbot" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/seo.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>SEO</h3>
                                    <button id="open-popup-SEO">SEO</button>
                                    <div id="popup-SEO" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/voice-assistant.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Email Assistant</h3>
                                    <button id="open-popup-EmailAssistant">Email Assistant</button>
                                    <div id="popup-EmailAssistant" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/shopping-cart.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>E-commerce</h3>
                                    <button id="open-popup-E-Commerce">E-commerce</button>
                                    <div id="popup-E-Commerce" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/customer-service.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>CustomerSupport</h3>
                                    <button id="open-popup-CustomerSupport">Customer Support</button>
                                    <div id="popup-CustomerSupport" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/work-tools.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>Developer Tools</h3>
                                    <button id="open-popup-DeveloperTools">Developer Tools</button>
                                    <div id="popup-DeveloperTools" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-container">
                            <div class="card">
                                <img src="./pic/streaming.png" alt="Image 1" class="card-img">
                                <div class="card-content">
                                    <h3>Audio</h3>
                                    <button id="open-popup-Audio">Audio</button>
                                    <div id="popup-Audio" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/artificial-intelligence.png" alt="Image 2" class="card-img">
                                <div class="card-content">
                                    <h3>ChatGPT Plugins</h3>
                                    <button id="open-popup-ChatGPTPluggins">ChatGPT Plugins</button>
                                    <div id="popup-ChatGPTPluggins" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px; ">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="card">
                                <img src="./pic/ai.png" alt="Image 3" class="card-img">
                                <div class="card-content">
                                    <h3>ChatGPTPrompts</h3>
                                    <button id="open-popup-ChatGPTPrompts">ChatGPT Prompts</button>
                                    <div id="popup-ChatGPTPrompts" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <img src="./pic/bot.png" alt="Image 4" class="card-img">
                                <div class="card-content">
                                    <h3>AI Trading Bots</h3>
                                    <button id="open-popup-AITradingBots">AI Trading Bots</button>
                                    <div id="popup-AITradingBots" class="popup">
                                        <div class="popup-content">
                                            <img class="close-popup" src="./pic/x-mark.png" height="70px" , width="70px">
                                            <p style="margin-bottom: 10px;">Nội dung chuyển khoản: <?php echo $user_name; ?></p>
                                            <h3>Số tiền cần thanh toán: 268.000VND</h3>
                                            <p style="margin-bottom:10px ;">Vui lòng thực hiện thanh toán để sử dụng dịch vụ</p>
                                            <a href="transactions.php">
                                                <button id="local-bank-btn" class="button1">Tiến Hành Thanh Toán</button>
                                            </a>
                                            <a id="zalo" href="https://zalo.me/0332120339">Truy cập khi cần hỗ trợ</a>
                                            <a href="javascript:void(0);" onclick="checkPasswordAndRedirect()">
                                                <img id="home" src="./pic/home.png">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
    </div>
    <div class="footer">
        <p>Tổng hợp và sưu tập @aitoolsvietnamstartup</p>
    </div>
    <script>
        // JavaScript để hiển thị và đóng popup
        const openPopupButtons = document.querySelectorAll('[id^=open-popup-]');
        const closePopupButtons = document.querySelectorAll('.close-popup');
        const popups = document.querySelectorAll('.popup');

        openPopupButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetPopupId = button.id.replace('open-popup-', 'popup-');
                const targetPopup = document.getElementById(targetPopupId);
                targetPopup.style.display = 'block';
            });
        });

        closePopupButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetPopup = button.closest('.popup');
                targetPopup.style.display = 'none';
            });
        });

        // Hàm mở popupLink
        function openPopupLink() {
            var popup = document.getElementById('affiliatePopup');
            popup.style.display = 'block';

            var affiliateLink = generateAffiliateLink(loggedInUser); // Thay đổi thành logic lấy đường link thực tế
            document.getElementById('affiliateLink').value = affiliateLink;

            document.getElementById('logohead1').style.display = 'none';
        }

        // Hàm đóng popupLink
        function closePopupLink() {
            var popup = document.getElementById('affiliatePopup');
            popup.style.display = 'none';

            document.getElementById('logohead1').style.display = 'block';
        }

        // Hàm sao chép đường link vào clipboard và kiểm tra, chuyển hướng
        function copyToClipboard() {
            const loggedInUser = '<?php echo $user_name; ?>';

            if (loggedInUser) {
                const invitedPhoneNumbers = JSON.parse(localStorage.getItem('invitedPhoneNumbers')) || [];

                if (!invitedPhoneNumbers.includes(loggedInUser)) {
                    var linkInput = document.getElementById('affiliateLink');
                    linkInput.select();
                    document.execCommand('copy');

                    invitedPhoneNumbers.push(loggedInUser);
                    localStorage.setItem('invitedPhoneNumbers', JSON.stringify(invitedPhoneNumbers));

                    alert("Đường liên kết Affiliate đã được sao chép thành công!");
                } else {
                    var linkInput = document.getElementById('affiliateLink');
                    linkInput.select();
                    document.execCommand('copy');

                    invitedPhoneNumbers.push(loggedInUser);
                    localStorage.setItem('invitedPhoneNumbers', JSON.stringify(invitedPhoneNumbers));
                }
            }
        }

        // Hàm tạo đường liên kết Affiliate
        function generateAffiliateLink(phoneNumber) {
            const encodedPhoneNumber = encodeURIComponent(phoneNumber);
            return `http://aitools.vietnamstartup.io/`;
        }

        function openWalletPopup() {
            document.getElementById('walletPopup').style.display = 'block';
        }

        function closeWalletPopup() {
            document.getElementById('walletPopup').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const localBankBtn = document.getElementById('local-bank-btn');
            const qrImage = document.getElementById('myImage');
            const paymentSuccessMsg = document.getElementById('payment-success');

            localBankBtn.addEventListener('click', function() {
                if (qrImage.classList.contains('hidden')) {
                    qrImage.classList.remove('hidden');
                    paymentSuccessMsg.classList.remove('hidden');
                    paymentSuccessMsg.innerHTML = ` Nội dung chuyển khoản: ${loggedInUser} <br>
                                                    Số tiền thanh toán: 268.000VND <br>
                                                Sau khi thanh toán, vui lòng chờ duyệt.`;
                } else {
                    qrImage.classList.add('hidden');
                    paymentSuccessMsg.classList.add('hidden');
                }
            });
        });

        // Kiểm tra tên người dùng và chuyển hướng
            function kiemTraSoDienThoaiVaChuyenHuong() {
            const danhSachSoDienThoaiAdmin = ["0332120339", "0925824825", "0988303618", "0973468572", "0846334848", "0387855465", "0559313040", "0942410809", "0344995801"];

            if (danhSachSoDienThoaiAdmin.includes('<?php echo $user_phone; ?>')) {
                alert('<?php echo $user_name; ?> đã được duyệt! Nhấp vào "OK" để vào trang sản phẩm.');
                window.location.href = "trangchudetail.php";
            } else {
                window.location.href = "trangchuthanhtoan.php";
            }
        }

        window.onload = kiemTraSoDienThoaiVaChuyenHuong;



        // Kiểm tra <?php echo $user_phone; ?> và chuyển hướng trang
        function checkPhoneNumberAndRedirect() {
            if (hasCheckedAndRedirected) {
                return;
            }

            var adminPhoneNumbers = ["0332120339", "0925824825", "0988303618", "0973468572", "0846334848", "0387855465", "0559313040", "0942410809", "0344995801"];

            if (adminPhoneNumbers.includes('<?php echo $user_id; ?>')) {
                alert('<?php echo $user_name; ?> đã được duyệt! Mời bạn nhấp chọn "OK" để vào trang sản phẩm.');
                window.location.href = "./<?php echo $user_id; ?>/trangchudetail.php";
            } else {
                window.onload = checkhasCheckedAndRedirected;
                window.location.href = "/trangchuthanhtoan.php";
            }

            hasCheckedAndRedirected = true;
        }
        window.onload = checkPhoneNumberAndRedirect;

        document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        });

        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
    </script>

</body>
</html>
