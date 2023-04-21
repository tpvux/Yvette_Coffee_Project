<?php
include '../db_connect.php';
include_once "./header.php";
session_start();
?>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link rel="short icon" type="image/jpg" href="../images/img/logo2.png">
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
	</head>
<?php
if (isset($_SESSION["status"])=='Success')
{
	if (isset($_GET['id'])) {
	$maod = $_GET['id'];
?>
	<!-- Form View hóa đơn -->
	<div class="container-fluid py-1">
		<div class="modal-body">
			<div class="container-fluid">
				<center><img src="../images/img/logo2.png" alt="" height="200px" width="200px" ></center>
				<?php
				$sql2 = $conn->query("SELECT TienNhan, TongTien, ThoiGianThanhToan, TenNV, MaBan FROM `nhan_vien` n, `order` o, `hoa_don_thanh_toan` h Where o.MaOrder = h.MaOrder and o.MaNV = n.MaNV and o.MaOrder = $maod");
				$sql3 = $conn->query("SELECT * FROM `order` o, `do_uong` d, `hoa_don_thanh_toan` h Where d.MaDoUong = o.MaDoUong and o.MaOrder = h.MaOrder and o.MaOrder = $maod");
				$row1 = $sql2->fetch_assoc();
				$tn = $row1['TienNhan'];
				$tt = $row1['TongTien'];
				$date = $row1['ThoiGianThanhToan'];
				$nv = $row1['TenNV'];
				$ban = $row1['MaBan'];
				?>
				<title><?php echo $tn > 0 ? "Hóa đơn thanh toán" : "Chi tiết order" ?></title>

				<h5>
					<p class="text-center"><b><?php echo $tn > 0 ? "Hóa đơn thanh toán" : "Chi tiết order" ?></b></p>
				</h5>
				<hr>
				<?php
				if ($sql3->num_rows > 0) {
				?>
					<div class="flex">
						<div class="w-100">
							<p>Mã Order: <b><?php echo $maod ?></b></p>
							<p>Bàn số: <b><?php echo $ban ?></b></p>
							<p>Tên nhân viên: <b><?php echo $nv ?></b></p>
							<p>Ngày: <b><?php
										if ($tn > 0) {
											echo date("M d, Y", strtotime($date));
										} else {
											echo "";
										}
										?></b></p>
						</div>
					</div>
					<hr>
					<p><b style="font-size:15px">Danh sách món</b></p>
					<table width="100%">
						<thead>
							<tr>
								<td style="font-size:12px"><b>Số lượng</b></td>
								<td style="font-size:12px"><b>Tên món</b></td>
								<td style="font-size:12px" class="text-right"><b>Số tiền</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row3 = $sql3->fetch_assoc()) { ?>
								<tr>
									<td style="font-size:12px"><?php echo $row3['SoLuong'] ?></td>
									<td style="font-size:12px">
										<p><?php echo $row3['TenDoUong'] ?></p><?php if ($row3['SoLuong'] > 0) {
																				?><small>(<?php echo $row3['DonGia'] ?>)</small> <?php } ?>
									</td>
									<td style="font-size:12px" class="text-right"><?php echo $row3['SoTien'] ?></td>
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