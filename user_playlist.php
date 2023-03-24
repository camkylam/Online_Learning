<?php

include 'partials/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:home.php');
}

if(isset($_POST['save_list'])){

   if($user_id != ''){
      
      $list_id = $_POST['list_id'];
      $list_id = filter_var($list_id, FILTER_SANITIZE_STRING);

      $select_list = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ? AND playlist_id = ?");
      $select_list->execute([$user_id, $list_id]);

      if($select_list->rowCount() > 0){
         $remove_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE user_id = ? AND playlist_id = ?");
         $remove_bookmark->execute([$user_id, $list_id]);
         $message[] = 'Đã xóa danh sách phát';
      }else{
         $insert_bookmark = $conn->prepare("INSERT INTO `bookmark`(user_id, playlist_id) VALUES(?,?)");
         $insert_bookmark->execute([$user_id, $list_id]);
         $message[] = 'Đã lưu danh sách phát!';
      }

   }else{
      $message[] = 'Mời bạn đăng nhập!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Danh sách phát</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">-->

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user25.css">

</head>
<body>

<?php include 'partials/user_header.php'; ?>

<h1 class="heading" style="padding-top: 50px; padding-bottom: -5px; margin-bottom: 5px">CHI TIẾT DANH SÁCH PHÁT</h1>

<section class="playlist">

   <div class="row w_playlist">
      <div class="col" style="padding-right:20px;">
         <?php
            $select_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE playlist_id = ? and status = ? LIMIT 1");
            $select_playlist->execute([$get_id, 'active']);
            if($select_playlist->rowCount() > 0){
               $fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC);

               $playlist_id = $fetch_playlist['playlist_id'];

               $count_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
               $count_videos->execute([$playlist_id]);
               $total_videos = $count_videos->rowCount();

               $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE tutor_id = ? LIMIT 1");
               $select_tutor->execute([$fetch_playlist['tutor_id']]);
               $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

               $select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ? AND playlist_id = ?");
               $select_bookmark->execute([$user_id, $playlist_id]);
         ?>

         <div class="thumb">
            <span><?= $total_videos; ?>videos</span>
            <img src="uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
         </div>
         <br><br>
         <form action="" method="post" class="save-list">
            <input type="hidden" name="list_id" value="<?= $playlist_id; ?>">
            <?php
               if($select_bookmark->rowCount() > 0){
            ?>
            <button type="submit" name="save_list"><i class="fas fa-bookmark"></i><span>Đã lưu</span></button>
            <?php
               }else{
            ?>
            <button type="submit" name="save_list"><i class="far fa-bookmark"></i><span>Lưu danh sách phát</span></button>
            <?php
               }
            ?>
         </form>

         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               
            </div>
         </div>
         <div class="details">
            <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
            <br>
            <h3><?= $fetch_playlist['title']; ?></h3>
            <p><?= $fetch_playlist['description']; ?></p>
            
         </div>
         
         

         <?php
            }else{
            echo '<p class="empty">Không tìm thấy danh sách phát</p>';
         }  
         ?>
      </div>
      
      <div class="col videos-container" style="border-left: 1px solid #000; margin-top:-100px;">
      
         <div class="box-container">

            <?php
               $select_content = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ? AND status = ? ORDER BY date DESC");
               $select_content->execute([$get_id, 'active']);
               if($select_content->rowCount() > 0){
                  while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){  
               ?>
               <a href="user_watch_video.php?get_id=<?= $fetch_content['content_id']; ?>" class="box">
                  <i class="fas fa-play"></i>
                  <img src="uploaded_files/<?= $fetch_content['thumb']; ?>" alt="">
                  <h3><?= $fetch_content['title']; ?></h3>
               </a>
            <?php
            }
               }else{
                  echo '<p class="empty">Chưa có video nào được thếm</p>';
               }
            ?>
         </div>
      </div>


   </div>


</section>

</body>