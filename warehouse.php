<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="images/img/logo2.png">
    <title>Kho</title>

    <!-- Custom css -->
    <link rel="stylesheet" href="style_ware.css">

    <!-- Font Awesome Cdn -->
    <!--<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>-->
    
</head>
<body>
    <?php session_start();
        require_once "../config.php"; ?>
    <header>
            <nav>
                <h1>Yvette</h1>
                <ul id="navli">
                    <li><a class="homeblack" href="insert_nl.php">Thêm mới</a></li>
                    <li><a class="homered" href="warehouse.php">Thông tin kho</a></li>
                    <li><a class="homeblack" href="history.php">Lịch sử nhập xuất</a></li>
                    <li><a class="homeblack" href="../function.php">Log Out</a></li>
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
                
                $num_per_page = 18;
                if(isset($_GET["page"])){
                    $page = $_GET["page"];
                }else{
                    $page = 1;
                }

                $start_from = ($page-1)*18;

                $sql = "select * from nguyen_lieu limit $start_from,$num_per_page";
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