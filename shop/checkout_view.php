<?php
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
include_once(__DIR__.'/lib/database.php');
include_once(__DIR__.'/classes/cart.php');
include_once(__DIR__.'/classes/checkout.php');
$db = new Database();
$cart = new cart();
$checkout = new checkout();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Checkout Page</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script type="text/javascript" src="/shop/js/script.js"></script>

</head>
<body>
<div class="container" style="width:600px;">
<nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid pull-left" style="width:300px;">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Checkout</a> </div>
    </div>
  </nav>
<div class="container" style="width:600px;">
  <?php if(!empty($_SESSION['products'])):?>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Actions</th>
      </tr>
    </thead>
    <?php 
    $total =0;
    foreach($_SESSION['products'] as $key=>$product):?>
    <tr>
      <td><img src="<?php print $product['image']?>" width="50"></td>
      <td><?php print $product['name']?></td>
      <td>$<?php print $product['price']?></td>
      <td><?php print $product['qty']?></td>
      <td><a href="/shop/classes/checkout.php?action=empty&sku=<?php print $key?>" class="btn btn-info">Delete</a></td>
    </tr>
    <?php $total = $total+$product['price'];?>
    <?php endforeach;?>
    <tr><td colspan="5" align="right"><h4>Total:$<?php print $total?></h4></td></tr>
  </table>
  <nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid pull-left" style="width:300px;">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Billing Details</a> </div>
    </div>
  </nav>
  <form name="billing_form" method="post" action="/shop/classes/checkout.php?action=placeorder" onsubmit="return validateform()">
  <div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="text" name="name" required class="form-control" id="name" placeholder="Enter Your Name">
  </div>
 
  <div class="form-group">
    <label for="exampleFormControlInput1">e-Mail ID</label>
    <input type="text" name="mail" required class="form-control" id="mail" placeholder="Enter Your mailid">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Phone Number</label>
    <input type="text" name="phone_number" onkeypress="return isNumberKey(event)" required class="form-control" id="phone_number" placeholder="Enter Your Phone Number">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Address</label>
    <input type="text" name="address" required class="form-control" id="address" placeholder="Enter Your address">
  </div>

  <button class="btn btn-info pull-right" type="submit" class="btn btn-warning"> Place Order</button>
  </form>
  <?php endif;?>
</div>
</body>
</html>