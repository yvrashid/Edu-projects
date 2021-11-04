<html>
    <head>
        <title>Персонал клиники</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="button.css">
    </head>
    <body>
        <br>
        <div class="header">
        	<a onclick="javascript:history.go(); return false;">
				<img border="0" alt="Logo" src="logo.png" width="56" height="56">
			</a>
            <font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Персонал клиники__</b>
            </font>
            <input class = "aa" type="button" onclick="history.back();" value="Назад"/>
        </div>
        <hr>

        <?php
            session_start();
			$db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE(mysqli_error($db));
			mysqli_select_db($db, "hospital");
			mysqli_query($db, "SET NAMES utf8");
			$result = mysqli_query($db, "SELECT * FROM doctors")or die(mysqli_error($db));	
			$a=mysqli_fetch_array($result);
            if (isset($_SESSION['Name'])) {
				echo "<table class=table>";
				echo "<tr>
					<th><b>ID</b></th><th><b>Фамилия</b></th><th><b>Имя</b></th><th><b>Отчество</b></th>
					<th><b>Специальность</b></th><th><b>Опыт работы</b></th>
					</tr>";
				do
				{
					$pole0=$a[0];$pole3=$a[3];$pole4=$a[4];
					$pole5=$a[5];$pole6=$a[6];$pole7=$a[7];
					echo "<tr>
						<td>$pole0</td><td>$pole3</td><td>$pole4</td>
						<td>$pole5</td><td>$pole7</td><td>$pole6</td>
						</tr>";
				} while ($a=mysqli_fetch_array($result));
				echo "</table>";
            }
            else { 	
				echo "<table class=table>";
				echo "<tr>
					<th><b>Фамилия</b></th><th><b>Имя</b></th><th><b>Отчество</b></th>
					<th><b>Специальность</b></th><th><b>Опыт работы</b></th>
					</tr>";
				do
				{
					$pole3=$a[3];$pole4=$a[4];$pole5=$a[5];
					$pole6=$a[6];$pole7=$a[7];
					echo "<tr>
						<td>$pole3</td><td>$pole4</td><td>$pole5</td>
						<td>$pole7</td><td>$pole6</td>
						</tr>";
				} while ($a=mysqli_fetch_array($result));
				echo "</table>";
			}
		?>
	</body>
</html>