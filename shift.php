<!DOCTYPE html>
<html lang="en">

<?php session_start();
include './db_connect.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="./images/img/logo2.png">
    <title>Quản lý ca làm việc</title>


    <?php
    include('./header.php');
    ?>

</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Lobster');
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700');

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
    
    .reset:hover {
        opacity: .8;
    }

    .del-btn:hover {
        opacity: .8;
    }
</style>
<?php
if (isset($_SESSION["status"]) == 'Success') {
    $sql0 = $conn->query("SELECT * FROM `ca_lam_viec`");
    if ($sql0->num_rows > 0) {
        while ($row0 = $sql0->fetch_assoc()) {
            $ngay = $row0['Ngay'];
            $ca = $row0['Ca'];
            $nv = $row0['MaNV'];

            $list1[] = $ngay;
            $list2[] = $ca;
            $list3[] = $nv;
        }
    }

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
                        <div class="dropdown-menu" aria-labelledby="account_settings" style="left: 10px; top: 20px">
                            <a class="dropdown-item" href="./index.php" id="home"><i class="fa fa-home"></i> Trang chủ</a>
                            <a class="dropdown-item" href="./order/index.php" id="history"><i class="fas fa-cart-plus"></i> Order</a>
                            <a class="dropdown-item" href="./order/history.php" id="history"><i class="far fa-credit-card"></i> Lịch sử thanh toán</a>
                            <button class="dropdown-item" id="logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
                        </div>
                    </div>
                </div>
                </div>
            </nav>
        </header>
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
                                <b style="font-size: 15px;">Lịch làm việc</b>
                                </a>
                                <?php 
                                if (($_SESSION["chucvu"]=='Quản lý') || ($_SESSION["chucvu"]=='Chủ quán'))
                                {
                                ?>
                                <span class="float:right"><button class="btn btn-primary btn-sm col-sm-1 float-right reset" style="margin-right: 10px; background-color:green; border-color:green;" id="reset">
                                        <form action="./shift_process.php" name="reset_form" id="reset-form" method="post">
                                            <input type="hidden" name="reset">
                                        </form>
                                        <i class="fas fa-sync" style="color: #ffffff;"></i>&nbsp; Làm mới lịch
                                    </button></span>
                                <span class="float:right"><button class="btn btn-primary btn-sm col-sm-1 float-right" style="margin-right: 20px;" id="add">
                                        <i class="fas fa-plus" style="color: #ffffff;"></i>&nbsp; Thêm
                                    </button></span>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <table class="table table-condensed table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th class="text-center">Thứ 2</th>
                                            <th class="text-center">Thứ 3</th>
                                            <th class="text-center">Thứ 4</th>
                                            <th class="text-center">Thứ 5</th>
                                            <th class="text-center">Thứ 6</th>
                                            <th class="text-center">Thứ 7</th>
                                            <th class="text-center">Chủ nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_ca = "SELECT DISTINCT Ca FROM ca_lam_viec order by Ca asc";
                                        $query_ca = mysqli_query($conn, $select_ca);
                                        if ($query_ca->num_rows > 0) {
                                            while ($row = mysqli_fetch_assoc($query_ca)) {
                                        ?>
                                                <tr>
                                                    <th id="ca<?php echo $row['Ca']; ?>" name="<?php echo $row['Ca']; ?>" style="vertical-align:middle;" class="text-center">Ca <?php echo $row['Ca']; ?></th>
                                                    <?php
                                                    for ($i = 2; $i < 9; $i++) {
                                                    ?>
                                                        <td id="ca<?php echo $row['Ca']; ?>" name="<?php echo $row['Ca']; ?>" style="vertical-align:middle !important;">
                                                            <?php
                                                            $select_ngay = "SELECT * FROM `ca_lam_viec` c, `nhan_vien` n WHERE c.MaNV = n.MaNV AND Ca = '" . $row['Ca'] . "'";
                                                            $query_ngay = mysqli_query($conn, $select_ngay);
                                                            $r = 0;
                                                            if ($query_ngay->num_rows > 0) {
                                                                while ($rows = mysqli_fetch_assoc($query_ngay)) {
                                                                    if ($rows['Ngay'] == $i) {
                                                                        echo '<p>- ' . $rows['TenNV'] . '</p><br>';
                                                                        $r = 1;
                                                                    } else
                                                                        echo "";
                                                                }
                                                                if ($r == 1) {
                                                                    if (($_SESSION["chucvu"]=='Quản lý') || ($_SESSION["chucvu"]=='Chủ quán'))
                                                                    {
                                                            ?>
                                                                    <span>
                                                                        <button class="btn btn-sm btn-primary" style="margin-left: 30px:" type="button" onclick="location.href='./shift_modify.php?ngay=<?php echo $i ?>&ca=<?php echo $row['Ca'] ?>'">
                                                                            <i class="fas fa-pencil-alt" style="color: #ffffff;"></i>&nbsp; Sửa</button>
                                                                        <button class="btn btn-sm btn-primary del-btn" style="margin-right: 10px; background-color: #dc3545; border-color: #dc3545;" type="button" onclick="location.href='./shift_delete.php?ngay=<?php echo $i ?>&ca=<?php echo $row['Ca'] ?>'">
                                                                            <i class="fas fa-trash-alt" style="color: #ffffff;"></i>&nbsp; Xóa</button>
                                                                    </span>
                                                            <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>

                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr class="text-center">
                                                <td colspan="8">
                                                    <h6>Lịch trống</h6>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FORM THÊM CA -->
        <div class="modal fade" id="add_modal" role='dialog'>
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Thêm ca</b></h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="./shift_process.php" name="add_form" id="add-form" method="post">
                                <input type="hidden" name="shift_add">
                                <div class="form-group">
                                    <label for="">Chọn ngày</label><br>
                                    <select id="ngay_add" name="ngay" class="form-control text-right" style="text-align:left !important" required>
                                        <option selected value=2>Thứ 2</option>
                                        <option value="3">Thứ 3</option>
                                        <option value="4">Thứ 4</option>
                                        <option value="5">Thứ 5</option>
                                        <option value="6">Thứ 6</option>
                                        <option value="7">Thứ 7</option>
                                        <option value="8">Chủ nhật</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Chọn ca</label><br>
                                    <select id="ca_add" name="ca" class="form-control text-right" style="text-align:left !important" required>
                                        <option selected value="1">Ca 1</option>
                                        <option value="2">Ca 2</option>
                                        <option value="3">Ca 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Chọn nhân viên</label><br>
                                    <select id="nv_add" name="nv" class="form-control text-right" style="text-align:left !important" required>
                                        <?php
                                        $sql2 = $conn->query("SELECT DISTINCT * FROM nhan_vien WHERE ChucVu = 'Nhân viên' order by MaNV asc");
                                        if ($sql2->num_rows > 0) {
                                            while ($row2 = $sql2->fetch_assoc()) {
                                        ?>
                                                <option value='<?php echo $row2['MaNV'] ?>'><?php echo $row2['TenNV'] ?></option>";
                                        <?php
                                            }
                                        }
                                        ?>
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

        <!-- Loader -->
        <div id="preloader"></div>
        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    </body>
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
                var myWindow = window.open("./destroyss.php", "", "width=0, height=0");
                myWindow.blur();
                location.assign("./index.php");
                location.reload();
            }
            setTimeout(function() {
                end_load()
            }, 200)
        })


        $("#add").click(function() {
            start_load()
            $('#add_modal').modal('show')
            setTimeout(function() {
                $('#ngay_add').focus()
                end_load()
            }, 200)
        })

        $('#reset').click(function() {
            start_load()
            if (confirm("Bạn có chắc muốn làm mới toàn bộ?") == true) {
                $('#reset-form').submit()
            }
            setTimeout(function() {
                end_load()
            }, 200)
        })


        $('#modify-btn').click(function() {
            start_load()
            $('#modify-form').submit()
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