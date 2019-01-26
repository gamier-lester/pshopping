<?php require_once '../controllers/connect.php'; ?>
<?php require_once '../partials/layout.php'; ?>
<?php function show_content() { global $conn;?>
	<section id="cart">
		<div class="row justify-content-center mx-0">
			<?php if(isset($_SESSION['cart'])): ?>
			<div class="col-lg-12 px-0">
				<div class="jumbotron">
					<div class="container">
						<h1 class="display-4">
							Thank you for choosing P Shopping
						</h1>
						<p class="lead">See below for the details of your shopping cart.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<table class="table table-striped">
					<thead>
						<tr class="text-center">
							<td>Item Name</td>
							<td>Item Quantity</td>
							<td>Item Price</td>
							<td>Subtotal</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody class="text-center">
					
					<?php
						$total = 0;
						foreach($_SESSION['cart'] as $item_id => $item_quantity){
							$fetch_prep = $conn->prepare("SELECT * FROM items WHERE id=$item_id");
							$fetch_prep->execute();
							$item_details = $fetch_prep->fetchall();

							foreach($item_details as $item_detail){
								$total += $item_detail['price']*$item_quantity;
					?>
						<tr>
							<td><?php echo $item_detail['name']; ?></td>
							<td>
								<input type="number" min="0" value="<?php echo $item_quantity; ?>" class="form-group form-control text-center">
							</td>
							<td><?php echo $item_detail['price']; ?></td>
							<td><?php echo ($item_detail['price']*$item_quantity); ?></td>
							<td>
								<button data-id="<?php echo $item_id; ?>" class="btn">Update Order</button>
								<button data-id="<?php echo $item_id; ?>" class="btn btn-danger">Remove Order</button>
							</td>
						</tr>
					<?php
							}
						}
					?>
					</tbody>
					<tfoot>
						<tr>
							<td id="purchase-total" colspan="4" align="right"><h5>Total: P<?php echo $total; ?></h5></td>
							<td colspan="2"><button class="btn btn-success btn-block">Payout now</button></td>
						</tr>
					</tfoot>
				</table>
			</div>
		<?php else: ?>
			<?php 
				$fetch_prep = $conn->prepare("SELECT * FROM items LIMIT 12");
				$fetch_prep->execute();
				$items = $fetch_prep->fetchall();
			?>
			<div class="col-lg-12">
				<h1 class="text-center">Oooopx... Your cart is empty</h1>
			</div>
			<div class="col-lg-12">
				<div class="row">
					<?php foreach($items as $item){ ?>
					<div class="col-lg-3">
						<div class="card">
							<div class="card-header">
								<h4><?php echo $item['name']; ?></h4>
								<img src="<?php echo $item['image_path']; ?>" alt="Item Image">
							</div>
							<div class="card-body">
								<p class="text-lead"><?php echo $item['description']; ?></p>
								<p class="text-lead">For only P <?php echo $item['price']; ?></p>
							</div>
							<div class="card-footer">
								<a href="catalog.php" class="btn btn-block btn-success">Shop Now!</a>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		<?php endif; ?>
		</div>
	</section>
<?php } ?>