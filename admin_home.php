<?php

include 'partials/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

$select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

$select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
$select_playlists->execute([$tutor_id]);
$total_playlists = $select_playlists->rowCount();

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
$select_likes->execute([$tutor_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thống kê</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin8.css">
   <!-- custom css file link  -->
  

</head>
<body>

<?php include 'partials/admin_header.php'; ?>
   
<section class="dashboard">

   <h1 class="heading">Thống kê</h1>
   <br>

   <div class="box-container">

   <div class="box">
         <p>Tổng số danh sách phát</p>
         <h3><?= $total_playlists; ?></h3>
         <a href="admin_add_playlist.php" class="btn">Thêm danh sách phát mới</a>
      </div>

      <div class="box">
         <p>Tổng số video</p>
         <h3><?= $total_contents; ?></h3>
         <a href="admin_add_content.php" class="btn">Thêm video mới </a>
      </div>

      

      <div class="box">
         <p>Tổng lượt thích video</p>
         <h3><?= $total_likes; ?></h3>
         <a href="contents.php" class="btn">Xem lượt thích video</a>
      </div>

      <div class="box">
         <p>Tổng bình luận</p>
         <h3><?= $total_comments; ?></h3>
         <a href="admin_comments.php" class="btn">Xem bình luận</a>
      </div>

      <div class="box">
         <p>Liên hệ</p>
         <?php
               $select_contact = $conn->prepare("SELECT * FROM `contact`");
               $select_contact->execute();
               $total_contact = $select_contact->rowCount();
            ?>
         <h3><?= $total_contact; ?></h3>
         <a href="admin_get_contact.php" class="btn">Xem liên hệ</a>
      </div>


   </div>

</section>



<script src="js/admin_script.js"></script>

</body>
</html>