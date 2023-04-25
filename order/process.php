<?php
    ob_start();
    include '../db_connect.php';
    session_start();
    if (isset($_SESSION["status"])=='Success')
    {
        if (isset($_POST['ma_order']))
        {
            //Tính năng thêm và sửa order
            $ma_ban = $_POST["ma_ban"];
            $manv = $_POST["manv"];
            $MaOrder = $_POST["ma_order"];
            $tt = $_POST["total_amount"];

            $list1 = $_POST["product_id"];
            $list2 = $_POST["qty"];
            $list3 = $_POST["amount"];

            $count = count($list1); //mới

            $sql = $conn->query("SELECT o.MaDoUong FROM `order` o, `hoa_don_thanh_toan` h WHERE o.MaOrder = h.MaOrder 
            AND h.TienNhan = 0 AND o.MaOrder = $MaOrder"); // order đã tồn tại nhưng chưa thanh toán
            $num = $sql->num_rows; //cũ
            if ($num > 0)
            {
                while($row = $sql->fetch_assoc())
                {
                    $list4[]=$row['MaDoUong'];
                }
                
                foreach ($list4 as $key => $value) //list cũ 
                {
                    foreach ($list1 as $key1 => $value1) //list mới 
                    {
                        if ($value1 == $value)
                        {
                            $id = $value;
                            $sl = $list2[$key1];
                            $st = $list3[$key1];
                            $sql2 = $conn->query("UPDATE `order` SET SoLuong = $sl , SoTien=  $st  WHERE MaOrder = $MaOrder AND MaDoUong = $id");
                            $sql3 = $conn->query("UPDATE `hoa_don_thanh_toan` SET TongTien = $tt WHERE MaOrder = $MaOrder");
                            if (($sql2 && $sql3))
                            {
                                ?>
                                    <script>
                                        alert("Cập nhật order thành công");
                                        location.assign("../order/index.php");
                                        </script>
                                <?php
                            }
                            else
                            {
                            ?>
                                <script>
                                    alert("Cập nhật order thất bại");
                                    location.assign("../order/index.php");
                                    </script>            
                            <?php
                            }
                        }
                        else // ko tìm thấy mã sp cũ trong list mới
                        {
                            if (!in_array($value1, $list4)) //kt mã sp list mới có trong list cũ ko => thêm
                            {
                                $id = $value1;
                                $sl = $list2[$key1];
                                $st = $list3[$key1];
                                $sql2 = $conn->query("INSERT INTO `order` (`MaOrder`, `MaNV`, `MaBan`, `MaDoUong`, `SoLuong`, `SoTien`) VALUES ('$MaOrder', ' $manv', ' $ma_ban', ' $id', ' $sl', ' $st')");
                                $sql3 = $conn->query("UPDATE `hoa_don_thanh_toan` SET TongTien=  $tt  WHERE MaOrder = $MaOrder");
                                if (($sql2 && $sql3))
                                {
                                    ?>
                                        <script>
                                            alert("Cập nhật order thành công");
                                            location.assign("../order/index.php");
                                            </script>
                                    <?php
                                }
                                else
                                {
                                ?>
                                    <script>
                                        alert("Cập nhật order thất bại");
                                        location.assign("../order/index.php");
                                        </script>            
                                <?php
                                }
                            }
                            if (!in_array($value, $list1)) //kt mã sp list cũ có trong list mới ko => xóa
                            {
                                $id = $value;

                                $sql2 = $conn->query("DELETE FROM `order` WHERE MaOrder = $MaOrder AND MaBan = $ma_ban AND MaDoUong = $id");
                                $sql3 = $conn->query("UPDATE `hoa_don_thanh_toan` SET TongTien = $tt WHERE MaOrder = $MaOrder");
                                if (($sql2 && $sql3))
                                {
                                    ?>
                                        <script>
                                            alert("Cập nhật order thành công");
                                            location.assign("../order/index.php");
                                            </script>
                                    <?php
                                }
                                else
                                {
                                ?>
                                    <script>
                                        alert("Cập nhật order thất bại");
                                        location.assign("../order/index.php");
                                        </script>            
                                <?php
                                }
                            }
                        }
                    }
                }
            }
            else //tạo mới order + hdtt
            {
                for ($i = 0; $i < $count; $i++)
                {
                    $id = $list1[$i];
                    $sl = $list2[$i];
                    $st = $list3[$i];
                    $sql4 = $conn->query("INSERT INTO `order` (`MaOrder`, `MaNV`, `MaBan`, `MaDoUong`, `SoLuong`, `SoTien`) VALUES ('$MaOrder', '$manv', '$ma_ban', '$id', '$sl', '$st')");
                }
                $sql5 = $conn->query("INSERT INTO `hoa_don_thanh_toan` (`MaOrder`, `TongTien`, `TienNhan`, `ThoiGianThanhToan`) VALUES ('$MaOrder', '$tt', '0', NULL)");
                if (($sql4 && $sql5))
                {
                    ?>
                        <script>
                            alert("Tạo order thành công");
                            location.assign("../order/index.php");
                            </script>
                    <?php
                }
                else
                {
                ?>
                        <script>
                            alert("Tạo order thất bại");
                            location.assign("../order/index.php");
                            </script>        
                <?php
                }
            }
        }
        elseif (isset($_POST['mabanmodify']))
        {
            $ban_chon = $_POST['mabanmodify'];
            $ban_sua = $_POST['mabanmodify1'];
            $kv = $_POST['kv_modify'];

            $sql6 = $conn->query("UPDATE `ban` SET `MaBan` = $ban_sua, `KhuVuc` ='$kv' WHERE `MaBan` = $ban_chon");

            if ($sql6)
            {
                ?>
                    <script>
                        alert("Cập nhật thành công");
                        location.assign("../order/index.php");
                        </script>
                <?php
            }
            else
            {
            ?>
                <script>
                    alert("Cập nhật thất bại");
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
