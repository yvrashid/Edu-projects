<html>
	<head>
		<title>Поликлиника. Электронный личный кабинет для всех</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<link rel="stylesheet" href="button.css">
	</head>
	<body>
		<br>
		<div class="header">
			<a onclick="javascript:history.go(); return false;">
				<img border="0" alt="Logo" src="logo.png" width="56" height="56">
			</a>
			<font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Электронный личный кабинет для каждого__</b>
			</font>
			<a class="aa" href="staff.php">Врачи</a>
			<a class="aa" href="about.php">Об учреждении</a>
		</div>
		<hr>

		<table align = "center" cellpadding="9">
			<tr>
                <td>
                    <a onclick="javascript:history.go(); return false;">
                        <img align="left" border="0" alt="Logo" src="logo.png" width="450" height="450">
                    </a>
                </td>
				<td>
					<div class="authform">
					<center>
						<h1>Вход в систему</h1>
						<form class="kek" method = "post"> 
						<table>
							<tr>
								<td>
									<label>Логин</label> 
								</td>
								<td>
									<input class="text_input" type="text" name="log" required pattern="^[a-zA-Z0-9_]+$" placeholder = "Допустимые символы: 0-9, a-z, A-Z и _" maxlength="20" />
								</td>
							</tr>

							<tr>
								<td>
									<label>Пароль</label> 
								</td>
								<td>
									<input class="text_input" type="password" name="pass" required pattern = "^[a-zA-Z0-9_]+$" placeholder = "Допустимые символы: 0-9, a-z, A-Z и _" maxlength="20"/>
								</td>
							</tr>

						</table>
						<br>
						<input class="aa" type="submit" name="enter"  value="Войти">
						<input class="aa" type="reset" name="enter"  value="Сбросить">
					</form>
					<?php
						session_start();
						if (isset ($_POST['log'])) 
						{
							$log_x = $_POST['log'];
							$mysqli = new mysqli("localhost","root","899127231112H@rv@rd", "hospital") OR DIE("ERROR CON ");
							$test1 = $mysqli->query("SELECT log FROM patients WHERE log = '$log_x'");
							$test2 = $mysqli->query("SELECT log FROM doctors WHERE log = '$log_x'");
							if($test1->num_rows == 0 && $test2->num_rows == 0) {
								echo "<div style=\"font:bold 13px Myriad Pro; color:grey;\">В базе нет такого пациента</div>";
								DIE();
							}
							$mysqli->close();

							$db = mysqli_connect('localhost','root','899127231112H@rv@rd', "hospital") or die ("Соединение не установлено!"); 
							mysqli_select_db($db,"hospital") or die ("Соединение не очень установлено!"); 
							$resultat = mysqli_query($db, "SELECT log, password, name, isadmin, isdoctor, surname, middlename FROM doctors GROUP BY id") or die(mysqli_error($db)); 
							$array = mysqli_fetch_array($resultat); 

							do {
								$x = True;
								$flag = False;


								if ($array['isdoctor'] = 1 && $_POST['log'] == $array['log'] && md5($_POST['pass']) == $array['password']) {
									if ($array['isadmin'] == 1) {
										$_SESSION['Name']=$_POST['log'];
										$_SESSION['sur']=$array['surname'];
										$_SESSION['nam']=$array['name'];
										$_SESSION['mid']=$array['middlename'];
										
										echo "<script language = 'javascript'>
											document.location.href = 'admin.php';
											</script>";
										$x = False;
										$flag = True;
									}
									else {
										$_SESSION['Name']=$_POST['log'];
										echo "<script language = 'javascript'>
											document.location.href = 'doctor.php';
											</script>";
										$x = False;
										$flag = True;
									}
								}
							} while($array=mysqli_fetch_array($resultat));
							if (!$flag) {
								$resultat = mysqli_query($db,"SELECT log, password, doctor_id FROM patients GROUP BY id_card") or die(mysqli_error($db)); 
								$array = mysqli_fetch_array($resultat);
								do {
									if ($_POST['log'] == $array['log'] && md5($_POST['pass']) == $array['password']) {
										$_SESSION['Name']=$_POST['log'];
										$_SESSION['Doctor_ID']=$array['doctor_id'];
										echo "<script language = 'javascript'>
											document.location.href = 'user.php';
											</script>";
											$x = False;
									}
								} while($array=mysqli_fetch_array($resultat));
							}
							If ($x = True) {
								echo "<div style=\"font:bold 13px Myriad Pro; color:grey;\">Неправильно введены данные</div>";
							}
						}
					?>
				</td>
			</tr>
		</table>
		</div>
	</body>
</html>