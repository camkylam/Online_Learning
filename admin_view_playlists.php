<?php

include 'partials/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){
   $delete_id = $_POST['playlist_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE playlist_id = ? AND tutor_id = ? LIMIT 1");
   $verify_playlist->execute([$delete_id, $tutor_id]);

   if($verify_playlist->rowCount() > 0){

   $delete_playlist_thumb = $conn->prepare("SELECT * FROM `playlist` WHERE playlist_id = ? LIMIT 1");
   $delete_playlist_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_files/'.$fetch_thumb['thumb']);
   $delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id = ?");
   $delete_bookmark->execute([$delete_id]);
   $delete_playlist = $conn->prepare("DELETE FROM `playlist` WHERE playlist_id = ?");
   $delete_playlist->execute([$delete_id]);
   $message[] = 'Danh sách phát xóa thành công!';
   }else{
      $message[] = 'Danh sách phát đã bị xóa!';
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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin8.css">


</head>
<body>

<?php include 'partials/admin_header.php'; ?>

<section class="playlists">

   <h1 class="heading">Danh sách phát</h1>

   <div class="box-container">
   
      
      <?php
         $select_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ? ORDER BY date DESC");
         $select_playlist->execute([$tutor_id]);
         if($select_playlist->rowCount() > 0){
         while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
            $playlist_id = $fetch_playlist['playlist_id'];
            $count_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
            $count_videos->execute([$playlist_id]);
            $total_videos = $count_videos->rowCount();
      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-circle-dot" style="<?php if($fetch_playlist['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_playlist['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_playlist['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
         </div>
         <div class="thumb">
            <span><?= $total_videos; ?></span>
            <a href="admin_playlist_detail.php?get_id=<?= $playlist_id; ?>"><img src="uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt=""></a>
         </div>
         <a href="admin_playlist_detail.php?get_id=<?= $playlist_id; ?>"><h2 class="title"><?= $fetch_playlist['title']; ?></h2></a>
         
         <p class="description"><?= $fetch_playlist['description']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="playlist_id" value="<?= $playlist_id; ?>">
            <a href="admin_update_playlist.php?get_id=<?= $playlist_id; ?>" style=" text-decoration: none; font-size: 16px" class="option-btn">Cập nhật</a>
            <input type="submit" value="Xóa" class="delete-btn" onclick="return confirm('Xóa danh sách phát?');" style="font-size: 15px;" name="delete">
         </form>
         <!--<a href="view_playlist.php?get_id=<?= $playlist_id; ?>" class="btn">view playlist</a>-->
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">Chưa có danh sách phát nào được thêm!</p>';
      }
      ?>

   </div>
   <div class="box1" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem; font-size:25px;">Tạo thêm danh sách phát</h3>
         <a href="admin_add_playlist.php" class="btn">Thêm danh sách phát</a>
   </div>

  


</section>



<script src="js/admin_script.js"></script>

<!--<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>-->

</body>
</html>