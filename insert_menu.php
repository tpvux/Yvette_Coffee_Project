<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="../images/img/logo2.png">
    <title>Thêm mới</title>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            display: flex    ;
            position: relative;
            justify-content: center;
            align-items: center;
            top: 150px;
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
        }
        .input-form .btn{
            flex-basis: 47%;

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
            justify-content: space-evenly;
        }

        button {
            width: 100px;
            height: 33px;
            font-size: 12px;
            color: white;
            padding: 0.5em 0em;
            border: transparent;
            box-shadow: 2px 2px 4px rgba(0,0,0,0.4);
            background: dodgerblue;    
            border-radius: 4px;
        }

       /* button:hover {
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(30,144,255,1) 0%, rgba(0,212,255,1) 100%);
        }*/

        button:active {
            transform: translate(0em, 0.2em);
        }

        a{
            padding: 0.5em 2em;
            text-decoration: none;
            color: white;
        }
        button[type=submit] {
            width: 100px;
            height: 33px;   
            font-size: 12px;
            background-color: #4CAF50;
            color: white;
            padding: 0.5em 2em;
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
        require_once "../db_connect.php";
        if(isset($_POST["upload"])){
            $id = $_POST["id"];
            $name = $_POST["name"];
            $price = $_POST["price"];
            $idcate = $_POST["id-cate"];
            if($_FILES["image"]["name"]!= ""){
                $image = $_FILES["image"]["name"];
            }else{
                $image = "";
            }
          
            if( $id != "" && $name != "" && $price != "" && $idcate != "" && $image != ""){
                $sql1 = "INSERT INTO do_uong(`MaDoUong`, `TenDoUong`, `DonGia`, `MaDanhMuc`, `image`) 
                VALUES ('$id','$name','$price','$idcate','$image')";
                $result1 = mysqli_query($conn, $sql1);       

               header("location: menu.php");

            }
        } 
    ?>  
    <form class="form" action="" method="post" enctype="multipart/form-data" >
        <div class="input-form">
            <div class="row">
                <label class="label" for="">Mã đồ uống</label>
                <input class="input" type="text" name="id" required>
            </div>

            <div class="row">
                <label class="label" for="">Tên đồ uống</label>
                <input class="input" type="text" name="name" required>
            </div>
            

            <div class="row">
                <label class="label" for="">Đơn giá</label>
                <input class="input" type="text" name="price" id="" required>
            </div>

            <div class="row">
                <label class="label" for="">Mã danh mục:</label>
                <select class="input" name="id-cate" >
                    <option value="1">Đá Xay</option>
                    <option value="2">Sữa chua</option>
                    <option value="3">Kem Viên</option>
                    <option value="4">Nước ép trái cây</option>
                    <option value="5">Topping</option>
                    <option value="6">Cà Phê Ý</option>
                    <option value="7">Cà Phê Việt Nam</option>
                    <option value="8">Trà trái cây</option>
                    <option value="9">Trà nóng</option>
                    <option value="10">Sinh tố trái cây</option>
                    <option value="11">Giải nhiệt</option>
                    <option value="12">Nước giải khát</option>
                </select>
            </div>

            <div class="row">
                <label class="label" for="">Image:</label>
                <input class="input" type="file" name="image" id="" required>
            </div>

            <div class="btn">
                <button type="submit" name="upload">Thêm</button>
                <button class="quayve"><a href="menu.php">Quay về</a></button>
            </div>
        </div>
    </form>
</body>