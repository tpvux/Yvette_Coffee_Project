<?php
    include '../db_connect.php';
    session_start();
    if (isset($_SESSION["status"])=='Success')
    {
        if (isset($_POST))
        {
            $id = $_POST['ma_order'];
            $maban = $_POST['maban'];
            $tt = $_POST['total_amount'];
            $tn = $_POST['total_tendered'];
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $date = date('Y-m-d G:i:s');

            $sql = $conn->query("UPDATE `hoa_don_thanh_toan` SET TienNhan = $tn, ThoiGianThanhToan = '$date' WHERE MaOrder = $id");

            if($sql)
            {
                ?>
                    <script>
                        alert("Thanh toán thành công");
                        location.assign("../order/index.php");
                    </script>
                <?php
            }
            else
            {
            ?>
                <script>
                    alert("Thanh toán thất bại");
                    location.assign("../order/order.php?ban=<?php echo $maban?>");
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