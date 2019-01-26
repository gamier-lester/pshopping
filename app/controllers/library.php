<?php
	// session_start();
	//Place functions here

	//Display total items in cart
	function cart_count(){
		if(isset($_SESSION['cart'])){
			$cart = $_SESSION['cart'];
			$item_count = 0;
			foreach($cart as $item_id => $item_quantity){
				$item_count += $item_quantity;
			}
			return $item_count;
		} else {
			return 0;
		}
	}

?>