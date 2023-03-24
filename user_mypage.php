<?php

include 'partials/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
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


if(isset($_POST['remove'])){

    if($user_id != ''){
       $content_id = $_POST['content_id'];
       $content_id = filter_var($content_id, FILTER_SANITIZE_STRING);
 
       $verify_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND content_id = ?");
       $verify_likes->execute([$user_id, $content_id]);
 
       if($verify_likes->rowCount() > 0){
          $remove_likes = $conn->prepare("DELETE FROM `likes` WHERE user_id = ? AND content_id = ?");
          $remove_likes->execute([$user_id, $content_id]);
          $message[] = 'Xóa khỏi lượt thích';
       }
    }else{
       $message[] = 'Mời bạn đăng nhập!';
    }
 
 }


 if(isset($_POST['delete_comment'])){

    $delete_id = $_POST['comment_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
 
    $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ?");
    $verify_comment->execute([$delete_id]);
 
    if($verify_comment->rowCount() > 0){
       $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
       $delete_comment->execute([$delete_id]);
       $message[] = 'Bình luận đã xóa thành công';
    }else{
       $message[] = 'Bình luận đã được xóa';
    }
 
 }
 
 if(isset($_POST['update_now'])){
 
    $update_id = $_POST['update_id'];
    $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
    $update_box = $_POST['update_box'];
    $update_box = filter_var($update_box, FILTER_SANITIZE_STRING);
 
    $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ? AND comment = ? ORDER BY date DESC");
    $verify_comment->execute([$update_id, $update_box]);
 
    if($verify_comment->rowCount() > 0){
       $message[] = 'Bình luận đã được thêm vào';
    }else{
       $update_comment = $conn->prepare("UPDATE `comments` SET comment = ? WHERE id = ?");
       $update_comment->execute([$update_box, $update_id]);
       $message[] = 'Bình luận được chỉnh sửa thành công!';
    }
 
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

<section class="profile">
   <h1 class="heading">HỒ SƠ CÁ NHÂN</h1>
   <div class="details">
      <div class="user">
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <p>Học viên</p>
         <a href="user_update.php" class="btn">Cập nhật hồ sơ cá nhân</a>
      </div>
   </div>

</section>
<section class="my_course">

   <h1 class="heading1">DANH SÁCH PHÁT ĐÃ LƯU (<?= $total_bookmarked; ?>)</h1>

   <div class="box-container">

      <?php
         $select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
         $select_bookmark->execute([$user_id]);
         if($select_bookmark->rowCount() > 0){
            while($fetch_bookmark = $select_bookmark->fetch(PDO::FETCH_ASSOC)){
               $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE playlist_id = ? AND status = ? ORDER BY date DESC");
               $select_courses->execute([$fetch_bookmark['playlist_id'], 'active']);
               if($select_courses->rowCount() > 0){
                  while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){

                  $course_id = $fetch_course['playlist_id'];

                  $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE tutor_id = ?");
                  $select_tutor->execute([$fetch_course['tutor_id']]);
                  $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
      <!--<div class="box">
         <div class="tutor">
            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_course['date']; ?></span>
            </div>
         </div>-->
         <!--<a href="playlist.php?get_id=<?= $course_id; ?>"><img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt=""></a>
         <a href="playlist.php?get_id=<?= $course_id; ?>"><h3 class="title"><?= $fetch_course['title']; ?></h3></a>
         <p class="description"><?= $fetch_course['description']; ?></p>
         <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">Xem danh sách phát</a>
      </div>-->
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
               echo '<p class="empty">Không tìm thấy khóa học nào!</p>';
            }
         }
      }else{
         echo '<p class="empty">Chưa có gì được lưu</p>';
      }
      ?>

   </div>

</section>

   <section class="liked-videos">

   <h1 class="heading1">VIDEO ĐÃ LIKE (<?= $total_likes; ?>)</h1>

   <div class="box-container">

   <?php
      $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
      $select_likes->execute([$user_id]);
      if($select_likes->rowCount() > 0){
         while($fetch_likes = $select_likes->fetch(PDO::FETCH_ASSOC)){

            $select_contents = $conn->prepare("SELECT * FROM `content` WHERE content_id = ? ORDER BY date DESC");
            $select_contents->execute([$fetch_likes['content_id']]);

            if($select_contents->rowCount() > 0){
               while($fetch_contents = $select_contents->fetch(PDO::FETCH_ASSOC)){

               $select_tutors = $conn->prepare("SELECT * FROM `tutors` WHERE tutor_id = ?");
               $select_tutors->execute([$fetch_contents['tutor_id']]);
               $fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC);
   ?>
   <div class="box">
      <div class="tutor">
         <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
         <div>
            <h3><?= $fetch_tutor['name']; ?></h3>
            <span><?= $fetch_contents['date']; ?></span>
         </div>
      </div>
      <img src="uploaded_files/<?= $fetch_contents['thumb']; ?>" alt="" class="thumb">
      <h3 class="title"><?= $fetch_contents['title']; ?></h3>
      <form action="" method="post" class="flex-btn">
         <input type="hidden" name="content_id" value="<?= $fetch_contents['content_id']; ?>">
         <a href="user_watch_video.php?get_id=<?= $fetch_contents['content_id']; ?>" class="inline-btn">Xem video</a>
         <input type="submit" value="Xóa video" class="inline-delete-btn" name="remove">
      </form>
   </div>
   <?php
            }
         }else{
            echo '<p class="emtpy">Không tìm thấy video</p>';         
         }
      }
   }else{
      echo '<p class="empty">Chưa có video được thích</p>';
   }
   ?>
   </div>
</section>

<?php
   if(isset($_POST['edit_comment'])){
      $edit_id = $_POST['comment_id'];
      $edit_id = filter_var($edit_id, FILTER_SANITIZE_STRING);
      $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ? LIMIT 1");
      $verify_comment->execute([$edit_id]);
      if($verify_comment->rowCount() > 0){
         $fetch_edit_comment = $verify_comment->fetch(PDO::FETCH_ASSOC);
?>
<section class="edit-comment">
   <h1 class="heading">Chỉnh sửa bình luận</h1>
   <form action="" method="post">
      <input type="hidden" name="update_id" value="<?= $fetch_edit_comment['id']; ?>">
      <textarea name="update_box" class="box" maxlength="1000" required placeholder="Bình luận của bạn" cols="30" rows="10"><?= $fetch_edit_comment['comment']; ?></textarea>
      <div class="flex">
         <a href="comments.php" class="inline-option-btn">Hủy cập nhật</a>
         <input type="submit" value="Cập nhập ngay" name="update_now" class="inline-btn">
      </div>
   </form>
</section>
<?php
   }else{
      $message[] = 'Bình luận không được tìm thấy';
   }
}
?>

<section class="comments">

   <h1 class="heading1">BÌNH LUẬN CỦA BẠN (<?= $total_comments; ?>)</h1>

   
   <div class="show-comments">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
         $select_comments->execute([$user_id]);
         if($select_comments->rowCount() > 0){
            while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
               $select_content = $conn->prepare("SELECT * FROM `content` WHERE content_id = ?");
               $select_content->execute([$fetch_comment['content_id']]);
               $fetch_content = $select_content->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box" style="<?php if($fetch_comment['user_id'] == $user_id){echo 'order:-1;';} ?>">
         <div class="content"><span><?= $fetch_comment['date']; ?></span><p> - <?= $fetch_content['title']; ?> - </p><a href="user_watch_video.php?get_id=<?= $fetch_content['content_id']; ?>">Xem nội dung</a></div>
         <p class="text"><?= $fetch_comment['comment']; ?></p>
         <?php
            if($fetch_comment['user_id'] == $user_id){ 
         ?>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="comment_id" value="<?= $fetch_comment['id']; ?>">
            <button type="submit" name="edit_comment" class="inline-option-btn">Sửa bình luận</button>
            <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Bạn muốn xóa bình luận?');">Xóa bình luận</button>
         </form>
         <?php
         }
         ?>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">Chưa có bình luận nào được thêm vào</p>';
      }
      ?>
      </div>
   
</section>


<?php include 'partials/footer.php'; ?>

<script src="js/script.js"></script>
   
</body>
</html>