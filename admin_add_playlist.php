<?php

include 'partials/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $add_playlist = $conn->prepare("INSERT INTO `playlist`(playlist_id, tutor_id, title, description, thumb, status) VALUES(?,?,?,?,?,?)");
   $add_playlist->execute([$id, $tutor_id, $title, $description, $rename, $status]);

   move_uploaded_file($image_tmp_name, $image_folder);

   $message[] = 'Danh sách phát mới đã được tạo!';  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thêm danh sách phát</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin8.css">

</head>
<body>

<?php include 'partials/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Thêm danh sách phát</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Trạng thái danh sách phát<span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>Chọn trạng thái</option>
         <option value="active">Hoạt động</option>
         <option value="deactive">Dừng hoạt động</option>
      </select>
      <p>Tiêu đề<span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Nhập vào tiêu đề danh sách phát" class="box">
      <p>Mô tả<span>*</span></p>
      <textarea name="description" class="box" required placeholder="Nhập vào mô tả cho danh sách phát" maxlength="1000" cols="30" rows="10"></textarea>
      <p>Ảnh đại diện <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <input type="submit" value="Thêm danh sách phát" name="submit" class="btn">
   </form>

</section>


<script src="js/admin_script.js"></script>

</body>
</html>