<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="images/img/logo2.png">
    <title>Yvette Coffee & Milk Tea</title>
    <!-- Custom css -->
    <link rel="stylesheet" href="yvette_style.css">
    <link rel="stylesheet" href="swiper-bundle.min.css"/>
    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
</head>
<body>
    <?php
        session_start();
        $usernameTxt = $_POST["uname"];
        $passwordTxt = md5(md5($_POST["psw"])).""; 

        require_once "db_connect.php";
        $sql = "SELECT * FROM tai_khoan WHERE TenDangNhap = ? AND MatKhau = ?";       
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $usernameTxt, $passwordTxt );
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0)
            {
                $sql1 = "SELECT * FROM nhan_vien WHERE MaNV=$usernameTxt";
                $result = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($result);
                $_SESSION["status"] = 'Success';
                $_SESSION["username"] =  $usernameTxt;
                $_SESSION["password"] =  $passwordTxt;
                $_SESSION["name"] = $row["TenNV"];
                $_SESSION["chucvu"] = $row["ChucVu"];
                ?>
                <script>
                    alert("Đăng nhập thành công");
                    location.assign("./index.php");
                </script>
                <?php
            }
        else
            {
                ?>
                <script>
                    alert("Sai tên đăng nhập hoặc mật khẩu. Vui lòng nhập lại");
                    location.assign("./index.php");
                </script>
                <?php
            }
       
        mysqli_close($conn);
        ?>
</body>
</html>