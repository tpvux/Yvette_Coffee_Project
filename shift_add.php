<?php
    include './db_connect.php';
    session_start();
    if (isset($_SESSION["status"])=='Success')
    {
        if (isset($_POST))
        {   
            $ngay = $_POST['ngay'];
            $ca = $_POST['ca'];
            $nv = $_POST['nv'];
            
            $sql1 = $conn->query("SELECT * FROM `ca_lam_viec` WHERE Ngay = $ngay AND Ca = $ca AND MaNV = $nv");
            if (($row1 = $sql1->num_rows) > 0)
            {
                ?>
                    <script>
                        alert("Trùng lịch. Vui lòng thử lại");
                        location.assign("./shift.php");
                        </script>            
                <?php
            }
            else
            {
                $sql2 = $conn->query("INSERT INTO `ca_lam_viec` (`MaNV`, `Ca`, `Ngay`) VALUES ('$nv', '$ca', '$ngay')");
                if ($sql2)
                {
                    ?>
                        <script>
                            alert("Thêm thành công");
                            location.assign("./shift.php");
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
                location.assign("./shift.php");
            </script>
        <?php
        }
    }
    else
    {
      ?>
        <script>
            alert("Vui lòng đăng nhập");
            location.assign("./index.php");
        </script>
      <?php
    }
?>
