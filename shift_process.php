<?php
include_once './db_connect.php';
include_once './header.php';
session_start();
if (isset($_SESSION["status"]) == 'Success') {
    if (isset($_POST['modify'])) {
        $ngay = $_POST['ngay'];
        $ca = $_POST['ca'];
        $n = (count($_POST) - 3)/2;
        $check = 0;
        $check2 = 0;
        $sql2 = "";
        for ($i=0; $i < $n; $i++)
        {
            $nv1 = $_POST['nv1_'.$i];
            $nv2 = $_POST['nv2_'.$i];
            
            if ($nv1 == $nv2)
            {
                $check2++;
                $check++;
            }
            else
            {
                $sql1 = $conn->query("SELECT * FROM `ca_lam_viec` WHERE MaNV = $nv2 AND Ca = $ca AND Ngay = $ngay");
                if ($sql1->num_rows <= 0)
                {
                    $sql2 .= "UPDATE `ca_lam_viec` SET `MaNV`= $nv2 WHERE MaNV = $nv1 AND Ca = $ca AND Ngay = $ngay;";
                    $check++;
                }
            }
        }
        if ($check == $n)
        {
            if ($check2==$check)
            {
                ?>
                <script>
                    alert("Không có sự thay đổi nào");
                    location.assign("./shift.php");
                </script>
                <?php
            }
            else
            {
                if (mysqli_multi_query($conn, $sql2) > 0)
                {
                    ?>
                    <script>
                        alert("Cập nhật thành công");
                        location.assign("./shift.php");
                    </script>
                    <?php
                }
                else
                {
                ?>
                    <script>
                        alert("Cập nhật thất bại");
                        location.assign("/shift.php");
                    </script>            
                <?php
                }
            }
        }
        else
        {
        ?>
            <script>
                alert("Trùng lịch. Vui lòng thử lại");
                location.assign("./shift_modify.php?ngay=<?php echo $ngay?>&ca=<?php echo $ca?>");
            </script>            
        <?php
        }
    }
    elseif (isset($_POST['delete']))
    {
        $ngay = $_POST['ngay'];
        $ca = $_POST['ca'];
        $nv = $_POST['nv'];
        
        if ($nv == 'all')
        {
            $sql = $conn->query("DELETE FROM `ca_lam_viec` WHERE Ngay = $ngay AND Ca = $ca");
            if ($sql)
            {
                ?>
                <script>
                    alert("Cập nhật thành công");
                    location.assign("./shift.php");
                </script>
                <?php
            }
            else
            {
            ?>
                <script>
                    alert("Cập nhật thất bại");
                    location.assign("/shift.php");
                </script>            
            <?php
            }
        }
        else
        {
            $sql = $conn->query("DELETE FROM `ca_lam_viec` WHERE Ngay = $ngay AND Ca = $ca AND MaNV = $nv");
            if ($sql)
            {
                ?>
                <script>
                    alert("Cập nhật thành công");
                    location.assign("./shift.php");
                </script>
                <?php
            }
            else
            {
            ?>
                <script>
                    alert("Cập nhật thất bại");
                    location.assign("/shift.php");
                </script>            
            <?php
            }
        }
    }
    elseif (isset($_POST['reset']))
    {
        $sql = $conn->query("DELETE FROM `ca_lam_viec`");
        if ($sql)
        {
            ?>
            <script>
                alert("Làm mới thành công");
                location.assign("./shift.php");
            </script>
            <?php
        }
        else
        {
        ?>
            <script>
                alert("Làm mới thất bại");
                location.assign("/shift.php");
            </script>            
        <?php
        }
    }
    elseif (isset($_POST['shift_add']))
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
else {
    ?>
    <script>
        alert("Vui lòng đăng nhập");
        location.assign("./index.php");
    </script>
<?php
}
mysqli_close($conn);
?>