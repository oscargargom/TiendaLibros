<?php

if (file_exists('../env.php')) {
   include_once '../env.php';
}

include_once '../config.php';


session_start();

if (!isset($_SESSION['rol'])) {
   header('location: ../login.php');
}

if (isset($_POST['order_btn'])) {

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   //Hace un select de todo lo añadido al carrito
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };
   //Una vez el usuario introduce los datos se insertan dentro de la tabla ordendes, para ser mostrado posteriormente en pedidos
   $total_product = implode(', ', $product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `ordenes`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');


   //Al completar la compra se crea una pequeña ventana para mostra la confirmación
   if ($cart_query && $detail_query) {
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>¡Gracias por la compra!</h3>
         <div class='order-detail'>
            <span>" . $total_product . "</span>
            <span class='total'> total : " . $price_total . "€  </span>
         </div>
         <div class='customer-details'>
            <p> Tu nombre : <span>" . $name . "</span> </p>
            <p> Tu tlf : <span>" . $number . "</span> </p>
            <p> Tu email : <span>" . $email . "</span> </p>
            <p> Tu direccion : <span>" . $flat . ", " . $street . ", " . $city . ", " . $state . ", " . $country . " - " . $pin_code . "</span> </p>
            <p> Método de pago : <span>" . $method . "</span> </p>
            <p>(*Pagar cuando el producto llega*)</p>
         </div>
            <a href='../index.php' class='btn'>continuar comprando</a>
         </div>
      </div>
      ";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Garden of Books</title>
   <link rel="icon" href="../img/logo.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="container">

      <section class="checkout-form">

         <h1 class="heading">Completa tu pedido</h1>

         <form action="" method="post">

            <div class="display-order">
               <?php
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
               $total = 0;
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                     $grand_total = $total += $total_price;
               ?>
                     <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
               <?php
                  }
               } else {
                  echo "<div class='display-order'><span>your cart is empty!</span></div>";
               }
               ?>
               <span class="grand-total"> Total : <?= $grand_total; ?> €</span>
            </div>

            <div class="flex">
               <div class="inputBox">
                  <span>Tu nombre</span>
                  <input type="text" placeholder="Introduce tu nombre" name="name" required>
               </div>
               <div class="inputBox">
                  <span>Tu tlf</span>
                  <input type="number" placeholder="Introduce tu número" name="number" required>
               </div>
               <div class="inputBox">
                  <span>Tu email</span>
                  <input type="email" placeholder="Introduce tu email" name="email" required>
               </div>
               <div class="inputBox">
                  <span>Metodo de pago</span>
                  <select name="method">
                     <option value="Contra-reembolso" selected>Contra-reembolso</option>
                     <option value="Tarjeta de credito">Tarjeta de credito</option>
                     <option value="paypal">Paypal</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Dirección 1</span>
                  <input type="text" placeholder="Calle" name="flat" required>
               </div>
               <div class="inputBox">
                  <span>Dirección 2</span>
                  <input type="text" placeholder="Nº Casa/Piso" name="street" required>
               </div>
               <div class="inputBox">
                  <span>Ciudad</span>
                  <input type="text" placeholder="Ej: Carmona" name="city" required>
               </div>
               <div class="inputBox">
                  <span>Provincia</span>
                  <input type="text" placeholder="Ej: Sevilla" name="state" required>
               </div>
               <div class="inputBox">
                  <span>Pais</span>
                  <input type="text" placeholder="Ej: india" name="country" required>
               </div>
               <div class="inputBox">
                  <span>Codigo postal</span>
                  <input type="text" placeholder="Ej: 123456" name="pin_code" required>
               </div>
            </div>
            <input type="submit" value="Completar" name="order_btn" class="btn">
         </form>

      </section>

   </div>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>