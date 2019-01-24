<?php require_once '../partials/layout.php'; ?>
<?php function show_content() { ?>

<?php if(!isset($_SESSION['user'])): ?>
	<section id="login">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 mt-5">
				<form>
					<div class="form-group">
						<label>Username: </label>
						<input id="login_username" type="text" name="username" class="form-control">
						<span id="login_error_handler_username" class="text-lead text-danger"></span>
					</div>
					<div class="form-group">
						<label>Password: </label>
						<input id="login_password" type="password" name="password" class="form-control">
						<span id="login_error_handler_password" class="text-lead text-danger"></span>
					</div>
					<button id="login_button" class="btn btn-success btn-block">Login</button>
					<button id="signup_button" class="btn btn-block">Signup</button>
				</form>
			</div>
		</div>
	</section>

<?php else: header('Location: ./home.php');?>
<?php endif; ?>
<?php } ?>