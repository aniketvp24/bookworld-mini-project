<?php
	$catid = $_GET['catid'];

	require_once "dbfunctions.php";
	$conn = mysqli_connect("localhost", "root", "", "booksworld");
	$query = "DELETE FROM category WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_categories.php");
?>