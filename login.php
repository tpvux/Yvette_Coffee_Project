<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Đăng nhập hệ thống</title>
</head>
<body>
    <?php
        $usernameTxt = 2023000001;
        $passwordTxt = md5(md5(123456)); 

        require_once "db_connect1.php";
        $sql = "SELECT * FROM `tai_khoan` WHERE `TenDangNhap` = ? AND `MatKhau` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $usernameTxt, $passwordTxt);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0)
        {
            ?>
            <script>
                alert("Đăng nhập thành công");
            </script>
            <?php
            
        }
        else
        {
            ?>
            <script>
                alert("Sai tài khoản hoặc mật khẩu. Vui lòng nhập lại");
            </script>
            <?php
        }
        mysqli_close($conn);
        ?>
</body>
</html>