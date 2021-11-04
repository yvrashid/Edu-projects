<html>
  <head>
    <title>Удаление пациента</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<link rel="stylesheet" href="button.css">
	</head>
	<body >
		<br>
		<div class="header">
			<a onclick="javascript:history.go(); return false;">
				<img border="0" alt="Logo" src="logo.png" width="56" height="56">
			</a>
			<font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Удаление пациента__</b>
			</font>
			<a class="aa" href="admin.php">Назад</a>
		</div>
		<hr>
  		<?php
			session_start();
			if(!isset($_SESSION['Name']))
			{
                echo '<center><a href = "index.php"><h1>Вы не авторизованы</h1></a>';                
				exit;
			}
		?>
	    <div class="delform">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="additem" method="GET"> 
	    		<center>
	        	<table>
	          		<tr>
	          			<td><input class="text_input" type="text" name="id_card_inp" placeholder="Номер медицинской карты пациента" required pattern = "^[0-9]+$"></td>
	    				<td><input class="aa" name="submit" type="submit" value="Удалить"> </td>
	    		 	</tr>
	        	<table>
			</form>
			<br>
	  		<?php 		
	  			if (isset($_GET['id_card_inp'])) {		
	  				$id_card_x = $_GET['id_card_inp'];
	  				$db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE(mysqli_error($db));
	  				mysqli_select_db($db, "hospital");
	  				$c1 = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(1) FROM patients"));
	  				$res = mysqli_query($db, "DELETE FROM patients  WHERE id_card = '$id_card_x'");
	  				$c2 = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(1) FROM patients"));
					if ($c1[0] - $c2[0] == 1) {
						echo "<h1 сolor: white>Пациент удален</h1>";
					}
					else {
						echo "<h1 сolor: white>Пациента нет в базе</h1>";
					}
	  			}
	  		?>
	    </div>
	    <br>
	    <?php
			$db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE(mysqli_error($db));
			mysqli_select_db($db, "hospital");
			mysqli_query($db, "SET NAMES utf8");
			$result = mysqli_query($db, "SELECT id_card, surname, name, middlename FROM patients")or die(mysqli_error($db));	
			$a=mysqli_fetch_array($result);
			echo "<table class=table>";
			echo "<tr>
				<th><b>История болезни №</b></th>
				<th><b>Фамилия</b></th><th><b>Имя</b></th>
				<th><b>Отчество</b></th>
				</tr>";
			do
			{
				$pole0=$a[0]; $pole1=$a[1]; $pole2=$a[2]; $pole3=$a[3];
				echo "<tr><td>$pole0</td><td>$pole1</td>
					<td>$pole2</td><td>$pole3</td>
					</tr>";
			} while ($a=mysqli_fetch_array($result));
			echo "</table>";
	    ?>
	</body>
</html>