<?php
   if(isset($error)){
      foreach($error as $error){
         echo '
         <div class="error">
            <span>'.$error.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>