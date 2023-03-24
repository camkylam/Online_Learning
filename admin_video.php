<?php

include 'partials/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['delete_video'])){
   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $verify_video = $conn->prepare("SELECT * FROM `content` WHERE content_id = ? LIMIT 1");
   $verify_video->execute([$delete_id]);
   if($verify_video->rowCount() > 0){
      $delete_video_thumb = $conn->prepare("SELECT * FROM `content` WHERE content_id = ? LIMIT 1");
      $delete_video_thumb->execute([$delete_id]);
      $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
      unlink('uploaded_files/'.$fetch_thumb['thumb']);
      $delete_video = $conn->prepare("SELECT * FROM `content` WHERE content_id = ? LIMIT 1");
      $delete_video->execute([$delete_id]);
      $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
      unlink('uploaded_files/'.$fetch_video['video']);
      $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE content_id = ?");
      $delete_likes->execute([$delete_id]);
      $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE content_id = ?");
      $delete_comments->execute([$delete_id]);
      $delete_content = $conn->prepare("DELETE FROM `content` WHERE content_id = ?");
      $delete_content->execute([$delete_id]);
      $message[] = 'Video đã bị xóa';
   }else{
      $message[] = 'Video đã được xóa';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Video</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
  <link rel="stylesheet" href="css/admin8.css">

</head>
<body>

<?php include 'partials/admin_header.php'; ?>
   
<section class="contents">

   <h1 class="heading">Video đã thêm</h1>

   <div class="box-container">

   
   <?php
      $select_videos = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ? ORDER BY date DESC");
      $select_videos->execute([$tutor_id]);
      if($select_videos->rowCount() > 0){
         while($fecth_videos = $select_videos->fetch(PDO::FETCH_ASSOC)){ 
            $video_id = $fecth_videos['content_id'];
   ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-dot-circle" style="<?php if($fecth_videos['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fecth_videos['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fecth_videos['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fecth_videos['date']; ?></span></div>
         </div>
         <a href="admin_view_content.php?get_id=<?= $video_id; ?>"><img src="uploaded_files/<?= $fecth_videos['thumb']; ?>" class="thumb" alt=""></a>
         <a href="admin_view_content.php?get_id=<?= $video_id; ?>"><h3 class="title"><?= $fecth_videos['title']; ?></h3></a>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
            <a href="admin_update_content.php?get_id=<?= $video_id; ?>" class="option-btn" style="font-size: 16px;">Cập nhật</a>
            <input type="submit" value="Xóa" class="delete-btn" style="font-size:16px;"onclick="return confirm('Bạn muốn xóa video?');" name="delete_video">
         </form>
         <!--<a href="view_content.php?get_id=<?= $video_id; ?>" class="btn">view content</a>-->
      </div>
   <?php
         }
      }else{
         echo '<p class="empty">Chưa có video nào được thêm vào!</p>';
      }
   ?>

   </div>

   <div class="box1" style="text-align: center;">
      <h3 class="title" style="margin-bottom: .5rem; font-size: 25px;">Tải lên video mới</h3>
      <a href="admin_add_content.php" class="btn">Thêm video</a>
   </div>


</section>



<script src="js/admin_script.js"></script>

</body>
</html>