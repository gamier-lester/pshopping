<?php
	session_start();
	if(!isset($_SESSION['item_sort'])){
		$_SESSION['item_sort'] = [];
	}

	$item_sort = [];

	if(isset($_GET['all'])){
		unset($_SESSION['item_sort']);
	}

	if(isset($_GET['category'])){
		$_SESSION['item_sort']['category_id'] = $_GET['category'];
	}

	if(isset($_GET['price'])){
		$_SESSION['item_sort']['price_order'] = $_GET['price'];
	}

	header('Location: ../views/catalog.php');

?>