<?php

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

      $pid = filter_input(INPUT_POST, 'pid', FILTER_DEFAULT);
      $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
      $price = filter_input(INPUT_POST, 'price', FILTER_DEFAULT);
      $image = filter_input(INPUT_POST, 'image', FILTER_DEFAULT);
      $qty = filter_input(INPUT_POST, 'qty', FILTER_DEFAULT);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'added to cart!';
         
      }

   }

}

?>
