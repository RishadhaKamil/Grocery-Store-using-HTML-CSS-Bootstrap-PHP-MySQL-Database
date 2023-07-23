<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .' '. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['province'] .' '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'Order Placed Already!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'Order Placed Successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Groceteria - Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   
    <link rel="stylesheet" href="css/PaymentStyle.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= 'Rs.'.$fetch_cart_items['price'].'/- x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">your cart is empty!</p>';
   }
   ?>
   <div class="grand-total">Grand total : <span>Rs.<?= $cart_grand_total; ?>/-</span></div>
</section>

<section class="checkout-orders">

<div class="container">
   <form action="" method="POST">

      
        <div class="row">

            <div class="col">

                <h3 class="title">Billing address</h3>

                <div class="inputBox">
                    <span>Full name :</span>
                    <input type="text" placeholder="john deo" required>
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" placeholder="example@example.com" required>
                </div>
                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" placeholder="room - street - locality" required>
                </div>
                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" placeholder="mumbai" required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>State :</span>
                        <select name="method" class="box" required>
                           <option value="southern">Southern Province</option>
                           <option value="northern">Northern Province</option>
                           <option value="western">Western Province</option>
                           <option value="north central">North Central Province</option>
                           <option value="north western">North Western Province</option>
                           <option value="central">Central Province</option>
                           <option value="eastern">Eastern Province</option>
                           <option value="Sabaragamuwa">Sabaragamuwa Province</option>
                           <option value="Uva">Uva Province</option>
                        </select>
                     </div>
                        <div class="inputBox">
                        <span>Zip code :</span>
                        <input type="text" placeholder="123 456" required>
                        </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Cards accepted :</span>
                    <img src="images/card_img.png" alt="" >
                </div>
                <div class="inputBox">
                    <span>Name on card :</span>
                    <input type="text" placeholder="mr. john deo" required>
                </div>
                <div class="inputBox">
                    <span>Credit Card Number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444" required>
                </div>
                <div class="inputBox">
                    <span>Exp Month :</span>
                    <input type="text" placeholder="january" required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Exp Year :</span>
                        <input type="number" placeholder="2022" required>
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="1234" required>
                    </div>
                </div>

            </div>
    
        </div>

        

      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="place order">

   </form>
</div>
</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>