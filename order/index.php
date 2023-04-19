<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="short icon" type="image/jpg" href="../images/img/logo2.png">
  <title>Hệ thống Order</title>


  <?php
  include('./header.php');
  ?>

</head>
<style>
  @import url('https://fonts.googleapis.com/css?family=Lobster');
  @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700');

  .container {
    margin: 0 auto;
    width: 1225px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  table a:-webkit-any-link {
    text-decoration: none;
    cursor: pointer;
    color: blue;
  }

  header {
    background: black;
    color: white;
    padding: 8px 20px 6px 40px;
    height: 50px;
  }

  header h1 {
    display: inline;
    font-family: 'Lobster', cursive;
    font-weight: 400;
    font-size: 32px;
    float: left;
    margin-top: 0px;
    margin-right: 10px;
  }

  nav ul {
    display: inline;
    padding: 0px;
    float: right;
  }

  nav ul li {
    display: inline-block;
    list-style-type: none;
    color: white;
    /* float: left;*/
    margin-left: 12px;


  }

  nav ul li a {
    color: white !important;
    text-decoration: none;
  }


  nav ul ul {
    display: none;
    position: absolute;
  }

  #navli ul li ul:hover {
    visibility: visible;
    display: block;
  }

  #navli {
    font-family: 'Montserrat', sans-serif;
  }

  .homered {
    background-color: red;
    padding: 30px 10px 22px 10px;
  }

  .divider {
    background-color: red;
    height: 5px;
  }

  .homeblack:hover {
    background-color: red;
    padding: 30px 10px 21px 10px;

  }
  body {
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

  #viewer_modal img,
  #viewer_modal video {
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

  .bg-gradient-primary {
    background: rgb(119, 172, 233);
    background: linear-gradient(149deg, rgba(119, 172, 233, 1) 5%, rgba(83, 163, 255, 1) 10%, rgba(46, 51, 227, 1) 41%, rgba(40, 51, 218, 1) 61%, rgba(75, 158, 255, 1) 93%, rgba(124, 172, 227, 1) 98%);
  }

  .btn-primary-gradient {
    background: linear-gradient(to right, #1e85ff 0%, #00a5fa 80%, #00e2fa 100%);
  }

  .btn-danger-gradient {
    background: linear-gradient(to right, #f25858 7%, #ff7840 50%, #ff5140 105%);
  }

  main .card {
    height: calc(100%);
  }

  main .card-body {
    height: calc(100%);
    overflow: auto;
    padding: 5px;
    position: relative;
  }

  main .container-fluid,
  main .container-fluid>.row,
  main .container-fluid>.row>div {
    height: calc(100%);
  }

  #o-list {
    height: calc(87%);
    overflow: auto;
  }

  #calc {
    position: absolute;
    bottom: 1rem;
    height: calc(10%);
    width: calc(98%);
  }

  .prod-item {
    min-height: 12vh;
    cursor: pointer;
  }

  .prod-item:hover {
    opacity: .8;
  }

  .prod-item .card-body {
    display: flex;
    justify-content: center;
    align-items: center;

  }

  input[name="qty[]"] {
    width: 30px;
    text-align: center
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  #cat-list {
    height: calc(100%)
  }

  .cat-item {
    cursor: pointer;
  }

  .cat-item:hover {
    opacity: .8;
  }

  .dropdown-item:hover {
    background-color: rgb(105, 104, 104, .4);
  }

  .del:hover {
    opacity: .9;
  }

  .logo {
    border: none;
    padding: 0px;
    margin: 0px;
  }

  .logo img {
    width: 35px;
    height: 35px;
  }

  .bg-primary {
    background-color: #ff4e21 !important;
  }
</style>
<?php
if (isset($_SESSION["status"]) == 'Success') {
?>
  <body>
    <header>
      <nav>
        <h1>Yvette Coffee</h1>
        <div class="col-md-4 float-left text-white">
        </div>
        <div class="float-right">
          <div class=" dropdown mr-4">
            <i class="fas fa-user fa-lg" style="color: #ffffff; padding:0px; margin:0px; border:none"></i>&ensp;<a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:larger">Xin chào, <?php echo $_SESSION['name'] ?> </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -20px; top: 25px">
              <a class="dropdown-item" href="../index.php" id="home"><i class="fa fa-home"></i> Trang chủ</a>
              <a class="dropdown-item" href="../order/history.php" id="history"><i class="far fa-credit-card"></i> Lịch sử thanh toán</a>
              <button class="dropdown-item" id="logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
            </div>
          </div>
        </div>
        </div>
      </nav>
    </header>
    <div class="divider"></div>

    <?php include '../db_connect.php' ?>
    <main id="view-panel" style="margin-top:0px">
      <div class="container-fluid o-field">
        <div class="row mt-3 ml-3 mr-3">
          <div class="col-lg-8  p-field" style="flex:none ; max-width:100%">
            <div class="card border-primary">
              <div class="card-header bg-dark text-white  border-primary">
                <b style="font-size: 20px; padding:43%">DANH SÁCH BÀN</b>
                <span class="float:right"><button class="btn btn-primary btn-sm col-sm-1 float-right del" style="top:-30px; right:-10px; margin-right: 10px; background-color: #ff182e; border-color: #ff182e;" id="del">
                    <i class="fas fa-trash-alt" style="color: #ffffff;"></i>&nbsp; Xóa
                  </button></span>
                <span class="float:right"><button class="btn btn-primary btn-sm col-sm-1 float-right" style="top:-30px; right:-10px; margin-right: 20px;" id="modify">
                    <i class="fas fa-pencil-alt" style="color: #ffffff;"></i>&nbsp; Sửa
                  </button></span>
                <span class="float:right"><button class="btn btn-primary btn-sm col-sm-1 float-right" style="top:-30px; right:-10px; margin-right: 20px;" id="add">
                    <i class="fas fa-plus" style="color: #ffffff;"></i>&nbsp; Thêm
                  </button></span>
              </div>
              <div class="card-body bg-dark d-flex" id='prod-list'>
                <div class="col-md-3">
                  <div class="w-100 pr-0 bg-white" id="cat-list">
                    <b>Khu vực</b>
                    <hr>
                    <?php
                    $qry = $conn->query("SELECT DISTINCT KhuVuc FROM `ban` order by KhuVuc asc");
                    while ($row = $qry->fetch_assoc()) {
                    ?>
                      <div class="card bg-primary mx-3 mb-2 cat-item" style="height:auto !important;" data-id='<?php echo $row['KhuVuc'] ?>'>
                        <div class="card-body">
                          <span><b class="text-white">
                              <?php echo "Khu " . ucwords($row['KhuVuc']) ?>
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
                    $sql3 = $conn->query("SELECT * FROM `ban` order by `MaBan` asc");
                    while ($row = $sql3->fetch_assoc()) {
                      $list[] = $row['MaBan'];
                      $maban = $row['MaBan'];
                      $sql = $conn->query("SELECT *, SUM(o.SoLuong) as 'TongSL' FROM `order` o, `hoa_don_thanh_toan` h 
                              WHERE o.MaOrder = h.MaOrder
                              AND h.TienNhan = 0
                              AND o.MaBan = $maban
                              GROUP BY o.MaOrder");
                      if (($row1 = $sql->fetch_assoc()) > 0) {
                        $MaOrder = $row1['MaOrder'];
                        $TongTien = $row1['TongTien'];
                        $TongSL = $row1['TongSL'];
                    ?>
                        <div class="col-md-3 mb-3">
                          <div class="card bg-primary prod-item" style="background-color: #121212 !important" onclick="location.href='./order.php?id=<?php echo $row['MaBan'] ?>'" data-json='<?php echo json_encode($row) ?>' data-section="<?php echo $row['KhuVuc'] ?>">
                            <div class="card-body">
                              <span>
                                <center><b class="text-white">
                                    <?php echo "Bàn " . $row['MaBan'] . "</br>";
                                    echo "Mã Order: " . $MaOrder . "</br>";
                                    echo "Tổng SL: " . $TongSL . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tổng tiền: " . $TongTien ?>
                                  </b></center>
                              </span>
                            </div>
                          </div>
                        </div>
                      <?php
                      } else {
                      ?>
                        <div class="col-md-3 mb-3">
                          <div class="card bg-primary prod-item" onclick="location.href='./order.php?id=<?php echo $row['MaBan'] ?>'" data-json='<?php echo json_encode($row) ?>' data-section="<?php echo $row['KhuVuc'] ?>">
                            <div class="card-body">
                              <span><b class="text-white">
                                  <?php echo "Bàn " . $row['MaBan'] ?>
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
            </div>
          </div>
        </div>
      </div>
      </div>

      <!-- FORM THÊM BÀN -->
      <div class="modal fade" id="add_modal" role='dialog'>
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><b>Thêm bàn</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="./add.php" name="add_form" id="add-form" method="post">
                  <div class="form-group">
                    <label for="">Nhập mã bàn</label>
                    <input type="text" class="form-control text-right" name="mabanadd" autocomplete="off" id="mabanadd" required>
                    <label id="maban_warn"></label>
                  </div>
                  <div class="form-group">
                    <label for="">Khu vực</label><br>
                    <select name="kv" class="form-control text-right" style="text-align:left !important" required>
                      <option selected value="A">Khu A</option>
                      <option value="B">Khu B</option>
                      <option value="C">Khu C</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm" form="add-form" id="add-btn">Thêm mới</button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
            </div>
          </div>
        </div>
      </div>

      <!-- FORM SỬA BÀN -->
      <div class="modal fade" id="modify_modal" role='dialog'>
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><b>Chỉnh sửa bàn</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="./process.php" name="modify_form" id="modify-form" method="post">
                  <div class="form-group">
                    <label for="">Chọn bàn cần sửa</label><br>
                    <select name="mabanmodify" class="form-control text-right" id="mabanmodify" style="text-align:left !important" required>
                      <?php
                      foreach ($list as $value) {
                        $sql5 = $conn->query("SELECT DISTINCT KhuVuc FROM `ban` WHERE MaBan = $value");
                        $row5 = $sql5->fetch_assoc();
                        $kv = $row5['KhuVuc'];
                        echo "<option class='$value' value='$value' name='$kv' >$value</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Nhập mã bàn</label>
                    <input type="text" class="form-control text-right" name="mabanmodify1" autocomplete="off" id="mabanmodify1" required>
                    <label id="mabanmodify_warn"></label>
                  </div>
                  <div class="form-group">
                    <label for="">Khu vực</label><br>
                    <select name="kv_modify" id="kv_modify" class="form-control text-right" style="text-align:left !important" required>
                      <option value="A">Khu A</option>
                      <option value="B">Khu B</option>
                      <option value="C">Khu C</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm" form="add-form" id="modify-btn">Xác nhận</button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
            </div>
          </div>
        </div>
      </div>

      <!-- FORM XÓA BÀN -->
      <div class="modal fade" id="del_modal" role='dialog'>
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><b>Xóa bàn</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form action="./delete.php" name="del_form" id="del-form" method="post">
                  <div class="form-group">
                    <label for="">Chọn bàn cần xóa</label><br>
                    <select name="mabandel" class="form-control text-right" id="mabandel" style="text-align:left !important" required>
                      <?php
                      foreach ($list as $value) {
                        echo "<option value='$value'>$value</option>";
                      }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm" id="del-btn">Xác nhận</button>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
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
    var dsmaban = <?php echo json_encode($list); ?>
  </script>
  <script>
    window.start_load = function() {
      $('body').prepend('<di id="preloader2"></di>')
    }
    window.end_load = function() {
      $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
    }
    window.viewer_modal = function($src = '') {
      start_load()
      var t = $src.split('.')
      t = t[1]
      if (t == 'mp4') {
        var view = $("<video src='" + $src + "' controls autoplay></video>")
      } else {
        var view = $("<img src='" + $src + "' />")
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
      $('#viewer_modal .modal-content').append(view)
      $('#viewer_modal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false,
        focus: true
      })
      end_load()

    }
    window.uni_modal = function($title = '', $url = '', $size = "", $params = {}) {
      start_load()
      $.ajax({
        url: $url,
        method: 'POST',
        data: $params,
        error: err => {
          console.log()
          alert("An error occured")
        },
        success: function(resp) {
          if (resp) {
            $('#uni_modal .modal-title').html($title)
            $('#uni_modal .modal-body').html(resp)
            if ($size != '') {
              $('#uni_modal .modal-dialog').addClass($size)
            } else {
              $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-dialog-centered modal-md")
            }
            $('#uni_modal').modal({
              show: true,
              backdrop: 'static',
              keyboard: false,
              focus: true
            })
            end_load()
          }
        }
      })
    }
    window._conf = function($msg = '', $func = '', $params = []) {
      $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
      $('#confirm_modal .modal-body').html($msg)
      $('#confirm_modal').modal('show')
    }
    window.alert_toast = function($msg = 'TEST', $bg = 'success') {
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

      if ($bg == 'success')
        $('#alert_toast').addClass('bg-success')
      if ($bg == 'danger')
        $('#alert_toast').addClass('bg-danger')
      if ($bg == 'info')
        $('#alert_toast').addClass('bg-info')
      if ($bg == 'warning')
        $('#alert_toast').addClass('bg-warning')
      $('#alert_toast .toast-body').html($msg)
      $('#alert_toast').toast({
        delay: 3000
      }).toast('show');
    }
    $(document).ready(function() {
      $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
    })
    $('.datetimepicker').datetimepicker({
      format: 'Y/m/d H:i',
      startDate: '+3d'
    })
    $('.select2').select2({
      placeholder: "Please select here",
      width: "100%"
    })



    // của home.php

    cat_func();

    function cat_func() {
      $('.cat-item').click(function() {
        var id = $(this).attr('data-id')
        console.log(id)
        $('.prod-item').each(function() {
          if ($(this).attr('data-section') == id) {
            $(this).parent().toggle(true)
          } else {
            $(this).parent().toggle(false)
          }
        })
      })
    }

    $('#logout').click(function() {
      start_load()
      if (confirm("Bạn muốn đăng xuất ?") == true) {
        alert("Đăng xuất thành công");
        var myWindow = window.open("../destroyss.php", "", "width=0, height=0");
        myWindow.blur();
        location.assign("../index.php");
      }
      setTimeout(function() {
        end_load()
      }, 200)
    })



    $("#add").click(function() {
      start_load()
      $('#add-btn').prop('disabled', true)
      document.getElementById("maban_warn").innerHTML = "";
      $('#add_modal').modal('show')
      setTimeout(function() {
        $('#mabanadd').focus()
        $('#mabanadd').val('')
        end_load()
      }, 200)
    })

    $('#mabanadd').keyup('input', function() {
      var check = 0;
      var x = $(this).val()
      x = x.replace(/,/g, '')
      if (x == '' || x == ' ' || x == 0) {
        $(this).val('')
      } else
        $(this).val((parseInt(x)))

      x = x.replace(/(^0*)/gi, "");
      console.log(x)
      for (i = 0; i < dsmaban.length; i++) {
        if (x == dsmaban[i]) {
          check = 1;
        }
      }
      if (check == 1) {
        document.getElementById("maban_warn").innerHTML = "<i style='color:red'>* Mã bàn đã tồn tại</i>";
        $('#add-btn').prop('disabled', true)
      } else {
        if (x == '') {
          document.getElementById("maban_warn").innerHTML = "";
          $('#add-btn').prop('disabled', true)
        } else {
          document.getElementById("maban_warn").innerHTML = "<i style='color:green'>* Mã bàn hợp lệ</i>";
          $('#add-btn').prop('disabled', false)
        }
      }
    })

    $('#mabanadd').on('input', function() {
      var val = $(this).val()
      val = val.replace(/[^0-9]/, '');
      $(this).val(val)
    })


    $("#del").click(function() {
      start_load()
      $('#del_modal').modal('show')
      setTimeout(function() {
        $('#mabandel').focus()
        end_load()
      }, 200)
    })

    $('#del-btn').click(function() {
      start_load()
      if (confirm("Bạn có chắn chắn muốn xóa order?") == true) {
        $('#del-form').submit()
      }
      setTimeout(function() {
        end_load()
      }, 200)
    })

    $('#mabanmodify1').keyup('input', function() {
      var check = 0;
      var x = $(this).val()
      x = x.replace(/,/g, '')
      if (x == '' || x == ' ' || x == 0) {
        $(this).val('')
      } else
        $(this).val((parseInt(x)))

      x = x.replace(/(^0*)/gi, "");
      console.log(x)
      for (i = 0; i < dsmaban.length; i++) {
        if (x == dsmaban[i]) {
          check = 1;
        }
      }
      if (check == 1) {
        document.getElementById("mabanmodify_warn").innerHTML = "<i style='color:red'>* Mã bàn đã tồn tại</i>";
        $('#modify-btn').prop('disabled', true)
      } else {
        if (x == '') {
          document.getElementById("mabanmodify_warn").innerHTML = "";
          $('#modify-btn').prop('disabled', true)
        } else {
          document.getElementById("mabanmodify_warn").innerHTML = "<i style='color:green'>* Mã bàn hợp lệ</i>";
          $('#modify-btn').prop('disabled', false)
        }
      }
    })
    $('#mabanmodify1').on('input', function() {
      var val = $(this).val()
      val = val.replace(/[^0-9]/, '');
      $(this).val(val)
    })

    $('#mabanmodify').change(function() {
      start_load()
      let ban = $('#mabanmodify').val()
      let kv = $('.' + ban).attr('name')
      if (kv == 'A') {
        $('#kv_modify').val('A');
      }
      if (kv == 'B') {
        $('#kv_modify').val('B');
      }
      if (kv == 'C') {
        $('#kv_modify').val('C');
      }
      console.log(ban)
      console.log(kv)
      setTimeout(function() {
        $('#mabanmodify1').focus()
        $('#mabanmodify1').val('')

        end_load()
      }, 200)
    })

    $("#modify").click(function() {
      start_load()
      document.getElementById("mabanmodify_warn").innerHTML = "";
      $('#modify-btn').prop('disabled', true)
      $('#modify_modal').modal('show')
      let ban = $('#mabanmodify').val()
      let kv = $('.' + ban).attr('name')
      if (kv == 'A') {
        $('#kv_modify').val('A');
      }
      if (kv == 'B') {
        $('#kv_modify').val('B');
      }
      if (kv == 'C') {
        $('#kv_modify').val('C');
      }
      console.log(ban)
      console.log(kv)

      setTimeout(function() {
        $('#mabanmodify1').focus()
        $('#mabanmodify1').val('')

        end_load()
      }, 200)
    })

    $('#modify-btn').click(function() {
      start_load()
      if (confirm("Bạn có chắc muốn thay đổi?") == true) {
        $('#modify-form').submit()
      }
      setTimeout(function() {
        end_load()
      }, 200)
    })
  </script>

</html>
<?php
} else {
?>
  <script>
    alert("Vui lòng đăng nhập");
    location.assign("../index.php");
  </script>
<?php
}
?>