<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email);
   $pass = $_POST['pass'];
   $pass = filter_var($pass);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:index.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Grocetaria - Login Page</title>
    
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="css/Login.css">
    
    <!-- custom css file link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   </head>

<body >
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
  <div class="main_div">
    
    <div class="title">LOGIN NOW</div>
    <div class="social_icons">
      <a href="#"><i class="fab fa-facebook-f"></i> <span>Facebook</span></a>
      <a href="#"><i class="fab fa-twitter"></i><span>Twitter</span></a>
    </div>
    <form action="" method="POST">
      <div class="input_box">
        <input type="email" name="email" class="box" placeholder="Email" required>
        <div class="icon"><i class="fas fa-user"></i></div>
      </div>
      <div class="input_box">
       <input type="password" name="pass" class="box" placeholder="Password" required>
        <div class="icon"><i class="fas fa-lock"></i></div>
      </div>
     
      
      <div class="input_box button">
         <input type="submit" value="Login now" class="btn" name="submit">
      </div>
      <div class="sign_up">
        Not a member? <a href="register.php">Signup now</a>
      </div>
    </form>
  </div>
  
</body>
</html>
