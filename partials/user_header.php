<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Developer</a>

      <nav>
      <ul class="nav justify-content-center ">
         <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">TRANG CHỦ</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="user_about.php">GIỚI THIỆU</a>
         </li>
         <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="user_courses.php">KHÓA HỌC</a>
         </li>

         <li class="nav-item">
            <a class="nav-link" href="user_contact.php">LIÊN HỆ</a>
         </li>
      </ul>
   </nav>
      <div class="icons">
         <a id="search-btn" href="user_search_course.php"><i class="fas fa-search"></i></a>
         <div id="user-btn" class="fas fa-user"></div>
         <!--<div id="toggle-btn" class="fas fa-sun"></div>-->
      </div>
      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE user_id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
        
         <h3><?= $fetch_profile['name']; ?></h3>
         <span>Học viên</span><br>
         <a href="user_mypage.php" class="btn">Trang của tôi</a>
         <a href="user_logout.php" onclick="return confirm('Bạn muốn đăng xuất khỏi website');" class="delete-btn">Đăng xuất</a>
         <?php
            }else{
         ?>
         <h3>Bạn chưa đăng nhập</h3>
         <a href="login.php" class="option-btn">Đăng nhập</a>
         <a href="register.php" class="option-btn">Đăng ký</a>
         <?php
            }
         ?>
      </div>
   </section>
</header>

