<?php

	$title = "Edit publisher";
	require_once "header.php";
	require_once "dbfunctions.php";
	$conn = mysqli_connect("localhost", "root", "", "booksworld");

	if(isset($_GET['pubid'])){
		$pubid = $_GET['pubid'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($pubid)){
		echo "Empty isbn! check again!";
		exit;
	}

	// get book data
	$query = "SELECT * FROM publisher WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);
?>
<div class="container" style="min-height: 800px;">
	<form method="post" action="edit_publisher.php" enctype="multipart/form-data">
		<table class="table">
			<th>Name</th>
			<tr>
				<td style="display:none"><input type="text" name="id" value="<?php echo $row['publisherid'];?>"></td>

				<td><input type="text" name="name" value="<?php echo $row['publisher_name'];?>" required></td>
			</tr>

		</table>
		<input type="submit" name="save_change" value="Change" class="btn btn-primary">
		<a href="admin_publishers.php" class="btn btn-default">Cancel</a>
	</form>
	<br />
	<!-- <a href="admin_publishers.php" class="btn btn-success">Confirm</a> -->
</div>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "footer.php"
?>