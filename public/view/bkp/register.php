<!--Registration page -->
	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Sound</title>
	<style type="text/css" media="screen">
	 .title {
		 width: 100%;
		 text-align: center;
		 margin-top: 100px;
	 }

	 .register {
		 display: grid;
		 justify-content: center;
		 grid-template-columns: repeat(1, 230px);
		 margin-top: 60px;
	 }
	</style>

</head>
<body>
	<div class="title">
		<h2>Register:</h2>
	</div>
	<div class="register">
		<form action="/register" method="POST">
		<input type="text" name="first_name" placeholder="First Name" size="25" required>
		<br>
		<br>
		<input type="text" name="last_name" placeholder="Last Name" size="25" required>
		<br>
		<br>
		<input type="text" name="username" placeholder="Username" size="25" required>
		<br>
		<br>
		<input type="text" name="email" placeholder="Email" size="25" required>
		<br>
		<br>
		<input type="password" name="password" placeholder="Password" size="25" required>
		<br>
		<br>
		<input type="password" name="password1" placeholder="Confirm password" size="25" required />
		<br>
		<br>
		<input type="hidden" name="status" value="Disabled"/>
		<input type="hidden" name="registration_date" value=<?php echo date("Y-m-d, H:i:s")?>/>
		<input type="hidden" name="verification_code" value=<?php echo hash('sha512', uniqid()) ?>>
		<input type="submit" value="Submit" name="submit" style="margin-left: 80px;">
	</form>
	<p style="text-align: center; margin-top: 50px;"><a href="/login">Go back</a></p>
	</div>
</body>
</html>
