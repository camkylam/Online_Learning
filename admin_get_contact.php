<?php

include 'partials/connect.php';

   if(isset($_COOKIE['tutor_id'])){
      $tutor_id = $_COOKIE['tutor_id'];
   }else{
      $tutor_id = '';
      header('location:login.php');
   }

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `contact` WHERE id_contact = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_get_contact.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thống kê</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin8.css">
   <!-- custom css file link  -->
  

</head>
<body>
<?php include 'partials/admin_header.php' ?>
<h1 class=heading>Quản lý liên hệ</h1>
   <section >
      <div >
			<div >
				<table >
					<thead >
						<tr style=" background-color: var(--light-color);">
							<th style=" font-size:22px;">Họ và tên</th>
							<th  style=" font-size:22px;">Email</th>
                            <th  style=" font-size:22px;">Số điện thoại</th>
							<th  style=" font-size:22px;">Nội dung liên hệ</th>
							<th></th>
						</tr>
					</thead>
               <?php
                  $select_messages = $conn->prepare("SELECT * FROM `contact`");
                  $select_messages->execute();
                  if($select_messages->rowCount() > 0){
                     while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
               ?>
					<tbody>
                  <tr>
                     <th><?= $fetch_messages['name']; ?></th>
							
                     <th><?= $fetch_messages['email']; ?></th>
                     <th><?= $fetch_messages['number']; ?></th>
							<th><?= $fetch_messages['message']; ?></th>
							<th><a href="get_contact.php?delete=<?= $fetch_messages['id_contact']; ?>" class="delete-btn detele" onclick="return confirm('Bạn muốn xóa liên hệ này?');">Xóa</a></th>
                  <tr>
				   </tbody>
               <?php
                     }
                  }else{
                     echo '<p class="empty">Chưa có thông tin liên hệ</p>';
                  }
               ?>
				</table>
				</div>
			</div> 
   </section>


<script src="js/admin_script.js"></script>

</body>
</html>