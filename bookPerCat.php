<?php
	require_once "dbfunctions.php";
	// get pubid
	if(isset($_POST['catid'])){
		$catid = $_POST['catid'];
	} else {
		echo "Wrong query! Check again!";
		exit;
	}

	// connect database
	$conn = mysqli_connect("localhost", "root", "", "booksworld");
	$catName = getCatName($conn, $catid);

	$query = "SELECT book_isbn, book_title, book_image FROM books WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty books ! Please wait until new books coming!";
		exit;
	}

	$title = "Books Per Category";
	require "header.php";
?>
<div class="container mt-2" style="min-height: 800px">
	<p class="lead"><strong>Categories > </strong>
		<?php echo $catName; ?>
	</p>
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="images/<?php echo $row['book_image'];?>">
		</div>
		<div class="col-md-7">
			<h4>
				<?php echo $row['book_title'];?>
			</h4>
			<a href="book.php?bookisbn=<?php echo $row['book_isbn'];?>" class="btn btn-primary">Get Details</a>
		</div>
	</div>
	<br>
</div>
<?php
	}
	if(isset($conn)) { mysqli_close($conn);}
	require "footer.php";
?>