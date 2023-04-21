<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="./images/img/logo2.png">
    <title>Cập nhật</title>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            display: flex    ;
            position: relative;
            justify-content: center;
            align-items: center;
            top: 80px;
        }
        .form {
            max-width: 500px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 0px 4px rgba(52, 52, 53, 0.185);
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        .input-form{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .input-form .row{
            flex-basis: 45%;
            margin: 5px;
        }

        .label {
            color: rgb(0, 0, 0);
            margin-bottom: 4px;
        }
        .input {
            padding: 10px;
            margin-bottom: 20px; 
            width: 80%;
            font-size: 1rem;
            color: #4a5568;
            outline: none;
            border: 1px solid transparent;
            border-radius: 4px;
            transition: all 0.2s ease-in-out;
        }
        .input:focus {
            background-color: #fff;
            box-shadow: 0 0 0 2px #cbd5e0;
        }

        .input:valid {
            border: 1px solid green;
        }

        .input:invalid {
            border: 1px solid rgba(14, 14, 14, 0.205);
        }

        .form .btn{
            margin: 5px;
            display: flex;
            align-items: center;
            justify-content: space-evenly
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
        button[type=submit] {
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

        button[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php
        session_start();
        require_once "./db_connect.php";
        if(isset($_GET["id"])){
            $id = $_GET["id"];
        }
        if(isset($_POST["capnhat"])){
            $manv = $_POST["manv"];
            $tennv = $_POST["tennv"];
            $ngaysinh = $_POST["ngaysinh"];
            $sdt = $_POST["sdt"];
            $chucvu = $_POST["chucvu"]; 
            $maql = $_POST["maql"];         

            if($manv != "" &&  $tennv != "" && $ngaysinh != "" && $sdt != "" && $chucvu != "" ){
            
                $sql1 = "UPDATE `nhan_vien` SET `MaNV`='$manv',`TenNV`='$tennv',`NgaySinh`='$ngaysinh'
                ,`SDT`='$sdt',`ChucVu`='$chucvu',`MaQL`='$maql' WHERE `MaNV` = $id"; 
                $result1 = mysqli_query($conn, $sql1);
                /*echo $sql1;*/
                header("location: employ_info.php");
            } 
        }    
        $sql = "SELECT * FROM nhan_vien Where MaNV = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

    ?>
    
    <form class="form" action="" method="POST">
        <h2 style="text-align: center;">Cập nhật thông tin</h2>
        <div class="input-form">
            <div class="row">
                <label class="label">Mã NV </label>
                <input class="input"  type="text" name="manv" value="<?php echo $row['MaNV'];?>" maxlength="10" size="10" pattern="[0-9]{10}"  autofocus required>
            </div>
            <div class="row">
                <label class="label">Họ và Tên</label>
                <input class="input"  type="text" name="tennv" value="<?php echo $row['TenNV'];?>"maxlength="30" size="15"  pattern="[A-Zạ-z ]{1,30}" required>
            </div>
            <div class="row">
                <label class="label">Ngày sinh </label>
                <input class="input"  type="date" name="ngaysinh" value="<?php echo $row['NgaySinh'];?>">
            </div>
            <div class="row">
                <label class="label">SĐT: </label>
                <input class="input" type="text" name="sdt" value="<?php echo $row['SDT'];?>" maxlength="10" size="10" pattern="[0-9]{10}" >
            </div>
            <div class="row">
                <label class="label">Chức vụ</label>
                <select class="input"  name="chucvu"  required>
                    <option>Quản lý</option>
                    <option>Nhân viên</option>
                </select><br/><br/>
            </div>
            <div class="row">
                <label class="label">Mã quản lý</label>
                <input class="input" type="text" name="maql" value="<?php echo $row['MaQL'];?>" maxlength="10" size="10" pattern="[0-9]{10}">
            </div>
        </div>
            <div class="btn">
                <button type="submit" name="capnhat">Xác nhận</button>    
                <button><a href="employ_info.php">Quay về</a></button>    
            </div>                    
    </form>
</body>
