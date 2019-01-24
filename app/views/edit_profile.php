<?php require_once '../partials/layout.php'; ?>
<?php function show_content() { ?>
<?php if(isset($_SESSION['user'])): ?>
<section id="profile">
	<div class="row">
		<div class="col-lg-6 offset-lg-3 mt-5">
			<form class="text-center">
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Username</label>
					<div class="col-lg-9">
						<input type="text" readonly class="form-control-plaintext" value="<?php echo $_SESSION['user']['username']; ?>" name="username">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Firstname</label>
					<div class="col-lg-9">
						<input type="text" readonly class="form-control-plaintext" value="<?php echo $_SESSION['user']['firstname']; ?>" name="firstname">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Lastname</label>
					<div class="col-lg-9">
						<input type="text" readonly class="form-control-plaintext" value="<?php echo $_SESSION['user']['lastname']; ?>" name="lastname">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Email</label>
					<div class="col-lg-9">
						<input id="email" type="text" class="form-control" value="<?php echo $_SESSION['user']['email']; ?>" name="email">
						<span id="edit_error_handler_email" class="text-danger"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Address</label>
					<div class="col-lg-9">
						<input id="address" type="textarea" class="form-control" value="<?php echo $_SESSION['user']['address']; ?>" cols="10" row="3" name="address">
						<span id="edit_error_handler_address" class="text-danger"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">New Password</label>
					<div class="col-lg-9">
						<input id="edit_password" type="password" class="form-control" name="password">
						<span id="edit_error_handler_password" class="text-danger"></span>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-lg-3 col-form-label">Confirm Password</label>
					<div class="col-lg-9">
						<input id="edit_cpassword" type="password" class="form-control" name="cpassword">
						<span id="edit_error_handler_cpassword" class="text-danger"></span>
					</div>
				</div>
				<button id="update_button" class="btn btn-block btn-success">Save Changes</button>
			</form>
		</div>
	</div>
</section>
<?php else: header('Location: ./home.php'); ?>
<?php endif; ?>
<?php } ?>