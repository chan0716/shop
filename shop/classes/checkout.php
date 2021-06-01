<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
include_once(__DIR__.'\..\lib\database.php');
include_once(__DIR__.'\..\lib\session.php');

$db = new Database();
$checkout = new checkout();



class checkout{	


  public $db;

	public function __construct()
    {
        $this->db = new Database();
        $this->session = new Session();


		$action = isset($_GET['action'])?$_GET['action']:"";
	
		if($action=='empty') {
			$this->cart_empty();
		}
    if($action=='placeorder') {
			$this->place_order();
		}
    
		$query = "SELECT * FROM products";
		$this->products = $this->db->select($query);
		$this->products = mysqli_fetch_all($this->products, MYSQLI_ASSOC);
    }



    public function cart_empty(){
      $sku = $_GET['sku'];
      $products = $this->session->get('products');
      unset($products[$sku]);
      $this->session->set('products',$products);
      //$_SESSION['products']= $products;
      header("Location:/shop/index.php");
    }

public function place_order(){
    $total = 0;
    $no_of_prod = 0;
    $i = 1;
  foreach($this->session->get('products') as $key=>$product){
    $no_of_prod+=  $i;
    $total+=$product["price"];
 }

  $total = $total;
  $name = $_POST['name'];
  $email_id =$_POST['mail'];
  $phone_no = $_POST['phone_number'];
  $address = $_POST['address'];
  $query = "INSERT INTO  order_info (numberofproduct,totalamount,name,emailid,phonenumber,address) 
  VALUES ($no_of_prod,$total,'".$name."','".$email_id."','".$phone_no."','".$address."')";
 $stmt =  $this->db->insert($query);
//$stmt= $conn->query("INSERT INTO  order_info (numberofproduct,totalamount,name,emailid,phonenumber,address) 
//VALUES ($no_of_prod,$total,'".$name."','".$email_id."','".$phone_no."','".$address."')");

if ($stmt === TRUE) {
  $last_id = $this->db->last_id();
//  $last_id = $conn->insert_id;
  foreach($_SESSION['products'] as $key=>$product){
    $pid =$product['id'];
    $pd_name = $product['name'];
    $pqty = $product['qty'];
    $query1 = "INSERT INTO  order_product_stats (orderid,productid,productname,quantity) 
    VALUES ($last_id,$pid,'".$pd_name."',$pqty)";
    $this->db->insert($query1);
   // $stmtrrr= $conn->query("INSERT INTO  order_product_stats (orderid,productid,productname,quantity) 
//VALUES ($last_id,$pid,'".$pd_name."',$pqty)");
  }
  $this->session->destroy();
  //unset($_SESSION['products']);
  header("Location:/shop/thankyou.php");	
} 

}

}
?>