<!DOCTYPE html>
<html lang="en">
	
<?php session_start(); ?>
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
    
    .delete_order {
      border-radius: .25rem; 
      margin-top:-25px; 
      padding:2px; 
      padding-right: 5px; 
      padding-left: 5px;
      position:relative; 
      display:flex;
      margin-left:80%;
      top:30px;
    }
    
    .delete_order:hover {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .dropdown-item:hover {
      background-color: rgb(105, 104, 104, .4);
    }

    .logo {
      border: none;
      padding: 0px;
      margin: 0px;
    }
    .logo img{
      width: 35px;
      height: 35px;
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
        <a class="logo">
            <img class="logo" src="../images/img/logo2.png" alt="">
        </a>
      </div>
      <div class="float-right">
        <div class=" dropdown mr-4" >
        <i class="fas fa-user fa-lg" style="color: #ffffff; padding:0px; margin:0px; border:none"></i>&ensp;<a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:larger">Xin chào, <?php echo $_SESSION['name'] ?> </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -20px; top: 25px">
                <a class="dropdown-item" href="../index.php" id="home"><i class="fa fa-home"></i> Trang chủ</a>
                <a class="dropdown-item" href="../order/history.php" id="history"><i class="far fa-credit-card"></i> Lịch sử thanh toán</a>
                <button class="dropdown-item" id="logout" ><i class="fas fa-sign-out-alt" ></i> Đăng xuất</button>
        </div>
      </div>
  </div>
  
</nav>
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <?php include '../db_connect.php';
    $manv = 2023000003;
    if(isset($_GET['id'])){
      $ma_ban = $_GET['id'];
      $order = $conn->query("SELECT * FROM `order` o, `hoa_don_thanh_toan` h 
      WHERE o.MaOrder = h.MaOrder
      AND h.TienNhan = 0
      AND o.MaBan = $ma_ban
      GROUP BY o.MaOrder;");

      if (($row1 = $order->fetch_assoc()) > 0)
      {
        $MaOrder = $row1['MaOrder'];
        $items = $conn->query("SELECT * FROM `order` o, `do_uong` d Where d.MaDoUong = o.MaDoUong and o.MaBan = $ma_ban");
        $check = 1;
      }
      else
      {
        $sql = $conn->query("SELECT MAX(MaOrder) as 'MaOrder' FROM `order`");
        $row1 = $sql->fetch_assoc();
        $MaOrder = $row1['MaOrder'] + 1;
      }
    ?>
  <main id="view-panel" >
      <div class="container-fluid o-field">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-4">
           <div class="card bg-dark border-primary">
                <div class="card-header text-white  border-primary">
                    <b style="font-size:15px">MÓN ĐÃ CHỌN</b>   
                <span class="float:right"><a class="btn btn-primary btn-sm col-sm-3 float-right" style="right:-10px" href="../order/index.php" id="">
                  <i class="fas fa-list-ol" style="color: #fcfcfc;"></i> Chọn bàn
                </a></span>
                </div>
                <div class="card-body">
          <?php
            if (isset($check) == 1)
            {
              ?>
                  <button class="btn btn-primary btn-sm delete_order" type="submit" data-id="<?php echo $MaOrder?>">
                  <form action="./delete.php" id="delete_form" method="POST"><input type="hidden" name="ma_order_del" value="<?php echo $MaOrder?>"></form>Xóa Order</button>
              <?php
            }
            ?>
            <form action="./process.php" method="POST" id="manage-order">
                <input type="hidden" name="manv" value="<?php echo $manv?>">
                <div class="bg-white" id='o-list'>
                            <div class="d-flex w-100 bg-dark mb-1">
                                <label for="" class="text-white" style="padding-top:5px"><b>Mã Order</b></label>
                                <input type="number" class="form-control-sm" name="ma_order" id="ma_order" value="<?php echo $MaOrder ?>" style="margin:3px; margin-top: 0px; width:100px"  readonly="">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="" class="text-white" style="padding-top:5px"><b>Số bàn</b></label>
                                <input type="number" class="form-control-sm" name="ma_ban" id="ma_ban" value="<?php echo $ma_ban ?>" style="margin:3px; margin-top: 0px; width:100px"  readonly="">
                            </div>
                   <table class="table table-bordered bg-light">
                        <colgroup>
                            <col width="20%">
                            <col width="40%">
                            <col width="40%">
                            <col width="5%">
                        </colgroup>
                       <thead>
                           <tr>
                               <th>Số lượng</th>
                               <th>Tên món</th>
                               <th>Số tiền</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody>
                       <?php 
                          if(isset($items)){
                           while($row=$items->fetch_assoc()){
                           ?>
                           <tr data-id="<?php echo $row['MaDoUong'] ?>">
                               <td>
                                    <div class="d-flex">
                                        <span class="btn btn-sm btn-secondary btn-minus"><b><i class="fa fa-minus"></i></b></span>
                                        <input type="number" name="qty[]" id="" value="<?php echo $row['SoLuong'] ?>">
                                        <span class="btn btn-sm btn-secondary btn-plus"><b><i class="fa fa-plus"></i></b></span>
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="item_id[]" id="" value="<?php echo $row['MaOrder'] ?>">
                                    <input type="hidden" name="product_id[]" id="" value="<?php echo $row['MaDoUong'] ?>"><?php echo ucwords($row['TenDoUong']) ?>
                                </td>
                                <td class="text-right">
                                    <input type="hidden" name="price[]" id="" value="<?php echo $row['DonGia'] ?>">
                                    <input type="hidden" name="amount[]" id="" value="<?php echo $row['SoTien'] ?>">
                                    <span class="amount"><?php echo number_format($row['SoTien'],0) ?></span>
                                </td>
                                <td>
                                    <span class="btn btn-sm btn-danger btn-rem"><b><i class="fa fa-times text-white"></i></b></span>
                                </td>
                           </tr>
                           <?php
                           }
                          }
                          ?>
                           <script>
                               $(document).ready(function(){
                                 qty_func()
                                    calc()
                                    cat_func();
                               })
                           </script>
                       </tbody>
                   </table>
                </div>
                   <div class="d-block bg-white" id="calc" style="border-radius: .25rem">
                       <table class="" width="100%">
                           <tbody>
                                <tr>
                                   <td><b><h4>Tổng tiền</h4></b></td>
                                   <td class="text-right">
                                       <input type="hidden" name="total_amount" value="0">
                                       <input type="hidden" name="total_tendered" value="0">
                                       <span class=""><h4><b id="total_amount">0</b></h4></span>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
           </form>
               </div>
           </div>
        </div>
        <div class="col-lg-8  p-field">
            <div class="card border-primary">
                <div class="card-header bg-dark text-white  border-primary">
                    <b style="font-size: 20px; padding:40%">SẢN PHẨM</b>
                </div>
                <div class="card-body bg-dark d-flex" id='prod-list'>
                    <div class="col-md-3">
                        <div class="w-100 pr-0 bg-white" id="cat-list">
                            <b>Danh mục</b>
                            <hr>
                            <div class="card bg-primary mx-3 mb-2 cat-item" style="height:auto !important;" data-id = 'all'>
                                <div class="card-body">
                                    <span><b class="text-white">
                                        Tất cả
                                    </b></span>
                                </div>
                            </div>
                            <?php 
                            $qry = $conn->query("SELECT * FROM `danh_muc` order by TenDanhMuc asc");
                            while($row=$qry->fetch_assoc()){
                            ?>
                            <div class="card bg-primary mx-3 mb-2 cat-item" style="height:auto !important;" data-id = '<?php echo $row['MaDanhMuc'] ?>'>
                                <div class="card-body">
                                    <span><b class="text-white">
                                        <?php echo ucwords($row['TenDanhMuc']) ?>
                                    </b></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <hr>
                        <div class="row">
                            <?php
                            $prod = $conn->query("SELECT * FROM `do_uong` order by `TenDoUong` asc");
                            while($row=$prod->fetch_assoc()){
                            ?>
                            <div class="col-md-4 mb-2">
                                <div class="card bg-primary prod-item" data-json = '<?php echo json_encode($row) ?>' data-category-id="<?php echo $row['MaDanhMuc'] ?>">
                                    <div class="card-body">
                                        <span><b class="text-white">
                                            <?php echo $row['TenDoUong'] ?>
                                        </b></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>   
                </div>
            <div class="card-footer bg-dark  border-primary">
                <div class="row justify-content-center">
                    <?php 
                    if (isset($check) == 1)
                    {
                      ?>
                        <div class="btn btn btn-sm col-sm-3 btn-primary mr-2" type="button" id="pay">Thanh Toán</div>
                      <?php
                    }
                    ?> 
                    <button class="btn btn btn-sm col-sm-3 btn-primary" type="submit" id="save_order">
                      <?php 
                      if (isset($check)==1)
                      {echo "Cập nhật order";}
                      else
                      {echo "Tạo order mới";} 
                    ?>
                    </button>
                </div>
            </div>
            </div>      			
        </div>
    </div>
</div>
<div class="modal fade" id="pay_modal" role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"><b>Thanh toán</b></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form action="./pay.php" id="pay-order" method="post">
            <input type="hidden" name="ma_order" value="<?php echo $MaOrder;?>">
            <input type="hidden" name="maban" value="<?php echo $ma_ban;?>">
            <input type="hidden" name="total_amount" value="0">
            <input type="hidden" name="total_tendered" value="0">
            <div class="form-group">
                <label for="">Tổng tiền</label>
                <input type="text" class="form-control text-right" id="apayable" readonly="" value="">
            </div>
            <div class="form-group">
                <label for="">Tiền nhận</label>
                <input type="text" class="form-control text-right" id="tendered" value="0" autocomplete="off" pattern="[0-9]+.{4,}" required title="Số tiền tối thiểu là 1000">
            </div>
            <div class="form-group">
                <label for="">Tiền trả lại</label>
                <input type="text" class="form-control text-right" id="change" value="0" readonly="">
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" form="pay-order" id="pay-btn">Thanh toán</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
      </div>
      </div>
    </div>
  </div>
  </main>

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Xác nhận</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <?php 
    }
    else
    {
      ?>
      <script>
        alert("Vui lòng chọn bàn");
        location.assign("../order/index.php");
      </script>
      <?php
    }

    ?>
</body>
<script>
	 window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }
 window.viewer_modal = function($src = ''){
    start_load()
    var t = $src.split('.')
    t = t[1]
    if(t =='mp4'){
      var view = $("<video src='"+$src+"' controls autoplay></video>")
    }else{
      var view = $("<img src='"+$src+"' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
            show:true,
            backdrop:'static',
            keyboard:false,
            focus:true
          })
          end_load()  

}
  window.uni_modal = function($title = '' , $url='',$size="",$params = {}){
    start_load()
    $.ajax({
        url:$url,
        method:'POST',
        data:$params,
        error:err=>{
            console.log()
            alert("An error occured")
        },
        success:function(resp){
            if(resp){
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                if($size != ''){
                    $('#uni_modal .modal-dialog').addClass($size)
                }else{
                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-dialog-centered modal-md")
                }
                $('#uni_modal').modal({
                  show:true,
                  backdrop:'static',
                  keyboard:false,
                  focus:true
                })
                end_load()
            }
        }
    })
}
window._conf = function($msg='',$func='',$params = []){
     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
     $('#confirm_modal .modal-body').html($msg)
     $('#confirm_modal').modal('show')
  }
   window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }
  $(document).ready(function(){
    $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
  })
  $('.datetimepicker').datetimepicker({
      format:'Y/m/d H:i',
      startDate: '+3d'
  })
  $('.select2').select2({
    placeholder:"Please select here",
    width: "100%"
  })



// của home.php
  var total;
    cat_func();
   $('#prod-list .prod-item').click(function(){
        var data = $(this).attr('data-json')
            data = JSON.parse(data)
        if($('#o-list tr[data-id="'+data.MaDoUong+'"]').length > 0){
            var tr = $('#o-list tr[data-id="'+data.MaDoUong+'"]')
            var qty = tr.find('[name="qty[]"]').val();
                qty = parseInt(qty) + 1;
                qty = tr.find('[name="qty[]"]').val(qty).trigger('change')
                calc()
            return false;
        }
        var tr = $('<tr class="o-item"></tr>')
        tr.attr('data-id',data.MaDoUong)
        tr.append('<td><div class="d-flex"><span class="btn btn-sm btn-secondary btn-minus"><b><i class="fa fa-minus"></i></b></span><input type="number" name="qty[]" id="" value="1" readonly=""><span class="btn btn-sm btn-secondary btn-plus"><b><i class="fa fa-plus"></i></b></span></div></td>') 
        tr.append('<td><input type="hidden" name="item_id[]" id="" value="'+data.MaOrder+'"><input type="hidden" name="product_id[]" id="" value="'+data.MaDoUong+'">'+data.TenDoUong+'</td>') 
        tr.append('<td class="text-right"><input type="hidden" name="price[]" id="" value="'+data.DonGia+'"><input type="hidden" name="amount[]" id="" value="'+data.DonGia+'"><span class="amount">'+(parseInt(data.DonGia).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:0,maximumFractionDigits:0}))+'</span></td>') 
        tr.append('<td><span class="btn btn-sm btn-danger btn-rem"><b><i class="fa fa-times text-white"></i></b></span></td>')
        $('#o-list tbody').append(tr)
        qty_func()
        calc()
        cat_func()
   })
    function qty_func(){
         $('#o-list .btn-minus').click(function(){
            var qty = $(this).siblings('input').val()
                qty = qty > 1 ? parseInt(qty) - 1 : 1;
                $(this).siblings('input').val(qty).trigger('change')
                calc().clearQueue();
         })
         $('#o-list .btn-plus').click(function(){
            var qty = $(this).siblings('input').val()
                qty = parseInt(qty) + 1;
                $(this).siblings('input').val(qty).trigger('change')
                calc().clearQueue();
         })
         $('#o-list .btn-rem').click(function(){
            $(this).closest('tr').remove()
            calc().clearQueue();
         })
         
    }
    function calc(){
         $('[name="qty[]"]').each(function(){
            $(this).change(function(){
                var tr = $(this).closest('tr');
                var qty = $(this).val();
                var price = tr.find('[name="price[]"]').val()
                var amount = parseInt(qty) * parseInt(price);
                    tr.find('[name="amount[]"]').val(amount)
                    tr.find('.amount').text(parseInt(amount).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:0,maximumFractionDigits:0}))
                
            })
         })
         var total = 0;
         $('[name="amount[]"]').each(function(){
            total = parseInt(total) + parseInt($(this).val()) 
         })
            console.log(total)
        $('[name="total_amount"]').val(total)
        $('#total_amount').text(parseInt(total).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:0,maximumFractionDigits:0}))
    }
   function cat_func(){
    $('.cat-item').click(function(){
            var id = $(this).attr('data-id')
            console.log(id)
            if(id == 'all'){
                $('.prod-item').parent().toggle(true)
            }else{
                $('.prod-item').each(function(){
                    if($(this).attr('data-category-id') == id){
                        $(this).parent().toggle(true)
                    }else{
                        $(this).parent().toggle(false)
                    }
                })
            }
    })
   }
      $('#save_order').click(function(){
        start_load()
        var amount = $('[name="total_amount"]').val()
        if($('#o-list tbody tr').length <= 0){
            alert_toast("Vui lòng chọn ít nhất 1 món",'danger')
            end_load()
            return false;
        }
        else
        {
          if(confirm("Xác nhận order?")==true)
            {
              $('#manage-order').submit()
            }
        }
        setTimeout(function(){
            end_load()
        },200)
   })
   $("#pay").click(function(){
    start_load()
    var amount = $('[name="total_amount"]').val()
    if($('#o-list tbody tr').length <= 0){
        alert_toast("Vui lòng chọn ít nhất 1 món",'danger')
        end_load()
        return false;
    }
    $('#apayable').val(parseInt(amount).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:0,maximumFractionDigits:0}))
    $('#pay_modal').modal('show')
    var tend = 0;
    var amount=$('[name="total_amount"]').val()
    var change = parseInt(tend) - parseInt(amount)
    $('#change').val(parseInt(change).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:0,maximumFractionDigits:0}))
    if (change >= 0)
    {
      $('#pay-btn').prop('disabled', false)
    }
    else
    {
      $('#pay-btn').prop('disabled', true)
    }
    setTimeout(function(){
        $('#tendered').val('').trigger('change')
        $('#tendered').focus()
        end_load()
    },400)
   })

   $('#tendered').keyup('input',function(){
        var tend = $(this).val()
            tend =tend.replace(/,/g,'') 
        $('[name="total_tendered"]').val(tend)
        if(tend == '' || tend == ' ')
            $(this).val('')
        else
            $(this).val((parseInt(tend).toLocaleString("en-US")))
        tend = tend > 0 ? tend : 0;
        var amount=$('[name="total_amount"]').val()
        var change = parseInt(tend) - parseInt(amount)
        $('#change').val(parseInt(change).toLocaleString("en-US",{style:'decimal',minimumFractionDigits:0,maximumFractionDigits:0}))
        if (change >= 0)
        {
          $('#pay-btn').prop('disabled', false)
        }
        else
        {
          $('#pay-btn').prop('disabled', true)
        }
   })
   
    $('#tendered').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
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

   $('#logout').click(function(){
        start_load()
        if(confirm("Bạn muốn đăng xuất ?")==true)
          {
            alert("Đăng xuất thành công");
            var myWindow = window.open("../destroyss.php", "", "width=0, height=0");
            myWindow.blur();
            location.assign("../index.php");
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