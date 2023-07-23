<?php

@include 'config.php';

session_start();


$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'Already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'Already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'Added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'Already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'Added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Groceteria | Enjoy the fresh goodies</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style5.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">
   <section class="home" id="home">

    <div class="content">
        <h3>fresh and organic products <br>for your doorstep!</h3>
        <p>Get all your online grocery done at Groceteria !<br> we are bound to provide the best items with the best quality.<br> No need of spending thankless hours at groceries,<br> boutiques and supermarkets to a more productive livelihood<br> where a few clicks and taps take care of stocking.</p>
    </div>

</section>

</div>

<section class="home-category">

   <h1 class="title">shop by category:</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cat-1.png" alt="">
         <h3>Fruits</h3>
         <p>Fruits and Vegetables contain important vitamins, minerals,fibre and plant chemicals.There are many varieties of fruit and vegetables available and many ways to prepare, cook and serve them.A diet high in fruit and vegetables can help protect you against cancer, diabetes and heart disease.Eat five kinds of vegetable and two kinds of fruit every day for good health.When buying and serving fruit and vegetables, aim for variety to get the most nutrients and appeal.</p>
         <a href="category.php?category=fruits" class="btn">Fruits</a>
      </div>

      <div class="box">
         <img src="images/download.jfif" alt="">
         <h3>Meat</h3>
         <p>Fresh meat means meat that has not undergone any preserving process other than chilling, freezing or quick-freezing, including meat that is vacuum-wrapped or wrapped in a controlled atmosphere.Further, it can also be described as the means of flesh of a mammal, which has not been subjected to any treatment or process other than chilling or packing in a controlled atmosphere and includes minced chopped recovered meat, and meat treated by the addition of seasonings;</p>
         <a href="category.php?category=meat" class="btn">Meat</a>
      </div>

      <div class="box">
         <img src="images/blog-1.jpg" alt="">
         <h3>Vegetables</h3>
         <p>It's important to look for freshness in all vegetables we consume. Firstly, Check the characteristic signs of freshness such as bright, lively color and the appearance of the vegetable and Next look to see if the vegetable is crisp and free of soft spots. Vegetables are known as one of the most important reasons for purchasing fresh is the nutritional value that freshness brings to you as a consumer. Vegetables are low in fat, high in fiber,vitamins and provides key nutrients for our day.</p>
         <a href="category.php?category=vegitables" class="btn">Vegetables</a>
      </div>

      <div class="box">
         <img src="images/1.jpg" alt="">
         <h3>Snacks</h3>
         <p>Let your taste buds feel special and make them crave for more! Come visit us! Groceteria possesses every snack you need! From Dark Chocolate to White Chocolate spicy to savoury we have everything! Just checkout,Swipe and Tap! Make your day as sweet as the snacks and never stop adding sweetness to your lives! Let the sweetness make you feel extra ordinary! Their heavenly tastes gives you unexpected vibes and moods. From low Sweetness to high sweetness every snack you need is available just tap!</p>
         <a href="category.php?category=fish" class="btn">Snacks</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">Latest Products:</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">Rs.<span><?= $fetch_products['price']; ?></span>/=</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Add To Wishlist" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Add To Cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No Products Added Yet!</p>';
   }
   ?>

   </div>


</section>

<section class="products">

   <h1 class="title">Latest Home Products:</h1>

 <div class="homeb">
   <section class="bakery" >

    <div class="content">
        <h3>fresh and organic products for your doorstep!</h3>
        <p>Get all your online grocery done at Groceteria ! we are bound to provide the best items with the best quality.No need of spending thankless hours at groceries,boutiques and supermarkets to a more productive livelihood where a few clicks and taps take care of stocking.</p>
    </div>
   </section>
</div>
   <div class="box-container">
    

   <?php
      $select_products = $conn->prepare("SELECT * FROM `bakery` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">Rs.<span><?= $fetch_products['price']; ?></span>/=</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Add To Wishlist" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Add To Cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No Products Added Yet!</p>';
   }
   ?>

   </div>
   

</section>






<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>