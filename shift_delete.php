<?php
include './db_connect.php';
include_once './header.php';
session_start();
if (isset($_SESSION["status"]) == 'Success') {
    if (isset($_GET)) {
        $ngay = $_GET['ngay'];
        $ca = $_GET['ca'];
        $sql1 = $conn->query("SELECT * FROM `ca_lam_viec` c, `nhan_vien` n WHERE c.MaNV = n.MaNV AND c.Ngay = $ngay AND c.Ca = $ca");
        if (($n = $sql1->num_rows) > 0) {
            while ($row1 = $sql1->fetch_assoc()) {
                $manv = $row1['MaNV'];
                $tennv = $row1['TenNV'];
                $list["$manv"] = $tennv;
            }
        }
?>
        <div class="card">
            <div class="card-header">
                <div class="container-fluid py-1">
                    <h5 class="modal-title"><b>Xóa ca</b></h5>
                    <p style="font-size: 15px">Thứ <?php echo $ngay ?> - Ca <?php echo $ca ?></p>
                    <div class="modal-body">
                        <form action="./shift_process.php" name="delete_form" id="delete-form" method="post">
                            <div class="form-group">
                                <label style="font-size:15px" for=""><b>Nhân viên muốn xóa</b></label>
                                <input type="hidden" name="delete" value="">
                                <input type="hidden" name="ngay" value="<?php echo $ngay ?>">
                                <input type="hidden" name="ca" value="<?php echo $ca ?>">
                                <select class="form-control form-control col-md-3" name="nv" id="nv" style="text-align:left !important" required>
                                    <option value="all">Tất cả</option>
                                    <?php
                                    foreach ($list as $k => $v) {
                                        echo "<option value='$k'>$v - $k</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="left:30px; position:relative" class="float-left">
                    <button type="submit" class="btn btn-primary" id="delete-btn">Xóa</button>
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

            $('#delete-btn').click(function() {
                start_load()
                if (confirm("Xác nhận thay đổi?") == true) {
                    $('#delete-form').submit()
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