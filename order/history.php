<!DOCTYPE html>
<html lang="en">
	
<?php session_start(); 
include '../db_connect.php';
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hệ thống Order</title>
 	

<?php
 include('./header.php');
 ?>

</head>
<style>
	body{
        background: #80808045;
        position: fixed;
        width: calc(100%);
        height: calc(100%);
        overflow: auto;
  }
    main#view-panel {
        height: calc(100% - 4em);
    }
  .modal-dialog.large {
    width: 80% !important;
    max-width: unset;
  }
  .modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
  }
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /*right: -4.5em;*/
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
}
#viewer_modal .modal-dialog {
        width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
}
  #viewer_modal .modal-content {
       background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #viewer_modal img,#viewer_modal video{
    max-height: calc(100%);
    max-width: calc(100%);
  }
  main#view-panel {
     margin-left: inherit; 
    width: calc(100%);
  }



/* Home.php */
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
    .bg-gradient-primary{
        background: rgb(119,172,233);
        background: linear-gradient(149deg, rgba(119,172,233,1) 5%, rgba(83,163,255,1) 10%, rgba(46,51,227,1) 41%, rgba(40,51,218,1) 61%, rgba(75,158,255,1) 93%, rgba(124,172,227,1) 98%);
    }
    .btn-primary-gradient{
        background: linear-gradient(to right, #1e85ff 0%, #00a5fa 80%, #00e2fa 100%);
    }
    .btn-danger-gradient{
        background: linear-gradient(to right, #f25858 7%, #ff7840 50%, #ff5140 105%);
    }
    main .card{
        height:calc(100%);
    }
    main .card-body{
        height:calc(100%);
        overflow: auto;
        padding: 5px;
        position: relative;
    }
    main .container-fluid, main .container-fluid>.row,main .container-fluid>.row>div{
        height:calc(100%);
    }
    #o-list{
        height: calc(87%);
        overflow: auto;
    }
    #calc{
        position: absolute;
        bottom: 1rem;
        height: calc(10%);
        width: calc(98%);
    }
    .prod-item{
        min-height: 12vh;
        cursor: pointer;
    }
    .prod-item:hover{
        opacity: .8;
    }
    .prod-item .card-body {
        display: flex;
        justify-content: center;
        align-items: center;

    }
    input[name="qty[]"]{
        width: 30px;
        text-align: center
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    #cat-list{
        height: calc(100%)
    }
    .cat-item{
        cursor: pointer;
    }
    .cat-item:hover{
        opacity: .8;
    }
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height:150px;
	}
</style>
<?php 
if (isset($_SESSION["status"])=='Success')
{
?>
<body>
<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0">
  <div class="container-fluid mt-2 mb-2">
    <div class="col-lg-12">
      <div class="col-md-1 float-left" style="display: flex;">
      
      </div>
      <div class="col-md-4 float-left text-white">
        <large><b><?php //session_name ?></b></large>
      </div>
      <div class="float-right">
        <div class=" dropdown mr-4">
        <i class="fas fa-user fa-lg" style="color: #ffffff; padding:0px; margin:0px; border:none"></i>&ensp;<a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:larger">Xin chào, <?php echo $_SESSION['name'] ?> </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: 10px; top: 20px">
                <a class="dropdown-item" href="../index.php" id="home"><i class="fa fa-home"></i> Trang chủ</a>
                <a class="dropdown-item" href="../order/history.php" id="history"><i class="fas fa-cart-plus"></i> Order</a>
                <button class="dropdown-item" id="logout" ><i class="fas fa-sign-out-alt" ></i> Đăng xuất</button>
        </div>
        </div>
      </div>
  </div>
  
</nav>
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  transform: scale(1.3);
  padding: 10px;
  cursor:pointer;
}
</style>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Lịch sử thanh toán</b>
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="">Trạng thái</th>
									<th class="">Mã Order</th>
									<th class="">Tổng tiền</th>
									<th class="">Tiền Nhận</th>
									<th class="">Tiền Thừa</th>
									<th class="">Thời gian</th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$sql = $conn->query("SELECT * FROM hoa_don_thanh_toan order by ThoiGianThanhToan desc");
								while($row=$sql->fetch_assoc())
                                {
                                    $sql1 = $conn->query("SELECT * FROM `order` WHERE MaOrder = ".$row['MaOrder']);
                                    while($row1=$sql1->fetch_assoc())
                                    {
                                        $maban = $row1['MaBan'];
                                    }
								?>
								<tr>
                                    <td class="text-center">
                                        <?php if($row['TienNhan'] > 0){ ?>
											<span class="badge badge-success">Đã thanh toán</span>
                                        <?php }else{ ?>
                                            <span class="badge badge-primary">Chưa thanh toán</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <p> <b><?php echo $row['MaOrder'] ?></b></p>
									</td>
									<td>
                                        <p class="text-right"> <b><?php echo number_format($row['TongTien'],0) ?></b></p>
									</td>
                                    <td>
                                        <p class="text-right"> <b><?php echo number_format($row['TienNhan'],0) ?></b></p>
									</td>
                                    <td>
                                        <p class="text-right"> <b>
                                        <?php if($row['TienNhan'] > 0){
                                            echo number_format($row['TienNhan']-$row['TongTien'],0) ?></b></p>
                                        <?php }else{
                                            echo 0 ?></b></p>
                                        <?php } ?>
									</td>
									
                                    <td>
                                        <p> <b>
                                            <?php 
                                        if ($row['TienNhan'] > 0)
                                        {
                                            echo date("Y-m-d G:i:s",strtotime($row['ThoiGianThanhToan']));
                                        }
                                        else
                                        {
                                            echo "";
                                        }
                                        ?>
                                        </b></p>
                                    </td>
									<td class="text-center">
                                        <?php 
                                        if ($row['TienNhan'] > 0)
                                        {?>
                                            <button class="btn btn-sm btn-outline-primary view_order" type="button" data-id="<?php echo $row['MaOrder'] ?>">Xem</button>
                                        <?php }
                                        else
                                        {?>
                                            <button class="btn btn-sm btn-outline-primary view_order" type="button" data-id="<?php echo $row['MaOrder'] ?>">Xem</button>
                                            <button class="btn btn-sm btn-outline-primary " type="button" onclick="location.href='../order/order.php?ban=<?php echo $maban ?>'" >Sửa</button>
                                            <button class="btn btn-sm btn-outline-danger delete_order" type="submit" data-id="<?php echo $row['MaOrder'] ?>">
                                            <form action="../order/delete.php" id="delete_form" method="POST"><input type="hidden" name="ma_order_del" value="<?php echo $MaOrder?>"></form>Xóa</button>
                                        <?php }
                                        ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<script>
    $(document).ready(function(){
		$('table').dataTable()
	})
	$('.view_order').click(function(){
		uni_modal("Order  Details","view_order.php?id="+$(this).attr('data-id'),"mid-large")
	})
	$('.delete_order').click(function(){
        start_load()
        if(confirm("Bạn có chắn chắn muốn xóa order?")==true)
          {
            $('#delete_form').submit()
          }
        setTimeout(function(){
            end_load()
        },200)
   })
</script>
</html>
<?php
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