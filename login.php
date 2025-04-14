<?php session_start() ?>
<div class="container-fluid">		<!-- Container to hold the login form -->
	<form action="" id="login-frm">
		<div class="form-group">	<!-- Email input field -->
			<label for="" class="control-label">Email</label>
			<input type="email" name="username" required="" class="form-control">
		</div>
		<div class="form-group">	<!-- Password input field -->
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<!-- Link to create a new account -->
			<small><a href="index.php?page=signup" id="new_account">Create New Account</a></small>
		</div>
		<button class="button btn btn-info btn-sm">Login</button>	<!-- Submit button -->
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>

<script>
	$('#login-frm').submit(function(e){
		e.preventDefault()	// Prevent default form submit (page reload)
		// Change the button text and disable it to prevent double submission
		$('#login-frm button[type="submit"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )	// Remove previous error messages if any
			$(this).find('.alert-danger').remove();
		$.ajax({	// Make AJAX request to login endpoint
			url:'admin/ajax.php?action=login2',
			method:'POST',
			data:$(this).serialize(),	 // Send form data
			error:err=>{
				console.log(err)	// Log the error for debugging
				// Re-enable button and restore text
		$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){	// If AJAX request is successful (login check result)
				if(resp == 1){
					// Login success — redirect to home or redirect target if specified
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				}else if(resp == 2){
					// Account exists but is not verified yet
					$('#login-frm').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}else{
					// Invalid credentials
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>