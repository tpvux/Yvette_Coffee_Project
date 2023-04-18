<!DOCTYPE html>
<html lang="en">

<?php
include '../db_connect.php';
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="../images/img/logo2.png">
    <title>Lịch sử thanh toán</title>


    <?php
    include('./header.php');
    ?>

</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Lobster');
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700');

    body {
        margin: 0px;
    }

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

    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset
    }

    img {
        max-width: 100px;
        max-height: 150px;
    }
</style>
<?php
if (isset($_SESSION["status"]) == 'Success') {
?>

    <body>
        <header>
            <nav>
                <h1>Yvette</h1>
                <div class="col-md-4 float-left text-white">
                </div>
                <div class="float-right">
                    <div class=" dropdown mr-4">
                        <i class="fas fa-user fa-lg" style="color: #ffffff; padding:0px; margin:0px; border:none"></i>&ensp;<a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:larger">Xin chào, <?php echo $_SESSION['name'] ?> </a>
                        <div class="dropdown-menu" aria-labelledby="account_settings" style="left: 10px; top: 20px">
                            <a class="dropdown-item" href="../index.php" id="home"><i class="fa fa-home"></i> Trang chủ</a>
                            <a class="dropdown-item" href="../order/index.php" id="history"><i class="fas fa-cart-plus"></i> Order</a>
                            <button class="dropdown-item" id="logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                        </div>
                    </div>
                </div>
                </div>
            </nav>
        </header>
        <style>
            input[type=checkbox] {
                /* Double-sized Checkboxes */
                -ms-transform: scale(1.3);
                /* IE */
                -moz-transform: scale(1.3);
                /* FF */
                -webkit-transform: scale(1.3);
                /* Safari and Chrome */
                -o-transform: scale(1.3);
                /* Opera */
                transform: scale(1.3);
                padding: 10px;
                cursor: pointer;
            }
        </style>
        <div class="divider"></div>
        <div class="container-fluid">

            <div class="col-lg-12">
                <div class="row mb-4 mt-2">
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
                                        while ($row = $sql->fetch_assoc()) {
                                            $maod[] = $row['MaOrder'];
                                            $sql1 = $conn->query("SELECT * FROM `order` o, `hoa_don_thanh_toan` h, `do_uong` d WHERE o.MaOrder = h.MaOrder AND o.MaDoUong = d.MaDoUong AND o.MaOrder = " . $row['MaOrder']);
                                            while ($row1 = $sql1->fetch_assoc()) {
                                                $tn[] = $row1['TienNhan'];
                                                $tt[] = $row1['TongTien'];
                                                $date[] = $row1['ThoiGianThanhToan'];
                                                $list1[] = $row1['SoLuong'];
                                                $list2[] = $row1['TenDoUong'];
                                                $list3[] = $row1['SoTien'];
                                                $maban = $row1['MaBan'];
                                            }
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php if ($row['TienNhan'] > 0) { ?>
                                                        <span class="badge badge-success">Đã thanh toán</span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-primary">Chưa thanh toán</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <p> <b><?php echo $row['MaOrder'] ?></b></p>
                                                </td>
                                                <td>
                                                    <p class="text-right"> <b><?php echo number_format($row['TongTien'], 0) ?></b></p>
                                                </td>
                                                <td>
                                                    <p class="text-right"> <b><?php echo number_format($row['TienNhan'], 0) ?></b></p>
                                                </td>
                                                <td>
                                                    <p class="text-right"> <b>
                                                            <?php if ($row['TienNhan'] > 0) {
                                                                echo number_format($row['TienNhan'] - $row['TongTien'], 0) ?></b></p>
                                                <?php } else {
                                                                echo 0 ?></b></p>
                                                <?php } ?>
                                                </td>

                                                <td>
                                                    <p> <b>
                                                            <?php
                                                            if ($row['TienNhan'] > 0) {
                                                                echo date("Y-m-d G:i:s", strtotime($row['ThoiGianThanhToan']));
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                        </b></p>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['TienNhan'] > 0) { ?>
                                                        <button class="btn btn-sm btn-outline-primary view_order" type="button" onclick="location.href='./view.php?id=<?php echo $row['MaOrder'] ?>'">Xem</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-sm btn-outline-primary view_order" type="button" onclick="location.href='./view.php?id=<?php echo $row['MaOrder'] ?>'">Xem</button>
                                                        <button class="btn btn-sm btn-outline-primary " type="button" onclick="location.href='./order.php?id=<?php echo $maban ?>'">Sửa</button>
                                                        <button class="btn btn-sm btn-outline-danger delete_order" value="<?php echo $row['MaOrder'] ?>" type="button">Xóa</button>
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
        <div id="preloader"></div>
        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

        <script>
            $(document).ready(function() {
                $('#preloader').fadeOut('fast', function() {
                    $(this).remove();
                })
                $('.table').dataTable()
            })
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
            window.uni_modal = function($title = '', $url = '', $size = "") {
                start_load()
                $.ajax({
                    url: $url,
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
                                $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
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

            $('.datetimepicker').datetimepicker({
                format: 'Y/m/d H:i',
                startDate: '+3d'
            })
            $('.select2').select2({
                placeholder: "Please select here",
                width: "100%"
            })

            $('.delete_order').click(function() {
                start_load()
                var x = $(this).val()
                if (confirm("Bạn có chắn chắn muốn xóa order?") == true) {
                    location.assign("./delete.php?id="+x);
                }
                setTimeout(function() {
                    end_load()
                }, 200)
            })
        </script>
    </body>

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