	<?php
		require_once "pdo.php";
		echo "<pre>\n";
		if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['user_id']))
		{
			$sql="UPDATE users SET name = :name, email = :email, password = :password WHERE user_id=:user_id ";
			echo "<pre>\n".$sql."</pre>\n";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':name'=>$_POST['name'],
				':email' => $_POST['email'],
				':password' => $_POST['password'],
				':user_id' => $_POST['user_id']
			));
			$_SESSION["error"]="Record Updated";
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			return;
		}

		$stmt = $pdo->prepare("SELECT name,user_id,email,password FROM users where user_id = :xyz");
		$stmt->execute(array(
				':xyz'=>$_GET['user_id']
			));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row===false){
			$_SESSION["success"]="Error";
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			return;
		}
		echo "</pre>\n";

		$n=htmlentities($row['name']);
		$e=htmlentities($row['email']);
		$p=htmlentities($row['password']);
		$user_id=htmlentities($row['user_id']);

		?>
<html>
<body>
	<h1>
		EDIT 
	</h1>

	<form method="post">
		<p> NAME : <input type="text" name="name" value="<?= $n ?>"></p>
		<p> EMAIL : <input type="text" name="email" value="<?= $e ?>"></p>
		<p> PASSWORD : <input type="password" name="password" value="<?= $p ?>"></p>
		<input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
		<input type="submit" value="UPDATE" name="UPDATE">
		<a href="index.php">Cancel</a>
	</form>

</body>
</html>
