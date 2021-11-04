<html>
<head>
	<title>Регистрация персонала</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<link rel="stylesheet" href="button.css">
</head>

<body>
	<br>
	<div class="header">
		<a onclick="javascript:history.go(); return false;">
				<img border="0" alt="Logo" src="logo.png" width="56" height="56">
			</a>
		<font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Регистрация персонала__</b>
		</font>
		<a class="aa" href="admin.php">Назад</a>
	</div>
	<hr>
	<?php
		session_start();
		if (!isset($_SESSION['Name'])) {
			echo '<center><a href = "index.php"><h1>Вы не авторизованы</h1></a>';
			exit;
		}
	?>
	<div class="regform">
		<center>
			<h1>Регистрационные данные</h1>
			<form  class="regs" method="get">
				<table>
					<tr>
						<td>
							<label>Фамилия*</label>
						</td>
						<td>
							<input class="txt_inp" type="text" name = "lname"  maxlength = "30" required pattern = "^[a-zA-Zа-яА-Я ]+$">
						</td>
					</tr>
					<tr>
						<td>
							<label>Имя*</label>
						</td>
						<td>
							<input class="txt_inp" type="text" name = "fname"  maxlength = "15" required pattern = "^[a-zA-Zа-яА-Я ]+$">
						</td>
					</tr>
					<tr>
						<td>
							<label>Отчество (если есть)</label>
						</td>
						<td>
							<input class="txt_inp" type="text" name = "mname"  maxlength = "15" pattern = "^[a-zA-Zа-яА-Я ]+$">
						</td>
					</tr>

					<tr>
						<td>
							<label>Логин для входа*</label>
						</td>
						<td>
							<input class="txt_inp" type="text" name = "log"  maxlength = "20" required pattern = "^[a-zA-Z0-9_]+$"
							placeholder = "Допустимые символы: 0-9, a-z, A-Z и _" maxlength="20">
						</td>
					</tr>

					<tr>
						<td>
							<label>Пароль для входа*<label>
						</td>
						<td><input class="txt_inp" type="password" name = "pass"  maxlength = "20" required pattern = "^[a-zA-Z0-9_]+$"
						placeholder = "Допустимые символы: 0-9, a-z, A-Z и _" maxlength="20">
						</td>
					</tr>
					<tr>
						<td>
							<label>Опыт работы*</label>
						</td>
						<td>
							<input class="txt_inp" type="text" name = "exp"  maxlength = "3" required pattern = "^[0-9]+$" min = 0 max = 200>
						</td>
					</tr>
					<tr>
						<td>
							<label>Специальность*</label>
						</td>
						<td>
							<input class="txt_inp" type="text" name = "spec"  maxlength = "30" required pattern = "^[a-zA-Zа-яА-Я ]+$">
						</td>
					</tr>

				</table>
				<br>
				<input class="aa" type="submit" name="Submit"  value="Отправить данные">
				<input class="aa" type="reset" name="enter"  value="Сбросить">
			</form>
			<?php
				if (isset($_GET['lname']) && isset($_GET['fname']) && isset($_GET['log']) && isset($_GET['pass']) && isset($_GET['exp']) && isset($_GET['spec'])) {
					$lastname = $_GET['lname'];
					$firstname = $_GET['fname'];
					$login = $_GET['log'];
					$password = md5($_GET['pass']);
					$exper = $_GET['exp'];
					$special = $_GET['spec'];
					$middlename = $_GET['mname'];

					$table = "doctors";
					$db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE("ERROR CON ");			
					mysqli_select_db($db,"hospital") or die(mysqli_error($db));
					mysqli_query($db, "SET NAMES utf8");


					$query = "INSERT INTO doctors (log,password,surname, name, middlename, experience, specialty, isadmin)  
						VALUES ('$login','$password', '$lastname', '$firstname', '$middlename','$exper', '$special', False)"; 
					mysqli_query($db,$query) or die(mysqli_error($db)); 
					
					echo "<script language = 'javascript'>
						document.location.href = 'admin.php';
						</script>";
				}
			?>

</body>
</html>