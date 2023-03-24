<?php

include 'partials/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:playlist.php');
}

if(isset($_POST['delete_playlist'])){
   $delete_id = $_POST['playlist_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $delete_playlist_thumb = $conn->prepare("SELECT * FROM `playlist` WHERE playlist_id = ? LIMIT 1");
   $delete_playlist_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_files/'.$fetch_thumb['thumb']);
   $delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id = ?");
   $delete_bookmark->execute([$delete_id]);
   $delete_playlist = $conn->prepare("DELETE FROM `playlist` WHERE playlist_id = ?");
   $delete_playlist->execute([$delete_id]);
   header('locatin:playlists.php');
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
      $message[] = 'Video đã xóa thành công';
   }else{
      $message[] = 'video đã xóa';
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Xem danh sách phát</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin8.css">

</head>
<body>

<?php include 'partials/admin_header.php'; ?>
   
<section class="playlist-details">

   <h1 class="heading">chi tiết danh sách phát</h1>

   <?php
      $select_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE playlist_id = ? AND tutor_id = ?");
      $select_playlist->execute([$get_id, $tutor_id]);
      if($select_playlist->rowCount() > 0){
         while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
            $playlist_id = $fetch_playlist['playlist_id'];
            $count_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
            $count_videos->execute([$playlist_id]);
            $total_videos = $count_videos->rowCount();
   ?>
   <div class="row">
      <div class="thumb">
         <span><?= $total_videos; ?></span>
         <img src="uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
      </div>
      <div class="details">
         <h3 class="title"><?= $fetch_playlist['title']; ?></h3>
         <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
         <div class="description"><?= $fetch_playlist['description']; ?></div>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="playlist_id" value="<?= $playlist_id; ?>">
            <a href="admin_update_playlist.php?get_id=<?= $playlist_id; ?>" class="option-btn">Cập nhật</a>
            <input type="submit" value="Xóa" class="delete-btn" onclick="return confirm('Xóa danh sách phát?');" name="delete" >
            
         </form>
         <a href="admin_add_content.php" class="btn" >Thêm video</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Không tìm thấy danh sách phát!</p>';
      }
   ?>

</section>

<section class="contents">

   <h1 class="heading" style="color:black;">Video có trong danh sách</h1>

   <div class="box-container">

   <?php
      $select_videos = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ? AND playlist_id = ?");
      $select_videos->execute([$tutor_id, $playlist_id]);
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
            <a href="admin_update_content.php?get_id=<?= $video_id; ?>" class="option-btn" style="font-size:16px">Cập nhật</a>
            <input type="submit" value="Xóa" class="delete-btn" style="font-size:16px" onclick="return confirm('Bạn muốn xóa video?');" name="delete_video">
         </form>
      </div>
   <?php
         }
      }else{
         echo '<p class="empty">Chưa có video trong danh sách phát! <a href="admin_add_content.php" class="btn" style="margin-top: 1.5rem;">Thêm video</a></p>';
      }
   ?>

   </div>

   <!--<div class="box1" style="text-align: center;">
      <h3 class="title" style="margin-bottom: .5rem; font-size: 25px;">Tải lên video mới</h3>
      <a href="add_content.php" class="btn">Thêm video</a>
   </div>-->


</section>


<script src="js/admin_script.js"></script>

</body>
</html>