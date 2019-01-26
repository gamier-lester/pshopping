<?php
	session_start();

	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = [];
	}

	$item_id = $_POST['itemId'];
	$item_quantity = $_POST['itemQuantity'];

	if(isset($_SESSION['cart'][$item_id])){
		if($_SESSION['cart'][$item_id] += $item_quantity){
			echo (json_encode($_SESSION['cart']));
		} else {
			echo (json_encode(FALSE));
		}
	} else {
		if($_SESSION['cart'][$item_id] = $item_quantity){
			echo (json_encode($_SESSION['cart']));
		} else {
			echo (json_encode(FALSE));
		}
	}
?>