<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="./resources/css/style.css">

	</head>
	<div class="bg-image"></div>
	<body class="img js-fullheight" style="background-color: #000000;">

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Mixer</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Register</h3>
		      	<form action="/register" class="signin-form" method="POST">

							<div class="form-group">
		      			<input name="first_name" type="text" class="form-control" placeholder="First name" required>
		      		</div>

<div class="form-group">
		      			<input name="last_name" type="text" class="form-control" placeholder="Last name" required>
		      		</div>

<div class="form-group">
		      			<input name="username" type="text" class="form-control" placeholder="Username" required>
		      		</div>

<div class="form-group">
		      			<input name="email" type="text" class="form-control" placeholder="email" required>
		      		</div>

							<div class="form-group">
	              <input name="password" id="password-field" type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>

							<div class="form-group">
	              <input name="confirm_password" id="password-field" type="password" class="form-control" placeholder="Confirm Password" required>
							</div>
	<input type="hidden" name="status" value="Disabled"/>
		<input type="hidden" name="registration_date" value=<?php echo date("Y-m-d, H:i:s")?>/>
		<input type="hidden" name="verification_code" value=<?php echo hash('sha512', uniqid()) ?>>


							<div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>

							<div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Forgot Password</a>
								</div>
	            </div>
<div style="display:flex; justify-content:center;">
									<a href="/login" style="color: #fff">Login</a>



	          </form>
          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="./resources/js/jquery.min.js"></script>
  <script src="./resources/js/popper.js"></script>
  <script src="./resources/js/bootstrap.min.js"></script>
  <script src="./resources/js/main.js"></script>

	</body>
</html>

