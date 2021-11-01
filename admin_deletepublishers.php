<?php
	$pubid = $_GET['pubid'];

	require_once "dbfunctions.php";
	$conn = mysqli_connect("localhost", "root", "", "booksworld");

	$query = "DELETE FROM publisher WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_publishers.php");
?>