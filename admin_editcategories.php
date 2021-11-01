<?php
	$title = "Edit category";
	require_once "header.php";
	require_once "dbfunctions.php";
	$conn = mysqli_connect("localhost", "root", "", "booksworld");

	if(isset($_GET['catid'])){
		$catid = $_GET['catid'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($catid)){
		echo "Empty isbn! check again!";
		exit;
	}

	// get book data
	$query = "SELECT * FROM category WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);
?>
<div class="container" style="min-height: 800px;">
	<form method="post" action="edit_category.php" enctype="multipart/form-data">
		<table class="table">
			<th>Name</th>
			<tr>
				<td style="display:none"><input type="text" name="id" value="<?php echo $row['categoryid'];?>"></td>

				<td><input type="text" name="name" value="<?php echo $row['category_name'];?>" required></td>
			</tr>

		</table>
		<input type="submit" name="save_change" value="Change" class="btn btn-primary">
		<a href="admin_categories.php" class="btn btn-default">Cancel</a>
	</form>
	<br />
</div>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "footer.php"
?>