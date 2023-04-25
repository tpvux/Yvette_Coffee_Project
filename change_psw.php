<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="./images/img/logo2.png">
    <title>Đổi mật Khẩu</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.16.0/js/md5.min.js"></script>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            top: 80px;
        }
        
        .container{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column-reverse;
            box-shadow: 0px 0px 0px 4px rgba(52, 52, 53, 0.185);
            border-radius: 5px;
        }

        .text-primary{
            color: rgb(77, 75, 75);
            display: block;
            font-weight: bold;
            margin: 0.5em;
            padding: 0.5em;

        }

        .feed-form{
            width: 350px;
            height: 300px;
            padding: 0 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .form--input {
            width: 50%;
            margin-bottom: 1.25em;
            height: 20px;
            border-radius: 5px;
            border: 1px solid gray;
            padding: 0.5em;
            outline: none;
        }

        .form--input:focus {
            border: 1px solid #639;
            outline: none;
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

        .feed-form .btn{
            margin-top: 5px;
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
<div class="container">
<?php
session_start();
require_once "./db_connect.php"; 


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
            echo "<div>Mật khẩu cũ không đúng thử lại</div>";
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

                    header("location: index.php");
                }
            }
        }
    } 
}    

?>
    <div class="row">
        <div class="col-md-12">        
            <form method="POST" action="" class="feed-form">
                <h3 class="text-primary">Đổi mật khẩu</h3>
                        
                        <input type="password" placeholder="Mật khẩu cũ" class="form--input" onkeyup="check()" id="old_pass" name="oldp" required>

                        
                        <input type="password" placeholder="Mật khẩu mới" class="form--input" onkeyup="check()" id="new_pass" name="newp" required>

                        
                        <input type="password" placeholder="Nhập lại mật khẩu mới" class="form--input" onkeyup="check()" id="re_new_pass" name="renewp" required>

                    <div class = "btn">
                        <button><a href="index.php">Trở về</a></button>
                        <input type="submit" class="btn btn-primary" id="submit_change_pass" value="Thay đổi" name="thaydoi"></input>
                    </div>
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
                document.getElementById('warning').innerHTML = 'Mật khẩu không hợp lệ' ;
            }else {
                if(c != ""){
                    if(b != c){
                        document.getElementById('warning').innerHTML = 'Mật khẩu chưa khớp' ;
                    }else{
                        document.getElementById('warning').innerHTML = 'Hợp lệ' ;
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
