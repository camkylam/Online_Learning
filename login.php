<?php

include 'partials/connect.php';


if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass,FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      setcookie('user_id', $row['user_id'], time() + 60*60*24*30, '/');
      header('location:home.php');
    }
   else if(isset($_POST['submit'])){
   $name = $_POST['email'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ? AND password = ? LIMIT 1");
   $select_tutor->execute([$email, $pass]);
   $row = $select_tutor->fetch(PDO::FETCH_ASSOC);

   if($select_tutor->rowCount() > 0){
     setcookie('tutor_id', $row['tutor_id'], time() + 60*60*24*30, '/');
     header('location:admin_home.php');
   }
   else{
      $message[] = 'Sai Username hoặc mật khẩu';
   }

   }else{
       $message[] = 'Sai Username hoặc mật khẩu';
   }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="css/user26.css">

</head>


<body>
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>ĐĂNG NHẬP</h3>
      <p>Nhập Email <span>*</span></p>
      <input type="email" name="email" placeholder="Nhập Email của bạn" maxlength="50" required class="box">
      <p>Nhập password <span>*</span></p>
      <input type="password" name="pass" placeholder="Nhập vào password của bạn" maxlength="20" required class="box">
      <p class="link" style="padding-top:5px; padding-bottom:1px;">Bạn chưa có tài khoản học viên? <a href="register.php">Đăng ký ngay</a></p>
      <p class="link" style="padding-top:3px;"><a href="admin_register.php">Đăng ký làm giáo viên</a></p>
      <input type="submit" name="submit" value="ĐĂNG NHẬP" class="btn">
   </form>

</div>
</body>
</html>