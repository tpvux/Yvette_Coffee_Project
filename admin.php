<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" type="image/jpg" href="images/img/logo2.png">
    <title>Admin</title>

    <!-- Custom css -->
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <link rel="stylesheet" href="yvette_style.css">

    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
</head>
<body>
    <!-- Header Section -->
    <div class="header" id="home">
        <nav id="navbar">
            <a href="#home" class="logo">
                <img src="images/img/logo2.png" alt="">
                </a>
            <div class="links" id="nav">
                <a href="#home">Trang chủ</a>
                <a href="#about">Về chúng tôi</a>
                <a href="#blog">Tin tức</a>
                <a href="#service">Đồ uống</a>
                <a href="#store">Cửa hàng</a>
                <a href="#contact">Liên Hệ</a>
                <?php
                session_start();
                if (isset($_SESSION["status"])=='Success')
                {
                    if($_SESSION["chucvu"] == "Chủ quán"){ ?>
                        <div class="dropdown">
                            <button class="dropbtn">
                                <?php echo "<b>".$_SESSION["chucvu"]." ". $_SESSION["name"]. "</b>"; ?></button>
                                <div class="dropdown-content">
                                    <a href="./order/index.php">Order</a>
                                    <a href="#">Quản lý Menu</a>
                                    <a href="warehouse_mana/warehouse.php">Quản lý kho</a>
                                    <a href="#">Quản lý nhân viên</a>
                                    <a href="#">Thống kê, báo cáo</a>
                                </div>                    
                        </div>
                <?php
                    }
                    if($_SESSION["chucvu"] == "Quản lý"){ ?>     
                        <div class="dropdown">                                   
                            <button class="dropbtn">
                                <?php echo "<b>".$_SESSION["chucvu"]." ". $_SESSION["name"]. "</b>";?></button>
                                <div class="dropdown-content">
                                    <a href="./order/index.php">Order</a>
                                    <a href="warehouse_mana/warehouse.php">Quản lý kho</a>
                                    <a href="#">Quản lý ca làm việc</a>
                                </div>                                          
                        </div>                                      
                <?php
                    }
                    if ($_SESSION["chucvu"] == "Nhân Viên"){ ?>
                        <div class="dropdown">     
                            <button class="dropbtn">
                                <?php echo "<b>". $_SESSION["chucvu"]." ". $_SESSION["name"]."</b>";?></button>
                                <div class="dropdown-content">
                                    <a href="./order/index.php">Order</a>
                                    <a href="#">Quản lý hóa đơn</a>
                                </div>  
                        </div>
                <?php
                    }
                ?>  
                <i style="color:white; position:relative; left:0px; cursor:pointer" class="fas fa-sign-out-alt" onclick="signout()"></i>
                <script>
                    function signout(){
                        if (confirm("Bạn có chắc muốn thoát không?")==true)
                        {
                            alert("Đăng xuất thành công");
                            var myWindow = window.open("./destroyss.php", "", "width=0, height=0");
                            myWindow.blur();
                            location.assign("./index.php");
                        }
                    }
                </script>                 
            </div>
            <div class="fas fa-bars" id="menu-btn" onclick="openmenu()"></div>
            <div class="fa-solid fa-xmark" id="close" onclick="closemenu()"></div>
        </nav>
        <div class="content">
            <h3>ĐẾN VỚI CÀ PHÊ NGON VÀ ĐẸP NHẤT Q12</h3>
            <h1>Yvette Coffee <br>Kính chào quý khách!</h1>
            <button class="btn">Buy Now</button>
        </div>
    </div>
    <!-- Header Section End -->

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="image">

            </div>
            <div class="about-content">
                <h1>Giới Thiệu về Yvette Coffee</h1>
                <h3>Yvette Coffee - Nguồn cảm hứng từ cà phê Ý tại Quận 12</h3>
                <p>Yvette Coffee là một điểm đến lý tưởng cho những ai yêu thích cà phê Ý chất lượng. 
                Tọa lạc tại Quận 12 - khu vực phía Nam của thành phố Hồ Chí Minh, Yvette Coffee mang
                đến cho khách hàng những trải nghiệm thưởng thức cà phê tuyệt vời, đặc biệt là với 
                những ai đang tìm kiếm một không gian sân vườn thoáng đãng để thưởng thức cà phê...</p>
                <button class="btn" style="color: black;">Về Chúng Tôi</button>
            </div>
        </div>
    </section>
    <!-- About Section End-->

    <!-- Blog Section -->
    <section class="blog" id="blog">
        <h1 class="heading">Tin <span>Tức</span></h1>
        <p class="heading-description">Thông tin mới nhất về cửa hàng sẽ luôn được cập nhật...</p>
        <div class="container">
            <div class="post">
                <div class="blog-img">
                    <img src="images/img/post1-1.jpg" alt="">
                    <span>21 <br> Jun </span>
                </div>
                <div class="blog-content">
                    <h3>By admin |<span> Anh Vũ</span></h3>
                    <h1>Những Món Nước Nổi Bật Tại YVette Coffee</h1>
                    <p>Latte, Cappuccino, Americano, Espresso ,Đen đá, Bạc xĩu, Nước ép các vị, sữa chua, Thức uống đá xay...</p>
                </div>
            </div>
            <div class="post">
                <div class="blog-img">
                    <img src="images/img/post2-2.jpg" alt="">
                    <span>21 <br> Jun </span>
                </div>
                <div class="blog-content">
                    <h3>By admin |<span> Phong Vũ</span></h3>
                    <h1>Yvette Coffee Giới Thiệu Về Ý Nghĩa Cà Phê</h1>
                    <p>Cà phê – thức uống phổ biến thứ hai trên thế giới sau nước, chức năng chính của cà phê không phải là giải khát;
                        nhiều người uống nó với mục đích tạo cảm giác hưng phấn.</br>Theo một nghiên cứu của nhà hoá học Hoa Kỳ – 
                        Joe Vinson thuộc Đại học Scranton thì cà phê là một nguồn quan trọng cung cấp các chất chống ôxi hóa cho cơ thể, 
                        vai trò mà trước đây người ta chỉ thấy ở hoa quả và rau xanh. 
                        Những chất này cũng gián tiếp làm giảm nguy cơ bị ung thư ở người.</p>
                </div>
            </div>
            <div class="post">
                <div class="blog-img">
                    <img src="images/img/post3-3.jpg" alt="">
                    <span>21 <br> Jun </span>
                </div>
                <div class="blog-content">
                    <h3>By admin |<span> Anh Vũ</span></h3>
                    <h1>Giới Thiệu Sơ Lược Về YVette Coffee</h1>
                    <p>Y Vette Coffee - Khám phá hương vị cà phê Ý tinh tế trong không gian sân vườn đẹp
                        Bạn là một tín đồ của cà phê và đang tìm kiếm một địa điểm để thưởng thức những 
                        hương vị cà phê Ý tuyệt vời? Y Vette Coffee là điểm đến lý tưởng cho bạn!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End-->

    <!-- Service Section -->
    <section class="service" id="service">
        <h1 class="heading">Đồ <span>Uống</span></h1>
        <p class="heading-description">Thực đơn đa dạng thỏa mãn sự lựa chọn của quý khách.</br>Danh mục best seller của quán</p>
        <!--menu slide 1-->
        <div class="container swiper">
            <h2 class="do-uong">Cà Phê</h2>
            <div class="slide-container">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/coffee1.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Cà phê đen (sữa) đá </h3>
                                <h4 class="job">25.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/coffee6.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Latte</h3>
                                <h4 class="job">39.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/coffee3.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Cà phê đen (sữa) nóng</h3>
                                <h4 class="job">25.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/coffee4.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Espresso hot</h3>
                                <h4 class="job">30.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/coffee5.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Cappuccino</h3>
                                <h4 class="job">39.000 VND</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
        <!--menu slide 1-->

        <!--menu slide 2-->
        <div class="container swiper">
            <h2 class="do-uong">Sữa chua, Nước ép trái cây</h2>
            <div class="slide-container">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/nuocep1.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Nước ép táo xanh cần tây mật ong</h3>
                                <h4 class="job">45.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/nuocep2.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Nước ép cam cà rốt mật ong</h3>
                                <h4 class="job">40.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/nuocep3.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Nước ép dưa hấu</h3>
                                <h4 class="job">35.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/suachua1.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Sữa chua dâu tây</h3>
                                <h4 class="job">39.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/suachua2.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Sữa chua thanh đào</h3>
                                <h4 class="job">35.000 VND</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
        <!--menu slide 2-->

        <!--menu slide 3-->
        <div class="container swiper">
            <h2 class="do-uong">Đá xay</h2>
            <div class="slide-container">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/daxay1.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Oreo đá xay</h3>
                                <h4 class="job">45.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/daxay2.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Chocolata đá xay</h3>
                                <h4 class="job">45.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/daxay3.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Matcha đá xay</h3>
                                <h4 class="job">45.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/coffee2.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Cà phê dừa đá xay</h3>
                                <h4 class="job">45.000 VND</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-box">
                            <img src="images/drink/daxay4.jpg" alt="" />
                        </div>
                        <div class="profile-details">
                            <img src="images/drink/logo2.png" alt="" />
                            <div class="name-job">
                                <h3 class="name">Chocolate trắng hạnh nhân</h3>
                                <h4 class="job">50.000 VND</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
        <!--menu slide 3-->

    </section>
    <!-- Service Section End -->


    <!-- store Section -->
    <section class="store" id="store">
        <h1 class="heading"> Cửa <span>hàng</span></h1>
        <p class="heading-description"> Long lasting tradition & true love for coffee</p>
        <input type="radio" name="Photos" id="check1" checked>
        <input type="radio" name="Photos" id="check2" >
        <input type="radio" name="Photos" id="check3" >
        <input type="radio" name="Photos" id="check4" >
        <input type="radio" name="Photos" id="check5" >

        <div class="container1">
            <div class="top-content">
                <h3>THƯ VIỆN ẢNH</h3>
                <label for=check1>Tất cả ảnh</label>
                <label for=check2>Quầy Bar</label>
                <label for=check3>Không gian quán</label>
                <label for=check4>Khu vui chơi</label>
                <label for=check5>Đồ uống</label>
            </div>

            <div class="full-img" id="fullImgBox">
                <img src="images/store/bar1.jpg" id="fullImg">
                <span onclick="closeFullImg()">X</span>
            </div>

            <div class="photo-gallary">
                <div class="pic bar">
                    <img src="images/store/bar1.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out1.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic play">
                    <img src="images/store/play1.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic drink">
                    <img src="images/drink/coffee1.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic bar">
                    <img src="images/store/bar2.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out2.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic play">
                    <img src="images/store/play2.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic drink">
                    <img src="images/drink/coffee2.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic bar">
                    <img src="images/store/bar3.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out3.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic drink">
                    <img src="images/drink/coffee3.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic bar">
                    <img src="images/store/bar4.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out4.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic drink">
                    <img src="images/drink/coffee4.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic bar">
                    <img src="images/store/bar5.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out5.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic drink">
                    <img src="images/drink/coffee5.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic bar">
                    <img src="images/store/bar6.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out6.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic drink">
                    <img src="images/drink/coffee6.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic bar">
                    <img src="images/store/bar7.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out7.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic drink">
                    <img src="images/drink/daxay1.jpg" onclick="openFullImg(this.src)">
                </div>
                <div class="pic out">
                    <img src="images/store/out8.jpg" onclick="openFullImg(this.src)">
                </div>
            </div>
        </div>
    </section>
    <!-- store Section End-->

    <!-- Contact Section  -->
    <section class="contact" id="contact">
        <h1 class="heading">Liên <span>hệ</span></h1>
        <p class="heading-description">Yvette luôn luôn lắng để phát triển ngày một tốt hơn</p>
        <div class="contact-box">
            <div class="contact-left">
                <h3>Đóng góp ý kiến tại đây</h3>
                <form action="">
                    <div class="input-row">
                        <div class="input-group">
                            <input type="text" placeholder="Họ và Tên">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Số điện thoại">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Địa chỉ">
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Email">
                        </div>
                    </div>
                    <textarea rows="5" placeholder="Nội dung"></textarea>
                    <button type="submit">Gửi</button>
                </form>
            </div>
            <div class="contact-right">
                <h3>Vị trí cửa hàng</h3>
                <div class="contact-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.3657592238!2d106.628225014664!3d10.859760492264995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529a89ca4461f%3A0x99b4b3046b8a62f2!2sYvette%20Coffee!5e0!3m2!1svi!2s!4v1675174402515!5m2!1svi!2s" 
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Footer Section -->
    <section class="footer">
        <div class="container">
            <div class="footer-box">
                <h3>Địa chỉ </h3>
                <p>87 Dương Thị Mười, Phường Tân Chánh Hiệp , Quận 12</p>
            </div>
            <div class="footer-box">
                <h3>Email:</h3> <p>yvettecoffeeq12@gmail.com</p>
                <h3>SĐT:</h3> <p>0909090909</p>
            </div>
            <div class="footer-box">
                <h3>Follow Us</h3>
                <p>Connect With Us On:</p>
                <div>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div> 
    </section>
    <!-- Footer Section End -->



    
    <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }

      var fullImgBox = document.getElementById("fullImgBox")
        var fullImg = document.getElementById("fullImg")

        function openFullImg(pic){
            fullImgBox.style.display = "flex";
            fullImg.src = pic;
        }

        function closeFullImg(pic){
            fullImgBox.style.display = "none";
        }
    </script>

    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
    <?php
    }
    else 
    {
        ?>
        <script>
            alert("Vui lòng đăng nhập");
            location.assign("./yvette_website.php");
        </script>
        <?php
    }
    ?>
</body>
</html>