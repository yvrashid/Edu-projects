<html>
    <head>
        <title>Пациенты клиники</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="button.css">
    </head>
    <body>
        <br>
        <div class="header">
        	<a onclick="javascript:history.go(); return false;">
				<img border="0" alt="Logo" src="logo.png" width="56" height="56">
			</a>
            <font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Пациенты клиники__</b>
            </font> 
            <a class="aa" onclick="javascript:history.back(); return false;">Назад</a>
        </div>
        <hr>

        <?php
            session_start();
            if (!isset($_SESSION['Name'])) {
                echo '<center><a href = "index.php"><h1>Вы не авторизованы</h1></a>';                
                exit;
            }
            else { 	
				$db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE(mysqli_error($db));
				mysqli_select_db($db, "hospital");
				mysqli_query($db, "SET NAMES utf8");
				$result = mysqli_query($db, "SELECT * FROM patients")or die(mysqli_error($db));	
				$a=mysqli_fetch_array($result);
				echo "<table class=table>";
				echo "<tr>
					<th><b>История болезни №</b></th>
					<th><b>Фамилия</b></th>
					<th><b>Имя</b></th>
					<th><b>Отчество</b></th>
					<th><b>Возраст</b></th>
					<th><b>Дата поступления</b></th>
					<th><b>Диагноз</b></th>
					<th><b>Назначения</b></th>
					<th><b>Отделение</b></th>
					<th><b>Палата</b></th>
					<th><b>Адрес проживания</b></th>
					<th><b>Место работы</b></th>
					<th><b>Лечащий врач (ID)</b></th>
					</tr>";
				do
				{
					$pole0=$a[0];
					$pole2=$a[2];
					$pole3=$a[3];
					$pole4=$a[4];
					$pole5=$a[5];
					$pole7=$a[7];
					$pole6=$a[6];
					$pole8=$a[8];
					$pole10=$a[10];
					$pole9=$a[9];
					$pole11=$a[11];
					$pole12=$a[12];
					$pole1=$a[1];
					echo "<tr>
						<td>$pole0</td>
						<td>$pole2</td>
						<td>$pole3</td>
						<td>$pole4</td>
						<td>$pole5</td>
						<td>$pole7</td>
						<td>$pole6</td>
						<td>$pole8</td>
						<td>$pole10</td>
						<td>$pole9</td>
						<td>$pole11</td>
						<td>$pole12</td>
						<td>$pole1</td>
						</tr>";
				} while ($a=mysqli_fetch_array($result));
				echo "</table>";
			}
		?>
	</body>
</html>