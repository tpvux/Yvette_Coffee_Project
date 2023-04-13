<?php
    include_once '../db_connect.php';
    session_start();
    if (isset($_SESSION["status"])=='Success')
    {
        if (isset($_POST))
        { 
            $maban = $_POST["mabanadd"];
            $kv = $_POST["kv"];

            $sql1 = $conn->query("SELECT * FROM `ban` WHERE MaBan = $maban");
            if (($row1 = $sql1->num_rows) > 0)
            {
                ?>
                    <script>
                        alert("Mã bàn đã tồn tại. Vui lòng thử lại");
                        location.assign("../order/index.php");
                        </script>            
                <?php
            }
            else
            {
                $sql2 = $conn->query("INSERT INTO `ban` (`MaBan`, `KhuVuc`) VALUES ($maban, '$kv')");
                if ($sql2)
                {
                    ?>
                        <script>
                            alert("Bàn mới đã được thêm thành công");
                            location.assign("../order/index.php");
                        </script>            
                    <?php
                }
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
$conn->close();
?>