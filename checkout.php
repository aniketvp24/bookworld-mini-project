<?php
	require_once "dbfunctions.php";
	// print out header here
	$title = "Checking out";
	require "header.php";
	if(!isset($_SESSION['email'])){
		echo '<div class="alert alert-danger" role="alert">
		You Need to <a href="login.php">Log in</a> First! 
	  </div>';
	}
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>
<div class="container mt-4" style="min-height: 800px">
	<table class="table">
		<tr>
			<th>Item</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
		<?php
			    foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = mysqli_connect("localhost", "root", "", "booksworld");
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
		<tr>
			<td>
				<?php echo $book['book_title'] . " by " . $book['book_author']; ?>
			</td>
			<td>
				<?php echo "₹" . $book['book_price']; ?>
			</td>
			<td>
				<?php echo $qty; ?>
			</td>
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
	<?php 
		if(isset($_SESSION['email'])){
			echo '<form method="post" action="purchase.php" class="form-horizontal">
			<div class="form-group" style="margin-left:0px">
				<input type="submit" name="submit" value="Purchase" class="btn btn-primary" >
				<a href="cart.php" class="btn btn-primary">Edit Cart</a> 
			</div>
		</form>
		<p class="lead">Please press Purchase to confirm your purchase, or Edit Cart to add or remove items.</p>';
		}
	?>
</div>
<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	require_once "footer.php";
?>