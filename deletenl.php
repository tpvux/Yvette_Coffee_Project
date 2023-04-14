
    <?php
        session_start();
        require_once "../config.php";
        date_default_timezone_set("Asia/Ho_Chi_Minh"); $date = date('Y-m-d G:i:s');
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $soluongNX = "0";
            $nghiepvu = 3;
            $manv = $_SESSION["username"];
            $tennv =  $_SESSION["name"];
            if($nghiepvu == 3){
                $sql2 = "SELECT * FROM nguyen_lieu Where MaNL = $id";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_array($result2);
                $tenNL = $row2["TenNL"];
                // echo  $tenNL;
                $sql = "DELETE FROM `nguyen_lieu` Where MaNL = $id"; 
                $result = mysqli_query($conn, $sql);  
                echo $sql;
                $sql1 = "INSERT INTO nhap_xuat_nl(`MaNguoiNX`, `TenNguoiNX`, `NghiepVu`, `MaNL`, `TenNL`, `SoLuongNX`, `ThoiGianNX`) 
                VALUES ('$manv','$tennv','$nghiepvu','$id','$tenNL','$soluongNX','$date')";
                $result1 = mysqli_query($conn, $sql1);
                /*$row1= mysqli_fetch_array($result1);*/
                /*echo $sql1;*/
    
                header("location: warehouse.php");
            }
        }
        
    ?>

