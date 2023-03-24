<?php

include 'partials/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tìm kiếm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
   <link rel="stylesheet" href="css/user30.css">


</head>
<body>

<?php include 'partials/user_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_course" placeholder="Nhập tên khóa học cần tìm kiếm." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>


<!--<form action="search_course.php" method="post" class="search-form">
         <input type="text" name="search_course" placeholder="search courses..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_course_btn"></button>
      </form>-->

<!-- courses section starts  -->

<section class="search_course">
   <div class="box-container">

      <?php
         if(isset($_POST['search_course']) or isset($_POST['search_course_btn'])){
         $search_course = $_POST['search_course'];
         $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE title LIKE '%{$search_course}%' AND status = ?");
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
         echo '<p class="empty">Không tìm thấy khóa học</p>';
      }
      }
      ?>

   </div>

</section>

<!-- courses section ends -->


<script src="js/script.js"></script>
   
</body>
</html>