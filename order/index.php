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
      </div>
      <div class="col-md-4 float-left text-white border-primary" >
        <a href="../index.php" class="logo">
            <img src="../images/img/logo2.png" alt="">
            <b style="font-family: 'Roboto', sans-serif; font-size: 18px; font-weight: 1px; color:#ffffff"> &ensp;Hệ Thống Order</b>
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
  </div>
  
</nav>
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <?php include '../db_connect.php' ?>
  <main id="view-panel" >
      <div class="container-fluid o-field">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-8  p-field" style="flex:none ; max-width:100%">
            <div class="card border-primary">
                <div class="card-header bg-dark text-white  border-primary">
                    <b style="font-size: 20px; padding:43%">DANH SÁCH BÀN</b>
                </div>
                <div class="card-body bg-dark d-flex" id='prod-list'>
                    <div class="col-md-3">
                        <div class="w-100 pr-0 bg-white" id="cat-list">
                            <b>Khu vực</b>
                            <hr>
                            <?php 
                            $qry = $conn->query("SELECT DISTINCT KhuVuc FROM `ban` order by KhuVuc asc");
                            while($row=$qry->fetch_assoc()){
                            ?>
                            <div class="card bg-primary mx-3 mb-2 cat-item" style="height:auto !important;" data-id = '<?php echo $row['KhuVuc'] ?>'>
                                <div class="card-body">
                                    <span><b class="text-white">
                                        <?php echo "Khu ".ucwords($row['KhuVuc']) ?>
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
                            $prod = $conn->query("SELECT * FROM `ban` order by `MaBan` asc");
                            while($row=$prod->fetch_assoc())
                            {
                              $maban = $row['MaBan'];
                              $sql = $conn->query("SELECT *, SUM(o.SoLuong) as 'TongSL' FROM `order` o, `hoa_don_thanh_toan` h 
                              WHERE o.MaOrder = h.MaOrder
                              AND h.TienNhan = 0
                              AND o.MaBan = $maban
                              GROUP BY o.MaOrder");
                              if(($row1 = $sql->fetch_assoc())>0){
                                $MaOrder = $row1['MaOrder'];
                                $TongTien = $row1['TongTien'];
                                $TongSL = $row1['TongSL'];
                                ?>
                                <div class="col-md-3 mb-3" >
                                <div class="card bg-primary prod-item" style="background-color: black!important"
                                onclick="location.href='./order.php?ban=<?php echo $row['MaBan'] ?>'" 
                                data-json = '<?php echo json_encode($row) ?>' data-section="<?php echo $row['KhuVuc'] ?>">
                                    <div class="card-body">
                                        <span><center><b class="text-white">
                                            <?php echo "Bàn ".$row['MaBan']."</br>";
                                            echo "Mã Order: ".$MaOrder."</br>";
                                            echo "Tổng SL: ".$TongSL."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tổng tiền: ".$TongTien ?>
                                        </b></center></span>
                                    </div>
                                </div>
                            </div>
                                <?php
                              }
                              else
                              {
                            ?>
                            <div class="col-md-3 mb-3" >
                                <div class="card bg-primary prod-item"
                                onclick="location.href='./order.php?ban=<?php echo $row['MaBan'] ?>'" 
                                data-json = '<?php echo json_encode($row) ?>' data-section="<?php echo $row['KhuVuc'] ?>">
                                    <div class="card-body">
                                        <span><b class="text-white">
                                            <?php echo "Bàn ".$row['MaBan'] ?>
                                        </b></span>
                                    </div>
                                </div>
                            </div>
                        <?php 
                          }
                          } ?>
                        </div>
                    </div>   
                </div>
            <div class="card-footer bg-dark  border-primary">
                <div class="row justify-content-center">
                    <!-- <div class="btn btn btn-sm col-sm-3 btn-primary mr-2" type="button" id="pay">Pay</div> -->
                    <!-- <div class="btn btn btn-sm col-sm-3 btn-primary" type="button" id="save_order">Xác nhận Order</div> -->
                </div>
            </div>
            </div>      			
        </div>
    </div>
</div>
  </main>

  <!-- Loader -->
  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

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
            $('.prod-item').each(function(){
                if($(this).attr('data-section') == id){
                    $(this).parent().toggle(true)
                }else{
                    $(this).parent().toggle(false)
                }
            })
    })
   }

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