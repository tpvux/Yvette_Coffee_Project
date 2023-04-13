<?php
    session_start();
    include '../db_connect.php';
    if (isset($_SESSION["status"])=='Success')
    {
        if (isset($_POST['ma_order_del']))
        {
            //Tính năng xóa order
            $MaOrder = $_POST['ma_order_del'];
            $sql1 = $conn->query("DELETE FROM `hoa_don_thanh_toan` WHERE MaOrder = $MaOrder");
            $sql2 = $conn->query("DELETE FROM `order` WHERE MaOrder = $MaOrder");
            if (($sql1 && $sql2))
            {
                ?>
                    <script>
                        alert("Xóa order thành công");
                        location.assign("../order/index.php");
                        </script>
                <?php
            }
            else
            {
            ?>
                <script>
                    alert("Xóa order thất bại");
                    location.assign("../order/index.php");
                    </script>
            <?php
            }
        }
        elseif (isset($_POST['mabandel']))
        {
             //Tính năng xóa bàn
             $maban = $_POST['mabandel'];
             $sql1 = $conn->query("DELETE FROM `ban` WHERE MaBan = $maban");
             if ($sql1)
             {
                 ?>
                     <script>
                         alert("Xóa bàn thành công");
                         location.assign("../order/index.php");
                         </script>
                 <?php
             }
             else
             {
             ?>
                 <script>
                     alert("Xóa bàn thất bại");
                     location.assign("../order/index.php");
                     </script>
             <?php
             }
        }
        else
        {
            ?>
                <script>
                    alert("Lỗi hệ thống");
                    location.assign("../order/index.php");
                </script>        
            <?php
        }
        $conn->close();
    }
    else
    {
    ?>
    <script>
        alert("Vui lòng đăng nhập");
        location.assign("../index.php");
    </script>
    <?php
    }
?>