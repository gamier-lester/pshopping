<?php require_once '../controllers/connect.php'; ?>
<?php require_once '../partials/layout.php'; ?>
<?php function show_content() { global $conn;?>
<section id="catalog">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3">
				<ul class="list-group mb-3">
					<p class="list-group-item">By Category</p>
					<a href="../controllers/sort.php?all" class="list-group-item list-group-item-action">Show All</a>
					<?php
						$fetch_prep = $conn->prepare("SELECT * FROM categories");
						$fetch_prep->execute();
						$categories = $fetch_prep->fetchall();
					?>
					<?php
						foreach($categories as $category) {
					?>
					<a href="../controllers/sort.php?category=<?php echo $category['id']; ?>" class="list-group-item list-group-item-action"><?php echo $category['name'] ?></a>
					<?php } ?>

				</ul>

				<ul class="list-group">
					<p class="list-group-item">By Price</p>
					<a href="../controllers/sort.php?price=ASC" class="list-group-item list-group-item-action">Lowest to Highest Price</a>
					<a href="../controllers/sort.php?price=DESC" class="list-group-item list-group-item-action">Highest to Lowest Price</a>
				</ul>
			</div>
			<div class="col-lg-9">
				<div class="row">
				<?php
					if(isset($_SESSION['item_sort']) && isset($_SESSION['item_sort']['category_id']) && isset($_SESSION['item_sort']['price_order'])){
						$item_category = $_SESSION['item_sort']['category_id'];
						$price_order = $_SESSION['item_sort']['price_order'];
						$fetch_prep = $conn->prepare("SELECT * FROM items WHERE category_id=$item_category ORDER BY price $price_order");
					} elseif(isset($_SESSION['item_sort']) && isset($_SESSION['item_sort']['category_id']) && !isset($_SESSION['item_sort']['price_order'])){
						$item_category = $_SESSION['item_sort']['category_id'];
						$fetch_prep = $conn->prepare("SELECT * FROM items WHERE category_id=$item_category");
					} elseif(isset($_SESSION['item_sort']) && !isset($_SESSION['item_sort']['category_id']) && isset($_SESSION['item_sort']['price_order'])){
						$price_order = $_SESSION['item_sort']['price_order'];
						$fetch_prep = $conn->prepare("SELECT * FROM items WHERE ORDER BY price $price_order");
					} else {
						$fetch_prep = $conn->prepare("SELECT * FROM items");
					}
					$fetch_prep->execute();
					$items = $fetch_prep->fetchall();
				?>
				<?php
					foreach($items as $item){
				?>
					<div class="col-lg-3">
						<div class="card">
							<div class="card-header">
								<img src="<?php echo $item['image_path']; ?>" class="card-img-top" alt="Item Image">
							</div>
							<div class="card-body">
								<h5 class="card-title text-center"><?php echo $item['name']; ?></h5>
								<p class="card-text"><?php echo $item['description']; ?></p>
								<p><?php echo '₱'.$item['price']; ?></p>
							</div>
							<div class="card-footer">
								<input type="number" min="1" class="form-control form-group">
								<button data-id="<?php echo $item['id']; ?>" class="btn-block btn btn-primary add-to-cart">Add to cart</button>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>