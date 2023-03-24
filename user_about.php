<?php

include 'partials/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giới thiệu</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
   <link rel="stylesheet" href="css/user26.css">


</head>
<body>
    <?php include 'partials/user_header.php'; ?>
   
    <div class="about" style="padding:42px 55px;">
    
    <h1 class="heading1" style="padding-top:20px">AI CÓ THỂ TRỞ THÀNH LẬP TRÌNH VIÊN ?</h1>
    <br><br>
        <div class="row">
            <div class="image">
            <img src="images/abou13.jpg" alt="">
            </div>
            <div class="content">
                <p>Các bạn từ 18 đến 35 tuổi yêu thích công nghệ, mong muốn trở thành lập trình viên, tìm kiếm cơ hội làm việc tốt trong các lĩnh vực ngành công nghệ thông tin.</p>
                <ul>
                    <li>Các bạn học sinh trung học Phổ thông</li>
                    <li>Các bạn sinh viên</li>
                    <li>Người đi làm chuyển ngành, đổi nghề</li>
                </ul>
            </div>
        </div>
</div>
<br><br><br>

    <section class="about2">
    <h1 class="heading1">VÌ SAO BẠN NÊN CHỌN DEVELOPER</h1>
    <div class="box-container">

      <div class="box">
         <i class="fas fa-graduation-cap"></i>
         <div>
            <h3>Hơn 30</h3>
            <span>khóa học</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-user-graduate"></i>
         <div>
            <h3>700</h3>
            <span>Học viên xuất sắc</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-chalkboard-user"></i>
         <div>
            <h3>Từ 1-2 tháng</h3>
            <span>Để thành thạo một ngôn ngữ lập trình</span>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-briefcase"></i>
         <div>
            <h3>75%</h3>
            <span>Vị trí công việc</span>
         </div>
      </div>

   </div>
    </section>

    <section class="about3" style="margin-top:50px">
    
        <div class="row">

            
            <div class="content">
            <h1 class="heading1">Tầm nhìn của Developer</h1>
                <p>Trở thành hệ thống đào tạo lập trình hiện đại hàng đầu khu vực, 
                    là chủ lực cung cấp nhân lực chất lượng cao cho ngành công nghiệp, 
                    góp phần nâng tầm phát triển ngành phần mềm Việt Nam, tiến kịp tiêu chuẩn quốc tế.</p>
            </div>
            <div class="image">
            <img src="images/about6.jpg" alt="">
            </div>
        </div>
    </section>

    <section class="about3" style="margin-top:50px">
    
        <div class="row">
        <div class="image" style="padding-top:20px;">
            <img src="images/about8.jpg" alt="">
            </div>
            <div class="content">
            <h1 class="heading1" style="padding-top:1px;">Sứ mệnh của Developer</h1>
                <p>Phát triển các giải pháp học tập hiện đại và hiệu quả thông qua các video hướng dẫn học tập.
                    Qua đó, Developer giúp người học sử dụng thành thạo ngôn ngữ lập trình, 
                    sẵn sàng làm việc, và có khả năng tự học suốt đời hiệu quả, thích ứng với cuộc Cách mạng Công nghiệp 4.0.</p>
            </div>
           
        </div>


    </section>
    <br><br><br>

    <section class="review" id="review">

    <h1 class="heading1" >NHẬN XÉT CỦA HỌC VIÊN</h1>

    <div class="swiper review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="images/pic-2.jpg" alt="">
                <h3>Cẩm Xuyến</h3>
                <!--<div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>-->
                <p>
                    Tôi là một sinh viên CNTT, ngoài học trên lớp các khóa học ở Developer giúp ích cho tôi rất nhiều trong việc tìm hiểu sâu các ngôn ngữ lập trình.
                    Khóa học rất hay và hữu ích.
                </p>
                
            </div>

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="images/pic-3.jpg" alt="">
                <h3>Thanh Sự</h3>
                
                <p>Tôi học khối ngành về kinh tế, gần đây tui cảm thấy mình có niềm đam mê kỳ lạ với lập trình. Các khóa học ở Developer đã hổ trợ tôi rất nhiều cho việc bắt đầu học lập trình. </p>
                
            </div>

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="images/pic-4.jpg" alt="">
                <h3>Thu Đình</h3>
                
                <p>Developer đã hổ trợ tôi rất nhiều trong việc học tập các ngôn ngữ lập trình. Các khóa học ở Developer rất, tôi có thể học mọi lúc, mọi nơi và bất kỳ lúc nào tôi rảnh rỗi nó rất thuận tiện cho người bận rộn như tôi. </p>
               
               
            </div>

            <div class="swiper-slide box">
                <i class="fas fa-quote-left"></i>
                <i class="fas fa-quote-right"></i>
                <img src="images/pic-5.jpg" alt="">
                <h3>Đại Nghĩa</h3>
               
                <p>
                Tôi năm nay 26 tuổi, quê Trà Vinh, đã tốt nghiệp Đại học ngành Kế toán. Lý do tôi quyết định học tập các khóa học trên Developer là vì thời gian hoàn thành nhanh và học tập toàn thời gian.
                
                </p>
               
    
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>
</body>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    loop : true,
    grabCursor: true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
    },
});
</script>
<script src="js/script.js"></script>
<?php include 'partials/footer.php'; ?>