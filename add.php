	<?php
		require_once "pdo.php";
		echo "<pre>\n";
		if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password']))
		{
			$sql="INSERT INTO users (name,email,password) VALUES (:name,:email,:password) ";
			echo "<pre>\n".$sql."</pre>\n";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':name'=>$_POST['name'],
				':email' => $_POST['email'],
				':password' => $_POST['password']
			));
			$_SESSION["success"]="Record Added";
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			return;
		}
		echo "</pre>\n";

		?>
<html>
<body>
	<h1>
		ADD A NEW USER
	</h1>

	<form method="post">
		<p> NAME : <input type="text" name="name" size="40"></p>
		<p> EMAIL : <input type="text" name="email" ></p>
		<p> PASSWORD : <input type="password" name="password"></p>
		<p><input type="submit" value="ADD NEW"/></p>
		<a href="index.php"> Cancel</a>
	</form>

</body>
</html>
