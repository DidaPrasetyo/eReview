<!DOCTYPE html>
<html>
<head>
	<title>Create Account eReview</title>
</head>
<body>
	<h1>Form Pembuatan Akun Baru</h1>

	<p>
		<?php if (strlen($msg)>0) echo $msg; ?>
	</p>

	<form action="createingAccount" method="post">
		
		<table>
			<tr>
				<td>Nama</td>
				<td><input type="text" id="nama" name="nama" width="100"/></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type="text" id="username" name="username" width="100"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" id="password" name="password" width="100"/></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" id="email" name="email" width="100"/></td>
			</tr>
			<tr>
				<td>Peran</td>
				<td><select id="peran"> 
						<option value="1">
							Editor
						</option>
						<option value="2">
							Reviewer
						</option>
					</select>
				</td>
			</tr>
		</table>

		<input type="submit" value="Submit">
	</form>
</body>
</html>