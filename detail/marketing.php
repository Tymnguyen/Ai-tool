<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['name'];
} else {
    $user_name = "Người dùng";
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
    <link rel="shortcut icon" href="../pic/link.png" type="image/x-icon" id="pageTitle">
    <link href="style/stylesmakerting.css" rel="stylesheet">
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
                        <img src="../pic/VNS logo ngang xóa nền.png" height="120px" , width="300px">
                    </div>

                    <div class="logohead1">
                        <details>
                            <summary>
                                <img src="../pic/menu1.png" height="40px" , width="50px" , margin-bottom="50px">
                            </summary>
                            <ul>
                                <a href="../customer.php?origin=marketing" class="tk"><?php echo $user_name; ?></a>
                                <a href="../trangchudetail.php" class="tk">Thoát</a>
                                <a href="../trangchutaikhoan.php" class="tk">Đăng Xuất</a>
                            </ul>
                        </details>
                    </div>

                    <img src="../pic/BannerAITools.png" width="100%" , height="100%" , margin-bottom="3px">

                    <div class="main">
                        <h2>Marketing</h2>
                        <img src="./img/swap.png" id="layout-toggle" class="layout-toggle-button" alt="Chuyển đổi Chế Độ">
                        <img src="./img/left.png" id="prev-card" alt="Trái">
                        <div class="card-container vertical-layout">
                            <div class="card">
                                <img src="./img/tugan.png" class="card-img">
                                <h3>Marketing content</h3>
                                <p>Tự động tạo ra email tiếp thị, tweet và chuỗi bài viết với trí tuệ nhân tạo, nhập URL hoặc CHỦ ĐỀ.</p>
                                <a href="https://www.tugan.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/flow.png" class="card-img">
                                <h3>AI Marketing Analytics</h3>
                                <p>Phân tích dữ liệu là một thách thức; flowpoint.ai làm cho nó trở nên đơn giản. Sử dụng trí tuệ nhân tạo để cải thiện tỷ lệ chuyển đổi, ưu tiên các giải pháp hữu ích và tăng ROI thông qua các lựa chọn dựa trên dữ liệu. Tìm những mẹo thực tế để tối đa hóa tiềm năng của trang web của bạn. Sử dụng trí tuệ nhân tạo cho phân tích đa lĩnh vực, các gợi ý được cung cấp bởi trí tuệ nhân tạo, thu thập sự kiện của người dùng và tối ưu hóa tỷ lệ chuyển đổi.</p>
                                <a href="https://flowpoint.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/jas.png" class="card-img">
                                <h3>Content & Copywriting</h3>
                                <p>Tạo ra các bài viết blog, nghệ thuật và hình ảnh tuyệt vời, bản sao tiếp thị, email bán hàng, nội dung SEO, quảng cáo Facebook, nội dung web, chú thích, kịch bản video nhanh hơn 10 lần với trí tuệ nhân tạo. Jasper là Trình tạo nội dung AI giúp bạn và đội ngũ của bạn vượt qua những trở ngại sáng tạo để tạo ra nội dung tuyệt vời, độc đáo nhanh hơn 10 lần.</p>
                                <a href="https://www.jasper.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/cre.png" class="card-img">
                                <h3>Creatives & Copywriting</h3>
                                <p>Với sự hỗ trợ của trí tuệ nhân tạo, AdCreative.ai nâng cao tiềm năng tiếp thị của bạn chỉ trong vài giây. Vượt qua đối thủ một bước với sự trợ giúp của trình tạo văn bản trí tuệ nhân tạo và thông tin thời gian thực về thành công của chiến dịch tiếp thị của bạn. Công cụ trí tuệ nhân tạo sẽ tiếp tục học tập và trở nên tốt hơn mỗi ngày. Bạn có thể tạo ra một lượng bài viết vô tận trong thời gian ngắn và tăng tỷ lệ chuyển đổi lên 14 lần.</p>
                                <a href="https://www.adcreative.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/content.png" class="card-img">
                                <h3>Content</h3>
                                <p>Cosmos AI là công cụ tạo nội dung trí tuệ nhân tạo toàn diện của bạn. Tạo ra nội dung quan trọng nhất; cho dù đó là bài viết blog, chú thích truyền thông xã hội, hình ảnh AI, chuyển giọng thành văn bản,</p>
                                <a href="https://cosmosai.digital/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/invi.png" class="card-img">
                                <h3>Vedio editor</h3>
                                <p>Tạo video chuyên nghiệp một cách dễ dàng. Với hơn 6000+ mẫu, hơn 8 triệu phương tiện chung, chuyển văn bản thành video AI và tính năng chỉnh sửa video có thể được tùy chỉnh nhanh chóng ngay cả bởi những người không có kiến thức trước đó, InVideo làm cho quá trình tạo video trở nên đơn giản.</p>
                                <a href="https://invideo.io/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/gege.png" class="card-img">
                                <h3>SEO & Copywrtiting</h3>
                                <p>GETgenie là trợ lý SEO AI toàn diện của bạn. Bằng cách tập trung tất cả khả năng bạn cần vào một ứng dụng WordPress duy nhất, GetGenie AI hoạt động như ma thuật, tiết kiệm thời gian và tiền bạc cho bạn so với việc sử dụng 10+ công cụ khác. Vượt qua đối thủ với nghiên cứu cạnh tranh SERP và tối ưu hóa trò chơi SEO của bạn. Các bài viết blog và bản sao tiếp thị được hỗ trợ bởi trí tuệ nhân tạo, tận dụng cơ hội SEO với phân tích từ khóa SEO được hỗ trợ bởi trí tuệ nhân tạo.</p>
                                <a href="https://getgenie.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/sin.png" class="card-img">
                                <h3>SEO & Copywrtiting</h3>
                                <p>SinCode làm cho nội dung viết bằng trí tuệ nhân tạo của bạn trở nên gần gũi hơn để bạn không bị đánh giá tiêu cực từ Google. SinCode sẽ giúp bạn tăng cường SEO và tất cả các loại nội dung viết. Tạo nội dung tối ưu hóa SEO không vi phạm bản quyền cho blog, bài viết, trang web, email và tất cả các loại nội dung viết nhanh hơn 10 lần.</p>
                                <a href="https://www.sincode.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/nan.png" class="card-img">
                                <h3>Content & Copywriting</h3>
                                <p>Tạo bản sao chuyển đổi cao cho doanh nghiệp trực tuyến của bạn chỉ trong vài giây. Khám phá hơn 60 công cụ mạnh mẽ để tạo ra mô tả sản phẩm hấp dẫn, kịch bản video, khái niệm quảng cáo, bản sao, bài viết blog, nội dung truyền thông xã hội và nhiều hơn nữa.</p>
                                <a href="https://nando.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/repu.png" class="card-img">
                                <h3>Social Media Distribution</h3>
                                <p>Mở rộng khán giả của bạn với Repurpose.IO. Đơn giản hóa quy trình làm việc với nội dung và tập trung vào việc tạo ra nội dung tuyệt vời. Xây dựng mặt trực tuyến của bạn nhanh chóng và mở rộng khán giả của bạn trên nhiều nền tảng một cách dễ dàng.</p>
                                <a href="https://repurpose.io/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/pic.png" class="card-img">
                                <h3>Video</h3>
                                <p>Tự động tạo ra video ngắn, tập trung vào thương hiệu và dễ dàng chia sẻ từ nội dung dài của bạn. Đơn giản, tiết kiệm chi phí và không cần chuyên môn kỹ thuật hoặc cài đặt phần mềm.</p>
                                <a href="https://pictory.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/syn.jpg" class="card-img">
                                <h3>Video</h3>
                                <p>Synthesia.io cho phép bạn chuyển đổi văn bản đơn giản thành video chỉ trong vài giây. Đây hiện đang là một trong những nền tảng tốt nhất để tạo ra video trí tuệ nhân tạo.</p>
                                <a href="https://www.synthesia.io/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/gohi.png" class="card-img">
                                <h3>CRM & Automation</h3>
                                <p>High-level giúp bạn quản lý quy trình bán hàng hiệu quả hơn với công nghệ trí tuệ nhân tạo tiên tiến. Nền tảng này cung cấp một cái nhìn tổng thể về tất cả hoạt động bán hàng của bạn, giúp bạn đưa ra quyết định có căn cứ trong thời gian thực.</p>
                                <a href="https://www.gohighlevel.com/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/cop.png" class="card-img">
                                <h3>SEO & Copywriting</h3>
                                <p>Copy.ai cung cấp cách nhanh nhất và hiệu quả nhất để tạo ra nội dung chất lượng cao.</p>
                                <a href="https://www.copy.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/content.png" class="card-img">
                                <h3>Social Media Bot</h3>
                                <p>Tối ưu quản lý mạng xã hội của bạn với ContentStudio.io. Hãy tổ chức và tối đa hóa năng suất với nền tảng dễ sử dụng cho phép bạn lập kế hoạch, tạo ra và lên lịch đăng các bài viết thu hút mắt cho các kênh phù hợp vào thời điểm tối ưu nhất.</p>
                                <a href="https://contentstudio.io/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/ma.png" class="card-img">
                                <h3>Marketing</h3>
                                <p>"Trợ lý Marketing trí tuệ nhân tạo" giống con người toàn diện.</p>
                                <a href="https://marketingblocks.ai/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/zopto.png" class="card-img">
                                <h3>LinkedIn Lead Generation</h3>
                                <p>Zopto là công cụ tự động hóa LinkedIn hàng đầu giúp bạn mở rộng các nỗ lực bán hàng và tiếp cận khách hàng tiềm năng.</p>
                                <a href="https://zopto.com/" target="_blank"><button class="truycap card-button">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/make.png" class="card-img">
                                <h3>Automation</h3>
                                <p>Thay đổi cách bạn làm việc với sức mạnh của tự động hóa trên một nền tảng hình ảnh duy nhất. Xây dựng và tự động hóa bất cứ điều gì từ nhiệm vụ và quy trình công việc đến ứng dụng và hệ thống một cách dễ dàng. Nói lời tạm biệt với nhiều nền tảng và chào mừng tích hợp mượt mà, với hàng ngàn tích hợp ứng dụng sẵn có và khả năng kết nối với bất kỳ ứng dụng trực tuyến nào bằng công cụ không cần mã mạnh mẽ của chúng tôi. Tối ưu quy trình của bạn và tối đa hóa năng suất với Make.com.</p>
                                <a href="https://www.make.com/en" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/snov.png" class="card-img">
                                <h3>Outreach Automation</h3>
                                <p>Snov.io là công cụ toàn diện cho việc tiếp cận và tạo ra cơ hội khách hàng tiềm năng, giúp bạn tối ưu hóa công việc bán hàng và tiếp thị. Với những tính năng mạnh mẽ như xác minh email, tìm kiếm email và bộ lọc tìm kiếm tiên tiến, Snov.io giúp dễ dàng tìm kiếm và tiếp cận khán giả mục tiêu của bạn. Cho dù bạn đang tìm cách xây dựng danh sách email, tạo cơ hội tiếp thị hay phát triển doanh nghiệp của bạn, Snov.io cung cấp các công cụ bạn cần để thành công.</p>
                                <a href="https://snov.io/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>

                            <div class="card">
                                <img src="./img/ber.png" class="card-img">
                                <h3>SEO & Copywriting</h3>
                                <p>Để làm say đắm khán giả của bạn và tăng tỷ lệ chuyển đổi, hãy sử dụng kỹ năng sản xuất văn bản tiếp thị lôi cuốn của Bertha. Bertha giúp tạo ra nội dung chất lượng cao cho trang web của bạn một cách nhanh chóng hơn so với việc làm thủ công.</p>
                                <a href="https://bertha.ai/" target="_blank"><button class="truycap">Truy Cập Ngay</button></a>
                            </div>
                        </div>
                        <img src="./img/next.png" id="next-card" alt="Phải">
                    </div>
                </div>

            </div>
        </section>

        <div class="footer">
            <p>Tổng hợp và sưu tập @aitoolsvietnamstartup</p>
        </div>
    </div>
    <script>
    //Disable text selection and right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
        // Lấy tên đăng nhập từ Local Storage và hiển thị trên trang
        const loggedInUserName = localStorage.getItem('loggedInUserName');
        if (loggedInUserName) {
            const userElement = document.querySelector('.tk');
            userElement.textContent = loggedInUserName;
        }

        const layoutToggle = document.getElementById('layout-toggle');
        const prevCardButton = document.getElementById('prev-card');
        const nextCardButton = document.getElementById('next-card');
        const cardContainer = document.querySelector('.card-container');
        const cards = document.querySelectorAll('.card');
        let currentCardIndex = 0;

        // Hàm hiển thị thẻ card tại vị trí được chỉ định
        function showCard(index) {

            // Hiển thị tất cả các card theo chiều dọc
            cards.forEach((card) => {
                card.style.display = 'none';
            });

            // Hiển thị thẻ card tại vị trí được chỉ định
            cards[index].style.display = 'block';
            currentCardIndex = index;
        }

        layoutToggle.addEventListener('click', function() {
            // Kiểm tra trạng thái hiện tại và đảo ngược nó
            if (cardContainer.classList.contains('horizontal-layout')) {
                cardContainer.classList.remove('horizontal-layout');
                cardContainer.classList.add('vertical-layout');

                // Ẩn các nút lật qua trái và phải khi chuyển sang chế độ dọc
                prevCardButton.style.display = 'none';
                nextCardButton.style.display = 'none';

                // Hiển thị tất cả các card theo chiều dọc
                cards.forEach((card) => {
                    card.style.display = 'block';
                });
            } else {
                cardContainer.classList.remove('vertical-layout');
                cardContainer.classList.add('horizontal-layout');

                // Ẩn tất cả các thẻ card
                cards.forEach((card) => {
                    card.style.display = 'none';
                });

                // Hiển thị lại nút lật qua trái và phải khi chuyển đổi chế độ
                prevCardButton.style.display = 'inline-block';
                nextCardButton.style.display = 'inline-block';

                // Hiển thị duy nhất card đầu tiên khi chuyển đổi chế độ ngang
                showCard(1);

            }
        });

        // Hàm để lật qua trái
        function slideLeft() {
            currentCardIndex = (currentCardIndex - 1 + cards.length) % cards.length;
            showCard(currentCardIndex);
        }

        // Hàm để lật qua phải
        function slideRight() {
            currentCardIndex = (currentCardIndex + 1) % cards.length;
            showCard(currentCardIndex);
        }

        prevCardButton.addEventListener('click', slideLeft);
        nextCardButton.addEventListener('click', slideRight);
    </script>
</body>

</html>
