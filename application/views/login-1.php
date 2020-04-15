<!DOCTYPE html>
<html>
<head>
	<title>Login Page eReviewer</title>
</head>
<body>
	<h1>Login</h1>

	<p>
		<?php if (strlen($msg)>0) echo $msg; ?>
	</p>

	<form action="checkingLogin" method="post">
		
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" id="username" name="username" width="100"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" id="password" name="password" width="100"/></td>
			</tr>
		</table>

		<input type="submit" value="Submit">
	</form>
</body>
</html>