<?php

/*require_once "../config.php";
$sql = "SELECT * from `nhan_vien`WHERE employee.id = rank.eid";

//echo "$sql";
$result = mysqli_query($conn, $sql);
*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="images/img/logo2.png">
	<title>Thông tin nhân viên</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Lobster');
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700');

        body{
            margin: 0px;
        }

        header{
            background: black;
            color: white;
            padding: 8px 20px 6px 40px;
            height: 50px;
        }

        header h1{
            display: inline;
            font-family: 'Lobster', cursive;
            font-weight: 400;
            font-size: 32px;
            float: left;
            margin-top: 0px;
            margin-right: 10px;
        }
        table a:-webkit-any-link{
            text-decoration: none;
            cursor: pointer;
            color: blue;
        }

        nav ul {
            display: inline;
            padding: 0px;
            float: right;
        }

        nav ul li{
            display: inline-block;
            list-style-type: none;
            color: white;
            /*float: left;*/
            margin-left: 12px;
            

        }

        nav ul li a{
            color: white;
            text-decoration: none;	
        }


        nav ul ul{
            display: none;
            position: absolute;
        }

        #navli ul li ul:hovar{
            visibility: visible;
            display: block;
        }

        #navli{
            font-family: 'Montserrat', sans-serif;
        }

        .homered{
            background-color: red;
            padding: 30px 10px 22px 10px;
        }

        .divider{
            background-color: red;
            height: 5px;
        }

        .homeblack:hover{
            background-color: blue;
            padding: 30px 10px 21px 10px;

        }

        table {
        margin: 0px;
        border-collapse: collapse;
        width: 100%;
        font-family: 'Montserrat', sans-serif;
        }

        th, td {
        text-align: center;
        padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}
        tr:hover {background-color:#76D7C4;}

        th {
        background-color: #4CAF50;
        color: white;
        }
    </style>
</head>
<body>
	<header>
		<nav>
			<h1>Yvette</h1>
			<ul id="navli">
				<li><a class="homeblack" href="addemp.php">Thêm mới</a></li>
				<li><a class="homered" href="employ_info.php">Thông tin NV</a></li>
				<li><a class="homeblack" href="../function.php">Log Out</a></li>
			</ul>
		</nav>
	</header>
	<?php
        session_start();
        require_once "../config.php";
        $sql = "SELECT * FROM `nhan_vien`";
        $result = mysqli_query($conn, $sql); 
        if ($result->num_rows > 0) {
    ?>
	<div class="divider"></div>       
		<table>
			<tr>

				<th align = "center">Mã NV</th>
				<th align = "center">Tên NV</th>
				<th align = "center">Ngày sinh</th>
				<th align = "center">Liên lạc</th>
				<th align = "center">Chức vụ</th>
				
				
				<th align = "center">Options</th>
			</tr>

			<?php
				while($row = $result->fetch_assoc()) { ?>
					<tr>    
                            <td><?php echo $row["MaNV"] ?></td>
                            <td><?php echo $row["TenNV"] ?></td>
                            <td><?php echo $row["NgaySinh"] ?></td>
                            <td><?php echo $row["SDT"] ?></td>
                            <td><?php echo $row["ChucVu"] ?></td>
                            <td><a href="edit.php?id=<?php echo $row['MaNV']?>">Cập nhật</a> |
                            <a href="delete.php?id=<?php echo $row['MaNV']?>">Xóa</a></td>
                    </tr>
			<?php	} ?>
		</table>
        <?php
                }else {
                    echo "0 results";
                }          
                mysqli_close($conn);
        ?>		
</body>
</html>