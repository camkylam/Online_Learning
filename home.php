<?php

include 'partials/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   /*header('location:login.php');*/
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();


?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>

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

<div class="home">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="images/home-slide-1.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block" style="padding-left: 30px; padding-bottom:155px; margin-left:-145px; ">
                  <h5 class="multilang1" ><b>Bạn có thể tìm thấy những khóa học tốt nhất ở Developer</b></h5>
                  <p class="multilang2" >Developer nổ lực mang đến cho bạn nhiều giá trị hơn trong cuộc sống</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/home-slide-2.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block" style="padding-left: 30px; padding-bottom:155px; margin-left:-145px; ">
               <h5 class="multilang1" ><b>the best courses you will find find here!</b></h5>
                  <p class="multilang2" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas impedit labore dolore unde, quidem corrupti?</p>
               </div>
            </div>
            <div class="carousel-item">
               <img src="images/home-slide-3.jpg" class="d-block w-100">
               <div class="carousel-caption d-none d-md-block" style="padding-left: 30px; padding-bottom:155px; margin-left:-145px; ">
               <h5 class="multilang1" ><b>the best courses you will find find here!</b></h5>
                  <p class="multilang2" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas impedit labore dolore unde, quidem corrupti?</p>
               </div>
            </div>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div>
</div>

<section class="category">
      <h1 class="heading"><b>CHỦ ĐỀ PHỔ BIẾN</b></h1>
      <div class="swiper category-slider">
         <div class="swiper-wrapper slide1">
            <a href="user_courses.php" class="swiper-slide slide">
               <img src="images/home5.jpg" alt="">
               <h3>Ngôn ngữ Java</h3>
            </a>
            <a href="user_courses.php" class="swiper-slide slide">
               <img src="images/home8.jpg" alt="">
               <h3>Ngôn ngữ C++</h3>
            </a>
            <a href="user_courses.php" class="swiper-slide slide">
               <img src="images/home17.jpg" alt="">
               <h3>Ngôn ngữ PHP</h3>
            </a>
            <a href="user_courses.php" class="swiper-slide slide">
               <img src="images/home12.jpg" alt="">
               <h3>Ngôn ngữ HTML và CSS</h3>
            </a>
            <a href="user_courses.php" class="swiper-slide slide">
               <img src="images/home10.jpg" alt="">
               <h3>Ngôn ngữ Python</h3>
            </a>
            <a href="user_courses.php" class="swiper-slide slide">
               <img src="images/home15.png" alt="">
               <h3>Ngôn ngữ NodeJS</h3>
            </a>
            <a href="user_courses.php" class="swiper-slide slide">
               <img src="images/home3.webp" alt="">
               <h3>Ngôn ngữ ReacJS</h3>
            </a>
         </div>
         <br>
         <div class="swiper-pagination"></div>
      </div>
   </section>

<section class="course">

  <h1 class="heading">KHÓA HỌC PHỔ BIẾN NHẤT</h1>

   <div class="box-container">

      <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 3");
         $select_courses->execute(['active']);
         if($select_courses->rowCount() > 0){
            while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
               $course_id = $fetch_course['playlist_id'];

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE tutor_id = ?");
               $select_tutor->execute([$fetch_course['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box">
         <div class="image">
            <a href="user_playlist.php?get_id=<?= $course_id; ?>"><img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt=""></a>
            
         </div>
         <div class="content">
         <a href="user_playlist.php?get_id=<?= $course_id; ?>" style="text-decoration: none;"><h3 class="title"><?= $fetch_course['title']; ?></h3></a>
         <p class="description"><?= $fetch_course['description']; ?></p>
         <a href="user_playlist.php?get_id=<?= $course_id; ?>"class="btn">Xem thêm</a>
            <div class="icons">
               <span> <i class="fas fa-book"></i>videos</span></span>
               <span> <i class="fas fa-clock"></i> 6 giờ </span>
            </div>
         </div>
         <!--<a href="playlist.php?get_id=<?= $course_id; ?>"><img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt=""></a>
         <a href="playlist.php?get_id=<?= $course_id; ?>"><h3 class="title"><?= $fetch_course['title']; ?></h3></a>-->
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Chưa có khóa học nào được thêm</p>';
      }
      ?>

   </div>

   <div class="more-btn" style="padding-left:430px; padding-top:30px;">
      <a href="user_courses.php" class="btn">Xem thêm các khóa học khác</a>
   </div>

</section>


<?php include 'partials/footer.php'; ?>
<script src="js/script.js"></script>
   
</body>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>
   
   var swiper = new Swiper(".category-slider", {
      loop:true,
      spaceBetween: 20,
      pagination: {
         el: ".swiper-pagination",
         clickable:true,
      },
      breakpoints: {
         0: {
            slidesPerView: 2,
         },
         650: {
            slidesPerView: 3,
         },
         768: {
            slidesPerView: 4,
         },
         1024: {
            slidesPerView: 5,
         },
      },
   });

</script>


</html>