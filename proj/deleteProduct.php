<?php
// session_start();

// include 'inc/dbConnection.php';
// $dbConn = startConnection("final_project");
include 'functions.php';
// validateSession();

$sql = "DELETE FROM proj_products WHERE movId = " . $_GET['productId'];
$stmt=$dbConn->prepare($sql);
$stmt->execute();

header("Location: admin.php");



?>