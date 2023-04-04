<?php
    include '../db_connect.php';
    $ma_ban = $_POST["id"];
    $manv = $_POST["manv"];
    $MaOrder = $_POST["ma_order"];
    $tt = $_POST["total_amount"];

    $list1 = $_POST["product_id"];
    $list2 = $_POST["qty"];
    $list3 = $_POST["amount"];
    
    $count = count($list1);

    $sql = $conn->query("SELECT * FROM `order` o, `hoa_don_thanh_toan` h WHERE o.MaOrder = h.MaOrder AND h.TienNhan = 0 AND o.MaOrder = $MaOrder"); // order đã tồn tại nhưng chưa thanh toán
    for ($i = 0; $i < $count; $i++)
    {
        $id = $list1[$i];
        $sl = $list2[$i];
        $st = $list3[$i];
            if (($row = $sql->fetch_assoc()) > 0)
            {
                if ($row['MaDoUong']==$id)
                {
                    if ($sl < 1)
                    {
                        $sql2 = $conn->query("DELETE FROM `order` WHERE MaOrder = $MaOrder AND MaBan = $ma_ban AND MaDoUong = $id");
                    }
                    else
                    {
                        $sql2 = $conn->query("UPDATE `order` SET SoLuong = $sl , SoTien=  $st  WHERE MaOrder = $MaOrder AND MaDoUong= $id");
                    }
                    $sql3 = $conn->query("UPDATE `hoa_don_thanh_toan` SET TongTien = $tt WHERE MaOrder = $MaOrder");
                    if (($sql2 && $sql3))
                    {
                        ?>
                            <script>
                                alert("Xử lí thành công");
                                location.assign("../billing/index.php");
                                </script>
                        <?php
                    }
                    else
                    {
                    ?>
                        <script>
                            alert("Xử lí thất bại");
                            location.assign("../billing/index.php");
                            </script>            
                    <?php
                        }
                }
                else
                {
                    $sql4 = $conn->query("INSERT INTO `order` (`MaOrder`, `MaNV`, `MaBan`, `MaDoUong`, `SoLuong`, `SoTien`) VALUES ('$MaOrder', ' $manv', ' $ma_ban', ' $id', ' $sl', ' $st')");
                    $sql3 = $conn->query("UPDATE `hoa_don_thanh_toan` SET TongTien=  $tt  WHERE MaOrder = $MaOrder");
                    if (($sql2 && $sql3))
                    {
                        ?>
                            <script>
                                alert("Xử lí thành công");
                                location.assign("../billing/index.php");
                                </script>
                        <?php
                    }
                    else
                    {
                    ?>
                        <script>
                            alert("Xử lí thất bại");
                            location.assign("../billing/index.php");
                            </script>            
                    <?php
                        }
                }
            }
            else
            {
                $sql2 = $conn->query("INSERT INTO `order` (`MaOrder`, `MaNV`, `MaBan`, `MaDoUong`, `SoLuong`, `SoTien`) VALUES (' $MaOrder', ' $manv', ' $ma_ban', ' $id', ' $sl', ' $st')");
                $sql3 = $conn->query("INSERT INTO `hoa_don_thanh_toan` (`MaOrder`, `TongTien`, `TienNhan`, `ThoiGianThanhToan`) VALUES (' $MaOrder', '  $tt ', '0', NULL)");
                if (($sql2 && $sql3))
                {
                    ?>
                        <script>
                            alert("Xử lí thành công");
                            location.assign("../billing/index.php");
                            </script>
                    <?php
                }
                else
                {
                ?>
                        <script>
                            alert("Xử lí thất bại");
                            location.assign("../billing/index.php");
                            </script>        
                <?php
                    }
            }
        }
    $conn->close();
?>
