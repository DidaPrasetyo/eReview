<html>
<title>Select Potential Reviewer</title>
<body>
	<h1>Select Potential Reviewer</h1>

	<p>
		A new task has been succesfully added
	</p>
	<p>
		<table>
			<tr>
				<td>Judul</td>
				<td><?php echo $task['judul']; ?></td>
			</tr>
			<tr>
				<td>Kata Kunci</td>
				<td><?php echo $task['keywords']; ?></td>
			</tr>
			<tr>
				<td>Reviewer</td>
				<td>
					<select id="reviewer"> 
						<option value="<?php echo $reviewers[0]['id_reviewer'];?>">
							<?php echo $reviewers[0]['nama'];?>
						</option>
						<option value="<?php echo $reviewers[1]['id_reviewer'];?>">
							<?php echo $reviewers[1]['nama'];?>
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Simpan</td>
				<td><?php echo "Submit";?></td>
			</tr>
		</table>
	</p>
</body>
</html>