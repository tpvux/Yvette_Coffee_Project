<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="./images/img/logo2.png">
    <title>Thêm NL</title>
    
    <!-- Custom css -->
    <style>
    body{
        font-family: 'Montserrat', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        top: 80px;
    }
   
    .feed-form{
        width: 713px;
        height: 500px;
        padding: 0 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        box-shadow: 0px 0px 0px 4px rgba(52, 52, 53, 0.185);
        border-radius: 5px;
    }
    .input-row{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .input-row .input-group{
        flex-basis: 45%;
    }

    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100px;
        height: 33px;   
        font-size: 12px;
        background-color: #4CAF50;
        color: white;
        padding: 0.5em 2em;;
        margin: 8px 0;
        border: transparent;
        box-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }


    .feed-form .btn{
        margin-top: 5px;
    }

    button {
        width: 100px;
        height: 33px;
        font-size: 12px;
        color: white;
        padding: 0.5em 2em;
        border: transparent;
        box-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        background: dodgerblue;    
        border-radius: 4px;
    }

    button:hover {
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(30,144,255,1) 0%, rgba(0,212,255,1) 100%);
    }

    button:active {
        transform: translate(0em, 0.2em);
    }

    a{
        text-decoration: none;
        color: white;
    }

    </style>

</head>
<body>
    <?php
        session_start();
        require_once "./db_connect.php";
        date_default_timezone_set("Asia/Ho_Chi_Minh"); $date = date('Y-m-d G:i:s');
        if(isset($_POST["themNL"])){
            $maNL = $_POST["maNL"];
            $tenNL = $_POST["tenNL"];
            $donvi = $_POST["donvi"];
            $soluong = $_POST["soluong"];
            $nghiepvu = 2;
            $manv = $_SESSION["username"];
            $tennv =  $_SESSION["name"];
            if( $maNL != "" && $tenNL != "" && $donvi != "" && $soluong != ""){
                $sql1 = "INSERT INTO nhap_xuat_nl(`MaNguoiNX`, `TenNguoiNX`, `NghiepVu`, `MaNL`, `TenNL`, `SoLuongNX`, `ThoiGianNX`) 
                VALUES ('$manv','$tennv','$nghiepvu','$maNL','$tenNL','$soluong','$date')";
                $result1 = mysqli_query($conn, $sql1); 
               /* $row1= mysqli_fetch_array($result1);*/
                /*echo $row1["$nghiepvu"] . $row1["$soluong"] . $row1["$maNL"] . $row1["$manv"];*/


                $sql = "INSERT INTO nguyen_lieu(MaNL, TenNL, DonVi, SoLuongNL) VALUES('$maNL', '$tenNL', '$donvi', '$soluong')"; 
                    $result = mysqli_query($conn, $sql);
                    header("location: warehouse.php");
            }
        } 
    ?>
    <div>
        <form class="feed-form" action="" method="post">
            <div class="input-row">
                <div class="input-group">
                    <label for="mangnx">Mã nguời NX</label>
                    <input type="text" name ="mangnx" value="<?php echo $_SESSION['username'];?>" readonly>
                </div>

                <div class="input-group">
                    <label for="tenngnx">Tên nguời NX</label>
                    <input type="text" name ="tenngnx" value="<?php echo $_SESSION['name'];?>" readonly>
                </div>
           
                <div class="input-group">
                    <label for="nghiepvu">Nghiệp vụ</label>
                    <input type="text" name ="nghiepvu" value="2" readonly >
                </div>
               
                <div class="input-group">
                    <label for="maNL">Mã NL</label>
                    <input type="text" name ="maNL" autofocus required placeholder="..." >    
                </div>

                <div class="input-group">
                    <label for="tenNL">Tên NL</label>
                    <input type="text" name ="tenNL"  required placeholder="...">
                </div>

                <div class="input-group">
                    <label for="donvi">Đơn vị</label>
                    <select  name="donvi" >
                        <option>Kg</option>
                        <option>Bịch</option>
                        <option>Thùng</option>
                        <option>Hộp</option>
                        <option>Chai</option>
                        <option>Khác</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="soluong">Số lượng</label>
                    <input type="text" name ="soluong" pattern="[0-9]{1,}" title="Nhập định dạng số" required placeholder="...">
                </div>
            </div>
          
            <div class="btn">
                <input type="submit" name = "themNL" value="Thêm"></button>
                <button class="quayve"><a href="warehouse.php">Quay về</a></button>
            </div>
        </form>
    </div>
</body>