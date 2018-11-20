	<?php
		require_once "pdo.php";
		echo "<pre>\n";
		

		if(isset($_POST['user_id']))
		{
			$sql="DELETE FROM users WHERE user_id= :x ";
			echo "<pre>\n".$sql."</pre>\n";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':x'=>$_POST['user_id']
			));
			$_SESSION["error"]="Record Deleted";
			echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			return;
		}

		$stmt = $pdo->prepare("SELECT name,user_id FROM users where user_id = :xyz");
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

?>
<html>
<body>
	<h1>
		CONFIRM DELETING
	</h1>
	<p>Deleting <?= htmlentities($row['name'])?></p>

	<form method="post">
		<input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
		<input type="submit" value="DELETE" name="DELETE">
		<a href="index.php">Cancel</a>
	</form>

</body>
</html>