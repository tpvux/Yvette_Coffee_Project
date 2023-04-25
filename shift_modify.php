<?php
ob_start();

include './db_connect.php';
include_once './header.php';
session_start();
if (isset($_SESSION["status"]) == 'Success') {
    if (isset($_GET)) {
        $ngay = $_GET['ngay'];
        $ca = $_GET['ca'];
        $sql1 = $conn->query("SELECT * FROM `ca_lam_viec` c, `nhan_vien` n WHERE c.MaNV = n.MaNV AND c.Ngay = $ngay AND c.Ca = $ca");
        $sql2 = $conn->query("SELECT DISTINCT * FROM `nhan_vien`  WHERE ChucVu = 'Nhân viên'");
        if ($sql2->num_rows > 0) {
            while ($row2 = $sql2->fetch_assoc()) {
                $k = $row2['MaNV'];
                $v = $row2['TenNV'];
                $list["$k"] = $v;
            }
        }
        if (($n = $sql1->num_rows) > 0) {
            while ($row1 = $sql1->fetch_assoc()) {
                $manv = $row1['MaNV'];
                $tennv = $row1['TenNV'];
                $list1[] = $manv;
                $list2[] = $tennv;
            }
        }
?>
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

        .card{
            height: 95%;
            overflow: auto;
        }

    </style>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="./images/img/logo2.png">
    <title>Chỉnh sửa ca làm việc</title>
</head>
        <body>
            <header>
                <nav>
                    <h1>Yvette Coffee</h1>
                </nav>
            </header>
            <div class="divider"></div>
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid py-1">
                        <h5 class="modal-title"><b>Chỉnh sửa ca</b></h5>
                        <p style="font-size: 15px">Thứ <?php echo $ngay ?> - Ca <?php echo $ca ?></p>
                        <div class="modal-body">
                            <form action="./shift_process.php" name="modify_form" id="modify-form" method="post">
                                <?php
                                for ($i = 0; $i < $n; $i++) { ?>
                                    <div class="form-group">
                                        <label style="font-size:15px" for=""><b>Nhân viên <?php echo $i + 1 ?></b></label>
                                        <input type="hidden" name="modify" value="">
                                        <input type="hidden" name="ngay" value="<?php echo $ngay ?>">
                                        <input type="hidden" name="ca" value="<?php echo $ca ?>">
                                        <select class="form-control col-md-3" name="nv1_<?php echo $i ?>" id="nv1" style="text-align:left !important" required>
                                            <option value='<?php echo $list1[$i] ?>'><?php echo $list2[$i] . " - " . $list1[$i] ?></option>
                                        </select>
                                        <br>
                                        <label style="font-size:15px" for=""><b>thay thế bởi</b></label>
                                        <select class="form-control col-md-3" name="nv2_<?php echo $i ?>" id="nv2" style="text-align:left !important" required>
                                            <?php
                                            foreach ($list as $key => $value) {
                                                if ($key == $list1[$i])
                                                    echo "<option selected value='$key'>$value - $key</option>";
                                                else
                                                    echo "<option value='$key'>$value - $key</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br><br>
                                <?php }
                                ?>
                            </form>
                        </div>
                    </div>
                    <div style="position:relative; top:-20px" class="float-left">
                        <button type="submit" class="btn btn-primary" id="modify-btn">Cập nhật</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href='./shift.php'">Quay lại</button>
                    </div>
                </div>
            </div>


        <div id="preloader"></div>
        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

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

            $('#modify-btn').click(function() {
                start_load()
                if (confirm("Xác nhận thay đổi?") == true) {
                    $('#modify-form').submit()
                }
                setTimeout(function() {
                    end_load()
                }, 200)
            })
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Lỗi hệ thống");
            location.assign("./shift.php");
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("Vui lòng đăng nhập");
        location.assign("./index.php");
    </script>
<?php
}
?>