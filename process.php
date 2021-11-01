<?php
	require_once "dbfunctions.php";
	// print out header here
	$title = "Purchase Process";
	require "header.php";
	// connect database
	$conn = mysqli_connect("localhost", "root", "", "booksworld");

		$firstname = trim($_POST['firstname']);
		$firstname = mysqli_real_escape_string($conn, $firstname);
		
		$lastname = trim($_POST['lastname']);
		$lastname = mysqli_real_escape_string($conn, $lastname);
	
		
		$address = trim(trim($_POST['address']));
		$address = mysqli_real_escape_string($conn, $address);
		
		$city = trim($_POST['city']);
        $city = mysqli_real_escape_string($conn, $city);
        
		$zipcode = trim($_POST['zipcode']);
		$zipcode = mysqli_real_escape_string($conn, $zipcode);

	// find customer
	$customer = getUserIdbyEmail($_SESSION['email']);
	$id=$customer['user_id'];
	$query="UPDATE user set 
	firstName='$firstname', lastname='$lastname' , address='$address', city='$city', pincode='$zipcode'  where user_id='$id'
	";
	mysqli_query($conn, $query);
	$date = date("Y-m-d H:i:sa");
	// insertIntoOrder($conn, $customer['id'], $_SESSION['total_price'],$date);
	insertIntoCart($conn, $customer['user_id'],$date);

	// take orderid from order to insert order items
	// $orderid = getOrderId($conn, $customer['id']);
	$Cartid = getCartId($conn, $customer['user_id']);

	foreach($_SESSION['cart'] as $isbn => $qty){
		$bookprice = getbookprice($isbn);
		$query = "INSERT INTO cartItems(cartid,productid,quantity) VALUES 
		('$Cartid', '$isbn', '$qty')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert value false!" . mysqli_error($conn2);
			exit;
		}
	}

	unset($_SESSION['total_price']);
	unset($_SESSION['cart']);
	unset($_SESSION['total_items']);

?>
<div class="container" style="min-height: 800px">
	<p class="lead text-success" id="p">Your order has been processed sucessfully..</p>
</div>
   <script>
   	
		window.setTimeout(function(){

		window.location.href = "http://localhost/bookworld/home.php";

		}, 3000);
	
   </script>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "footer.php";
?>