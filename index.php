<html>
	<head>
		<title>Recipe Finder</title>
	</head>
	<body>
		<div style="color:red"><?php echo isset($_GET['error']) ? $_GET['error'] : ''?></div>
		<form name="frmRecipeFinder" method="POST" enctype="multipart/form-data" action="recipe_finder.php">
			<table>
				<thead>
					<tr><td colspan="2"><h1>Recipe Finder</h1>
					<h3>Please upload recipe and ingredient files to get recipe suggestions<h3></td></tr>
				</thead>
				<tbody>
					<tr><td>Recipe File</td><td><input type="file" name="recipes"><br>(A .json file)</td></tr>
					<tr><td>Ingredient File</td><td><input type="file" name="ingredients"><br>(A .csv file)</td></tr>
					<tr><td colspan="2"><input type="submit" name="submit" value="Submit"></td></tr>
				</tbody>
			</table>
		</form>
		<div style="color:green"><?php echo isset($_GET['recipe']) ? $_GET['recipe'] : ''?></div>
	</body>
</html>