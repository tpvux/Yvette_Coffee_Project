<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="short icon" type="image/jpg" href="../images/img/logo2.png">
  <title>Lịch sử thanh toán</title>


  <?php
  include('./header.php');
  include_once '../db_connect.php';
  ?>

</head>
<body>
<?php

if (isset($_GET['id'])) {
	$maod = $_GET['id'];
	$sql2 = $conn->query("SELECT TienNhan, TongTien, ThoiGianThanhToan, TenNV, MaBan FROM `nhan_vien` n, `order` o, `hoa_don_thanh_toan` h Where o.MaOrder = h.MaOrder and o.MaNV = n.MaNV and o.MaOrder = $maod");
	$row1 = $sql2->fetch_assoc();
	$tn = $row1['TienNhan'];
	$tt = $row1['TongTien'];
	$date = $row1['ThoiGianThanhToan'];
	$nv = $row1['TenNV'];
	$ban = $row1['MaBan'];
?>
	<!-- Form View hóa đơn -->
			<div class="container-fluid py-1">
					<div class="modal-body">
						<div class="container-fluid">
							<h5>
								<p class="text-center"><b><?php echo $tn > 0 ? "Hóa đơn thanh toán" : "Chi tiết order" ?></b></p>
							</h5>
							<hr>
							<?php
							$sql3 = $conn->query("SELECT * FROM `order` o, `do_uong` d, `hoa_don_thanh_toan` h Where d.MaDoUong = o.MaDoUong and o.MaOrder = h.MaOrder and o.MaOrder = $maod");
							if ($sql3->num_rows > 0) {
							?>
								<div class="flex">
									<div class="w-100">
										<p style="font-size:15px">Mã Order: <b><?php echo $maod ?></b></p>
										<p style="font-size:15px">Tên nhân viên: <b><?php echo $nv ?></b></p>
										<p style="font-size:15px">Bàn số: <b><?php echo $ban ?></b></p>
										<p style="font-size:15px">Ngày: <b><?php
													if ($tn > 0) {
														echo date("M d, Y", strtotime($date));
													} else {
														echo "";
													}
													?></b></p>
									</div>
								</div>
								<hr>
								<p><b style="font-size:20px">Danh sách món</b></p>
								<table width="100%">
									<thead>
										<tr>
											<td><b>Số lượng</b></td>
											<td><b>Tên món</b></td>
											<td class="text-right"><b>Số tiền</b></td>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($row3 = $sql3->fetch_assoc()) { ?>
											<tr>
												<td><?php echo $row3['SoLuong'] ?></td>
												<td>
													<p><?php echo $row3['TenDoUong'] ?></p><?php if ($row3['SoLuong'] > 0) {
																							?><small>(<?php echo $row3['DonGia'] ?>)</small> <?php } ?>
												</td>
												<td class="text-right"><?php echo $row3['SoTien'] ?></td>
											</tr>
									<?php
										}
									?>
									</tbody>
								</table>
								<hr>
								<table width="100%">
									<tbody>
										<tr>
											<td><b>Tổng tiền</b></td>
											<td class="text-right"><b><?php echo $tt ?></b></td>
										</tr>
										<?php if ($tn > 0) {
										?>
											<tr>
												<td><b>Tiền nhận</b></td>
												<td class="text-right"><b><?php echo $tn  ?></b></td>
											</tr>
											<tr>
												<td><b>Tiền thừa</b></td>
												<td class="text-right"><b><?php echo $tn - $tt  ?></b></td>
											</tr>
										<?php }
										} ?>
									</tbody>
								</table>
						</div>
					</div>
					<div class="modal-footer">
						<?php 
							if (1 > 0) {
								?>
								<button class="btn btn-success mr-2" type="button" id="print" onclick="print()">Print</button>
								<?php
							} else {
								echo "";
							}
						?>
						<button class="btn float-right btn-secondary" type="button" onclick="location.href='./history.php'" >Quay lại</button>
							<script>
							function print() {
								var nw = window.open('./receipt.php?id=<?php echo $maod ?>',"_blank","width=900,height=600")
								nw.print()
							}
                		</script>
					</div>
				</div>
			</div>
		</div>
	</div>

	<style>
		.flex {
			display: inline-flex;
			width: 100%;
		}

		.w-50 {
			width: 50%;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		table.wborder {
			width: 100%;
			border-collapse: collapse;
		}

		table.wborder>tbody>tr,
		table.wborder>tbody>tr>td {
			border: 1px solid;
		}

		p {
			margin: unset;
		}

		td {
			font-size: 15px;
		}
	</style>

	
<?php
    } else {
    ?>
      <script>
        alert("Lỗi hệ thống");
        location.assign("./history.php");
      </script>
    <?php
    }