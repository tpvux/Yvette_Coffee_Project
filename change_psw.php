<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật Khẩu</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.16.0/js/md5.min.js"></script>
</head>
<body>

<?php
session_start();
require_once "./db_connect.php"; 
include('./header.php');


if(isset($_POST["thaydoi"])){
    $oldpass = md5(md5($_POST["oldp"]));
    $newpass = md5(md5($_POST["newp"]));
    $renewpass = md5(md5($_POST["renewp"]));
    $tendangnhap =  $_SESSION["username"];
    if($oldpass != "" &&  $newpass != "" && $renewpass != "" ){
        
        $sql = "SELECT * FROM `tai_khoan` WHERE 1"; 
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        if($oldpass != $row['MatKhau']){
            echo "Mật khẩu cũ không đúng thử lại ";
        }else{
            if($newpass == $oldpass){
                echo "Mật khẩu mới trùng mật khẩu cũ thử lại ";
            }else{
                if($newpass != $renewpass){
                    echo "Nhập lại mật khẩu chưa đúng thử lại ";
                }else{
                    $sql1 = "UPDATE `tai_khoan` 
                    SET `MatKhau`='$newpass' 
                    WHERE `TenDangNhap` = $tendangnhap";
                    $result1 = mysqli_query($conn, $sql1);
                }
            }
        }
    } 
}    

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">Đổi mật khẩu</h3>
            <form method="POST" action="" >
                <div class="form-group">
                    <label for="user_signin">Mật khẩu cũ</label>
                    <input type="password" class="form-control" onkeyup="check()" id="old_pass" name="oldp" required>
                </div>

                <div class="form-group">
                    <label for="user_signin">Mật khẩu mới</label>
                    <input type="password" class="form-control" onkeyup="check()" id="new_pass" name="newp" required>
                </div>

                <div class="form-group">
                    <label for="user_signin">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" onkeyup="check()" id="re_new_pass" name="renewp" required>
                </div>

                <a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Trở về</a>

                <input type="submit" class="btn btn-primary" id="submit_change_pass" value="thay đổi" name="thaydoi"></input>

                <br><br>
                <label  id="warning"></label>
            </form>
        </div>
    </div>
</div>
 <script>
    function check(){
        var a = document.getElementById("old_pass").value;
        var b = document.getElementById("new_pass").value;
        var c = document.getElementById("re_new_pass").value;

        z = b.length


        if(a != '' && b != '' && c != ''){
            if(z < 6 || z > 15){
                document.getElementById('warning').innerHTML = 'mật khẩu k hợp lệ' ;
            }else {
                if(c != ""){
                    if(b != c){
                        document.getElementById('warning').innerHTML = 'Mật khẩu chưa khớp' ;
                    }else{
                        document.getElementById('warning').innerHTML = 'hợp lệ' ;
                    }
                    
                }else{
                    document.getElementById('warning').innerHTML = '' ;
                }
                
            }
        }
    }       
    
    
    
    
 </script>

</body>
</html>