

<header class="header">

   <section class="flex">

      <a href="admin_home.php" class="logo">Developer</a>

      <!--<form action="search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="search here..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>-->

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <!--<div id="toggle-btn" class="fas fa-sun"></div>-->
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE tutor_id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <!--<img src="uploaded_files/?= $fetch_profile['image']; ?>" alt="">-->
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         
         <span>Giáo viên</span>
         <a href="admin_update.php" class="btn">Cập nhật hồ sơ </a>
         
         <a href="admin_logout.php" onclick="return confirm('Bạn muốn đăng xuất khỏi website');" class="delete-btn">Đăng xuất</a>
         
         <?php
            }
         ?>
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE tutor_id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         
         <h3><?= $fetch_profile['name']; ?></h3>
       
         <span>Giáo viên</span>
         <a href="admin_update.php" class="btn">Cập nhật hồ sơ</a>
         <?php
            }else{
         ?>
         <h3>Bạn chưa đăng nhập</h3>
          <div class="flex-btn">
            <a href="login.php" class="option-btn">Đăng nhập</a>
            <a href="register.php" class="option-btn">Đăng ký</a>
         </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
      <a href="admin_home.php"><i class="fas fa-home"></i><span>Thống kê</span></a>
      <a href="admin_view_playlists.php"><i class="fa-solid fa-bars-staggered"></i><span>Danh sách phát</span></a>
      <a href="admin_video.php"><i class="fas fa-graduation-cap"></i><span>Video</span></a>
      <a href="admin_comments.php"><i class="fas fa-comment"></i><span>Bình luận</span></a>
      <a href="admin_get_contact.php"><i class="fas fa-message"></i><span>Liên hệ</span></a>
      <!--<a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>-->
   </nav>

</div>

<!-- side bar section ends -->