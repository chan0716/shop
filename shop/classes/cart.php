<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
include_once(__DIR__.'\..\lib\database.php');
include_once(__DIR__.'\..\lib\session.php');

$db = new Database();
$cart = new cart();
//$session = new Session();

error_reporting(0);
//Setting session start
?>
<?php
class cart{	
	public $db;

	public function __construct()
    {
        $this->db = new Database();
		$this->session = new Session();
		$action = isset($_GET['action'])?$_GET['action']:"";
		if($action=='addcart' && $_SERVER['REQUEST_METHOD']=='POST') {
         $this->add_to_cart();
		}
		if($action=='emptyall') {
			$this->cart_empty_all();
		}
		if($action=='empty') {
			$this->cart_empty();
		}
		$query = "SELECT * FROM products";
		$this->products = $this->db->select($query);
		$this->products = mysqli_fetch_all($this->products, MYSQLI_ASSOC);
    }

	public function cart_empty_all(){
		$this->session->destroy();
		//$this->session->unset('products');
		header("Location:/shop/index.php");	
		exit;
	
	}
    public function cart_empty(){
		$sku = $_GET['sku'];
		$products = $this->session->get('products');
		unset($products[$sku]);
		$this->session->set('products',$products);
		//$_SESSION['products']= $products;
		header("Location:/shop/index.php");
	}
	

public function add_to_cart(){
	$total=0;
	$sku = $_POST['sku'];
	$query = "SELECT * FROM products where sku='".$sku."'";
	$this->product = $this->db->select($query);
	$this->product = mysqli_fetch_all($this->product, MYSQLI_ASSOC);
	$product = $this->product[0];
	$sess = $this->session->get('products');
	$currentQty = $sess[$sku]["qty"]+1; //Incrementing the product qty in cart
	$arr_ses = array("qty"=>$currentQty,"name"=>$product['name'],"image"=>$product['image'],"price"=>$product['price'],"id"=>$product['product_id']);
	$_SESSION['products'][$sku] = $arr_ses;
	$product='';
	header("Location:/shop/index.php");
	exit();
}
}

?>
