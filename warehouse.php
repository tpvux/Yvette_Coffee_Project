<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="../images/img/logo2.png">
    <title>Kho</title>

    <!-- Custom css -->
   <!--<link rel="stylesheet" href="style_ware.css">-->
   <style>
    
@import url('https://fonts.googleapis.com/css?family=Lobster');
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,700');

body{
    margin: 0px;
}
.container{
    margin: 0 auto;
    width: 1225px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
table a:-webkit-any-link{
    text-decoration: none;
    cursor: pointer;
    color: blue;
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

nav ul {
    display: inline;
    padding: 0px;
    float: right;
}

nav ul li{
    display: inline-block;
    list-style-type: none;
    color: white;
    /* float: left;*/
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

#navli ul li ul:hover{
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
    background-color: red;
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

.box-search {
    position: relative;
    left: 5px;
    margin: 0 auto;
    margin-top: 10px;
    padding: 5px;
}

#search{
    margin-top: 10px;
    margin-bottom: 10px;
}

.form-search {
    padding-left: 20px;
    border-top: 2px solid;
    padding-top: 10px;
}
.form-search input {
    width: 300px;
}
.form-search select {
    cursor: pointer;
    padding: 0px;
    height: 28px;
}
.form-search button {
    cursor: pointer;
    margin: 0px;
    margin-left: 3px;
    padding: 0px;
    text-align: center;
    background-color: white;
    width: 30px;
    border: none;
    height: 28px;
}
button:hover {
    opacity: 0.4;
}

.pagination {
    display: inline-block;
  }
  
  .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
  }
  
  .pagination a.active {
    background-color: #4CAF50;
    color: white;
  }
  
  .pagination a:hover:not(.active) {background-color: #ddd;}
   </style>

    
</head>
<body>
    <?php session_start();
        require_once "../db_connect.php"; ?>
    <header>
            <nav>
                <h1>Yvette</h1>
                <ul id="navli">
                    <li><a class="homeblack" href="insert_nl.php">Thêm mới</a></li>
                    <li><a class="homered" href="warehouse.php">Thông tin kho</a></li>
                    <li><a class="homeblack" href="history.php">Lịch sử nhập xuất</a></li>
                    <li><a class="homeblack" href="../index.php">Log Out</a></li>
                </ul>
            </nav>
	</header>
    <div class="divider"></div>  
    <div class="container">
        <!-- Tìm kiếm -->	
        <div class="title-search">
            <h2 style="margin: 0;">Thông tin kho</h2>
        </div>
        <div class="box-search">
           <div class="search" id="search">
                <form action="" method="post">
                    <input type="text" name="txtsearch" id="">
                    <input type="submit" name="search" value="Search">
                </form>
           </div>          
        </div>
        <?php
        
            if(isset($_POST["search"])){
                $s = $_POST["txtsearch"];
                if($s == ""){
                    echo "Nhập vào thanh tìm kiếm";
                }else{
                    $sql = "SELECT * FROM nguyen_lieu WHERE TenNL LIKE '%$s%'";
                    $result = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($result);
                    if($count <= 0){
                        echo "không tìm thấy nguyên liệu, ". $s ;
                    }else{
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            ?>
                            <table>
                                <tr>
                                    <th align = "center">Mã NL</th>
                                    <th align = "center">Tên NL</th>
                                    <th align = "center">Đơn vị</th>
                                    <th align = "center">Số lượng</th>
                                    <th align = "center">Options</th>
                                </tr>
                            <?php
                            while($row = $result->fetch_assoc()) { ?>
                                <tr>    
                                    <td><?php echo $row["MaNL"] ?></td>
                                    <td><?php echo $row["TenNL"] ?></td>
                                    <td><?php echo $row["DonVi"] ?></td>
                                    <td><?php echo $row["SoLuongNL"] ?></td>
                                    <td><a href="editnl.php?id=<?php echo $row['MaNL']?>">Cập nhật</a> |
                                    <a href="deletenl.php?id=<?php echo $row['MaNL']?>">Xóa</a></td>
                                </tr>
                        <?php    } ?>
                            </table>
                            
                            <?php                          
                        }
                    }   
                }        
            }else{
                /*$ma_nl = $_GET["id"];*/
                $sql = "select * from nguyen_lieu";
                $result = mysqli_query($conn, $sql);     
                /*--------------*/
                $num_per_page = 18;
                if(isset($_GET["page"])){
                    $page = $_GET["page"];
                }else{
                    $page = 1;
                }

                $start_from = ($page-1)*18;

                $sql = "select * from nguyen_lieu limit $start_from,$num_per_page";
                $result = mysqli_query($conn, $sql); 
                /*------------*/
                if ($result->num_rows > 0) {
                    ?>
                    <table>
                        <tr>
                            <th align = "center">Mã NL</th>
                            <th align = "center">Tên NL</th>
                            <th align = "center">Đơn vị</th>
                            <th align = "center">Số lượng</th>
                            <th align = "center">Options</th>
                        </tr>
                        <?php
                    while($row = $result->fetch_assoc()) { ?>
                        <tr>    
                            <td><?php echo $row["MaNL"] ?></td>
                            <td><?php echo $row["TenNL"] ?></td>
                            <td><?php echo $row["DonVi"] ?></td>
                            <td><?php echo $row["SoLuongNL"] ?></td>
                            <td><a href="editnl.php?id=<?php echo $row['MaNL']?>">Cập nhật</a> |
                            <a href="deletenl.php?id=<?php echo $row['MaNL']?>">Xóa</a></td>
                        </tr>
                <?php   } ?>                 
                    </table>
                    <?php
                        $sql = "select * from nguyen_lieu";
                        $result = mysqli_query($conn, $sql);
                        $total_records = mysqli_num_rows($result);
                        $total_pages = ceil($total_records/$num_per_page);
                    ?>
                    <div class="pagination">
                    <?php    
                        for($i=1; $i <= $total_pages; $i++){
                            echo "<a href = 'warehouse.php?page=".$i."'>" .$i. "</a>";
                        }
                    
                    ?>
                    </div>
                <?php
                }else {
                    echo "0 results";
                }          
                mysqli_close($conn);
            }
                ?>
    </div>  
</body>
</html>