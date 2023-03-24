<?php

include 'partials/connect.php';

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
   $select_tutor->execute([$email]);
   
   if($select_tutor->rowCount() > 0){
      $message[] = 'email đã tồn tại';
   }else{
      if($pass != $cpass){
         $message[] = 'Nhập lại password không đúng';
      }else{
         $insert_tutor = $conn->prepare("INSERT INTO `tutors`(tutor_id, name,email, password, image) VALUES(?,?,?,?,?)");
         $insert_tutor->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'Đăng ký thành công, đăng nhập ngay';
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
   <title>Đăng ký làm giáo viên</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin8.css">


</head>
<body style="padding:0 0 ; margin: 0 0;">





<div class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Đăng ký trở thành giáo viên</h3>
      <div class="flex">
         <div class="col">
            <p>Tên của bạn <span>*</span></p>
            <input type="text" name="name" placeholder="Nhập vào tên của bạn" maxlength="50" required class="box">
            <p>Email của bạn <span>*</span></p>
            <input type="email" name="email" placeholder="Nhập email của bạn" maxlength="20" required class="box">
            <p>Ảnh đại diện <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
         </div>
         <div class="col">
            <p>Pasword của bạn <span>*</span></p>
            <input type="password" name="pass" placeholder="Nhập password của bạn" maxlength="20" required class="box">
            <p>Nhập lại pasword <span>*</span></p>
            <input type="password" name="cpass" placeholder="Nhập lại password" maxlength="20" required class="box">
            
         </div>
      </div>
      <p class="link">Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
      <input type="submit" name="submit" value="Đăng ký" class="btn">
   </form>

</div>

   
</body>
</html>