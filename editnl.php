<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="../images/img/logo2.png">
    <title>Cập nhật NL</title>
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
        require_once "../db_connect.php";
        date_default_timezone_set("Asia/Ho_Chi_Minh"); $date = date('Y-m-d G:i:s');
        if(isset($_GET["id"]) && ($_GET["id"] > 0)){
            $id = $_GET["id"];
        }
        if(isset($_POST["suaNL"])){
            $maNL = $_POST["maNL"];
            $tenNL = $_POST["tenNL"];
            $donvi = $_POST["donvi"];
            $soluongNX = $_POST["soluongNX"];
            $nghiepvu = $_POST["nghiepvu"];
            $manv = $_SESSION["username"];
            $tennv =  $_SESSION["name"];

            /*$sql2 = "SELECT * FROM nhan_vien Where MaNV = $manv";
                $result2 = mysqli_query($conn, $sql2);
                $row2= mysqli_fetch_array($result2);
                $tennv = $row2['TenNV'];*/
            
            $sql3 = "SELECT * FROM nguyen_lieu Where MaNL = $id";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_array($result3);

            if($nghiepvu == 0){
                $x = $row3['SoLuongNL'] + $soluongNX;
            }else{
                $x = $row3['SoLuongNL'] - $soluongNX;
            }
            if($x < 0){
                echo "Số lượng không hợp lệ". $x . " < 0, nhập lại";
                
               
            
            }else{
                if($soluongNX != ""){
                    $sql1 = "INSERT INTO nhap_xuat_nl(`MaNguoiNX`, `TenNguoiNX`, `NghiepVu`, `MaNL`, `TenNL`, `SoLuongNX`, `ThoiGianNX`) 
                    VALUES ('$manv','$tennv','$nghiepvu','$maNL','$tenNL','$soluongNX','$date')";
                    $result1 = mysqli_query($conn, $sql1);
                    /*$row1= mysqli_fetch_array($result1);*/
                
                    $sql = "UPDATE nguyen_lieu SET TenNL = '$tenNL', DonVi = '$donvi', SoLuongNL = '$x' 
                    Where MaNL = $id"; 
                    $result = mysqli_query($conn, $sql);
                
                    header("location: warehouse.php");
                } 
            }
        }    
        $sql = "SELECT * FROM nhan_vien, nguyen_lieu Where MaNL = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

    ?>
    <div>
        <form class="feed-form" action="" method="post">
            <div class="input-row">
                <div class="input-group">
                    <label for="mangnx">Mã nguời NX</label>
                    <input type="text" name ="mangnx" value="<?php echo $_SESSION['username'];?>" readonly  >
                </div>
                <div class="input-group">
                    <label for="tenngnx">Tên nguời NX</label>
                    <input type="text" name ="tenngnx" value="<?php echo $_SESSION['name'];?>" readonly  >
                </div>
                <div class="input-group">
                    <label for="nghiepvu">Nghiệp vụ: </label>
                    <select name="nghiepvu"  required>
                        <option value="1">Xuất</option>
                        <option value="0">Nhập</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="maNL">Mã NL</label>
                    <input type="text" name ="maNL" value="<?php echo $row['MaNL']?>" readonly  >
                </div>
                <div class="input-group">
                    <label for="tenNL">Tên NL</label>
                    <input type="text" name ="tenNL" value="<?php echo $row['TenNL']?>"  readonly >
                </div>
                <div class="input-group">
                    <label for="donvi">Đơn vị</label>
                    <input type="text" name ="donvi" value="<?php echo $row['DonVi']?>"" readonly>
                </div>
                <div class="input-group">
                    <label for="soluong">Số lượng</label>
                    <input type="text" name ="soluongNX"  
                        pattern="[0-9]{1,}" title="Nhập định dạng số" required autofocus>
                </div>
            </div>
            <div class="btn">
                <input type="submit" name = "suaNL" value="Xác nhận">
                <button><a href="warehouse.php">Quay về</a></button>
            </div>
        </form>
    </div>
</body>
