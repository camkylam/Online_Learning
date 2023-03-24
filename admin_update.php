<?php

include 'partials/connect.php';

   if(isset($_COOKIE['tutor_id'])){
      $tutor_id = $_COOKIE['tutor_id'];
   }else{
      $tutor_id = '';
      header('location:login.php');
   }

if(isset($_POST['submit'])){

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE tutor_id = ? LIMIT 1");
   $select_tutor->execute([$tutor_id]);
   $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $fetch_tutor['password'];
   $prev_image = $fetch_tutor['image'];

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `tutors` SET name = ? WHERE tutor_id = ?");
      $update_name->execute([$name, $tutor_id]);
      $message[] = 'Tên được cập nhật thành công!';
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT email FROM `tutors` WHERE tutor_id = ? AND email = ?");
      $select_email->execute([$tutor_id, $email]);
      if($select_email->rowCount() > 0){
         $message[] = 'Email đã tồn tại!';
      }else{
         $update_email = $conn->prepare("UPDATE `tutors` SET email = ? WHERE tutor_id = ?");
         $update_email->execute([$email, $tutor_id]);
         $message[] = 'Email được cập nhật thành công!';
      }
   }

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Kích thước ảnh quá lớn!';
      }else{
         $update_image = $conn->prepare("UPDATE `tutors` SET `image` = ? WHERE tutor_id = ?");
         $update_image->execute([$rename, $tutor_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if($prev_image != '' AND $prev_image != $rename){
            unlink('uploaded_files/'.$prev_image);
         }
         $message[] = 'Ảnh đại diện được cập nhật thành công!';
      }
   }
   $empty_pass = '';
   $old_pass = $_POST['old_pass'];
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'Mật khẩu cũ không khớp!';
      }elseif($new_pass != $cpass){
         $message[] = 'Xác nhận mật khẩu không khớp!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `tutors` SET password = ? WHERE tutor_id = ?");
            $update_pass->execute([$cpass, $tutor_id]);
            $message[] = 'Password được cập nhật thành công!';
         }else{
            $message[] = 'Vui lòng nhập mật khẩu mới!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cập nhật hồ sơ cá nhân</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin8.css">

</head>
<body>
<?php include 'partials/admin_header.php'; ?>

<!-- register section starts  -->

<section class="form-container" style="background: none;">

   <form class="register" action="" method="post" >
   <h3>Cập nhật hồ sơ cá nhân</h3>
      <div class="flex">
         <div class="col">
            <p>Tên của bạn </p>
            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="50"  class="box">
            <p>Email của bạn </p>
            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="20"  class="box">
            <p>Ảnh đại diện :</p>
      <input type="file" name="image" accept="image/*"  class="box">
     
         </div>
         <div class="col">
            <p>Password cũ :</p>
            <input type="password" name="old_pass" placeholder="Nhập vào Password cũ" maxlength="20"  class="box">
            <p>Password mới :</p>
            <input type="password" name="new_pass" placeholder="Nhập vào password mới" maxlength="20"  class="box">
            <p>Nhập lại password :</p>
            <input type="password" name="cpass" placeholder="Nhập lại password mới" maxlength="20"  class="box">
         </div>
      </div>
      <input type="submit" name="submit" value="Cập nhật" class="btn">
      
   </form>

</section>




<script src="js/admin_script.js"></script>
   
</body>
</html>