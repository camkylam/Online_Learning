<?php

include 'partials/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   /*header('location:login.php');*/
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Khóa học</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
   <link rel="stylesheet" href="css/user30.css">
   <!--user26.css-->


</head>
<body>

<?php include 'partials/user_header.php'; ?>

<section class="course">

  <h1 class="heading">KHÓA HỌC</h1>

   <div class="box-container">

      <?php
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC");
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


</body>
<?php include 'partials/footer.php'; ?>
<script src="js/script.js"></script>