<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thành Công</title>
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
                    <h2><?php echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Thao tác thành công!'; ?></h2>
                </div>
            </div>
        </section>
    </div>
    <script>
        setTimeout(() => {
            window.location.href = '<?php echo isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : 'dangnhap.php'; ?>';
        }, 1500); 
    </script>
</body>
</html>
