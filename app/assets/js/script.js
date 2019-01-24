// console.log('script connected');

$(document).ready(() => {
	$('#login_button').click(event => {
		event.preventDefault();

		let username = $("#login_username").val();
		let password = $("#login_password").val();
		if(username == ""){
			$("#login_error_handler_username").text('Invalid Username');
		} else if(password == "") {
			$("#login_error_handler_password").text('Invalid Password');
		} else {
			$.ajax({
				"url": '../controllers/authenticate.php',
				"method": 'POST',
				"data" : {
					'username': username,
					'password': password,
					'procedure': 'login'
				}
			}).done(jsondata => {
				let responseData = JSON.parse(jsondata);
				if(responseData != false) {
					location.replace('./home.php');
				} else {
					// $("#login_error_handler_username").text('User does not exist');
					alert('Login failed')
				}
			});
		}
	});

	$('#logout').click(event => {
		$.ajax({
			"url": '../controllers/authenticate.php',
			'method': 'POST',
			'data': {
				'procedure': 'logout'
			}
		}).done(() => {
			location.reload();
		});
	});

	$('#update_button').click(event => {
		event.preventDefault();

		let email = $('#email').val();
		let address = $('#address').val();
		let edit_password = $('#edit_password').val();
		let edit_cpassword = $('#edit_cpassword').val();

		if(email == ''){
			$('#edit_error_handler_email').text('email can not be empty');
		} else if (address == ''){
			$('#edit_error_handler_address').text('address is needed for shipping');
		} else if (edit_password !== edit_cpassword) {
			$("#edit_error_handler_password").text('password does not match');
			$("#edit_error_handler_cpassword").text('password does not match');
		} else {
			$.ajax({
				'url': '../controllers/authenticate.php',
				'method': 'POST',
				'data': {
					'procedure': 'editProfile',
					'email': email,
					'address': address,
					'password': edit_password
				}
			}).done(() => {
				location.reload();
			});
		}

	});

});