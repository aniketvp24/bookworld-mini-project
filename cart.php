<?php
	require "header.php";
	require_once "dbfunctions.php";
	require_once "cart_functions.php";
	$conn = mysqli_connect("localhost", "root", "", "booksworld");

	if(isset($_POST['bookisbn'])){
		$book_isbn = $_POST['bookisbn'];
	}

	if(isset($book_isbn)){
		// new iem selected
		if(!isset($_SESSION['cart'])){
			// $_SESSION['cart'] is associative array that bookisbn => qty
			$_SESSION['cart'] = array();

			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$book_isbn])){
			$_SESSION['cart'][$book_isbn] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$book_isbn]++;
			unset($_POST);
		}
	}

	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart']["$isbn"]);
			} else {
				$_SESSION['cart']["$isbn"] = $_POST["$isbn"];
			}
		}
	}

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);

?>
	<form action="cart.php" method="post">
		<table class="table">
			<tr>
				<th>Item</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>

			<?php
		    	foreach($_SESSION['cart'] as $isbn => $qty){
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
			<tr>
				<td>
					<?php echo $book['book_title'] . " by " . $book['book_author']; ?>
				</td>
				<td>
					<?php echo "₹" . $book['book_price']; ?>
				</td>
				<td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
				<td>
					<?php echo "₹" . $qty * $book['book_price']; ?>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>
					<?php echo $_SESSION['total_items']; ?>
				</th>
				<th>
					<?php echo "₹" . $_SESSION['total_price']; ?>
				</th>
			</tr>
		</table>
		<button type="submit" class="btn btn-primary" name="save_change"><span
				class="glyphicon glyphicon-ok"></span>&nbsp;Save Changes</button>
	</form>
	<br /><br />
	<a href="checkout.php" class="btn btn-primary">Go To Checkout</a>
	<a href="allbooks.php" class="btn btn-primary">Continue Shopping</a>
<?php } else {
	echo "<p>Your cart is empty! Please make sure you add some books in it!</p>" ; } if(isset($_SESSION['email'])){
	$customer=getUserIdbyEmail($_SESSION['email']); $customerid=$customer['user_id'];
	$query="SELECT * FROM cart join cartitems join books join user
		on user.user_id='$customerid' and cart.customerid='$customerid' and cart.id=cartitems.cartid and  cartitems.productid=books.book_isbn" ; $result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)!=0){ echo '	<br><br><br><h4>Your Purchase History</h4><table class="table">
		<tr>
			<th>Item</th>
			<th>Quantity</th>
		   <th>Date</th>
		</tr>' ; for($i=0; $i < mysqli_num_rows($result); $i++){ while($query_row=mysqli_fetch_assoc($result)){ echo '<tr>
				<td>
				<a href="book.php?bookisbn=' ; echo $query_row['book_isbn']; echo '">' ;
	echo '<img style="height:100px;width:80px"class="img-responsive img-thumbnail" src="images/' ; echo
	$query_row['book_image']; echo '">' ; echo ' </a>
				</td>
				<td>' ; echo $query_row['quantity']; echo '
				</td>
				<td>' ; echo $query_row['date']; echo' </td>
	</tr>';
	}
	}
	echo '</table>';
}
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
crossorigin="anonymous"></script>
