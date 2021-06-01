<?php
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
include_once(__DIR__.'/lib/database.php');
include_once(__DIR__.'/classes/cart.php');
$db = new Database();
$cart = new cart();
$session = new Session();
$sess =$session->get('products');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Product Detail Page</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="width:600px;">
  <?php 

  if(!empty($sess)):?>
  <nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid pull-left" style="width:300px;">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
    </div>
    <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="/shop/classes/cart.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
  </nav>
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
     foreach($sess as $key=>$product):?>
    <tr>
      <td><img src="<?php print $product["image"]?>" width="50"></td>
      <td><?php print $product["name"]?></td>
      <td><?php print $product["price"]?></td>
      <td><?php print $product["qty"]?></td>
      <td><a href="/shop/classes/cart.php?action=empty&sku=<?php print $key?>" class="btn btn-info">Delete</a></td>
    </tr>
    <?php $total = $total+$product['price'];?>
    <?php endforeach;?>
    <tr><td colspan="5" align="right"><h4>Total:$<?php print $total?></h4></td></tr>
    <tr><td colspan="5" align="right"><a href="/shop/checkout_view.php" class="btn btn-info">Go To Checkout</a></td></tr>

  </table>
  <?php endif;?>
  <nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Products</a> </div>
    </div>
  </nav>
  <div class="row">
    <div class="container" style="width:600px;">
      <?php 
      foreach($cart->products as $product):?>
      <div class="col-md-4">
        <div class="thumbnail"> <img src="<?php print $product['image']?>" alt="Lights">
          <div class="caption">
            <p style="text-align:center;"><?php print $product['name']?></p>
            <p style="text-align:center;"><?php print $product['short_description']?></p>
            <p style="text-align:center;color:#04B745;"><b>$<?php print $product['price']?></b></p>
            <form method="post" action="/shop/classes/cart.php?action=addcart">
              <p style="text-align:center;color:#04B745;">
                <button type="submit" class="btn btn-warning">Add To Cart</button>
                <input type="hidden" name="sku" value="<?php print $product['sku']?>">
              </p>
            </form>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
</body>
</html>