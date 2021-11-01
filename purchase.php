<?php
	require_once "dbfunctions.php";
	// print out header here
	$title = "Purchase";
	require "header.php";
	// connect database
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$customer = getUserIdbyEmail($_SESSION['email']);
    ?>
<div class="container">
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
		<tr>
			<td>Shipping</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>₹50</td>
		</tr>
		<tr>
			<th>Total Including Shipping</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>
				<?php echo "₹". ($_SESSION['total_price'] + 50); ?>
			</th>
		</tr>
	</table>
</div>
<div class="container">
	<br>
	<br>
	<h4>Your Information</h4>
	<br>
	<form method="post" action="process.php" class="form-horizontal">
		<div class="form-group">
			<label for="exampleInputEmail1">Firstname</label>
			<input type="text" class="form-control" aria-describedby="emailHelp"
				value="<?php echo $customer['firstName']?>" name="firstname">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Lastname</label>
			<input type="text" class="form-control" aria-describedby="emailHelp"
				value="<?php echo $customer['lastName']?>" name="lastname">
		</div>

		<div class="form-group">
			<label for="inputAddress">Address</label>
			<input type="text" class="form-control" id="inputAddress" value="<?php echo $customer['address']?>"
				name="address">
		</div>
		<div class="form-row">
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-md-4">
				<label for="inputCity">City</label>
				<input type="text" class="form-control" id="inputCity" name="city"
					value="<?php echo $customer['city']?>">
			</div>
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-md-4">
				<label for="inputZip">Zip</label>
				<input type="text" class="form-control" id="inputZip" name="zipcode"
					value="<?php echo $customer['pincode']?>">
			</div>
		</div>
		<br>
		<div class="form-group col-md-12">
			<div class="form-group">
				<div class="col-lg-10 col-lg-offset-2" style="margin-left:0px">

					<button type="submit" class="btn btn-primary">Purchase</button>
					<button type="reset" class="btn btn-default">Cancel</button>
				</div>
			</div>

	</form>
	<p class="lead">Please press Purchase to confirm your purchase, or Cancel to reset the form .</p>
</div>
</div>

<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p></div></div>";
	}
    ?>

<?php
    require "footer.php";
    ?>