<html>

	<head>
		<title>Регистрация пациента</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<link rel="stylesheet" href="button.css">
	</head>

	<body>
		<br>
		<div class="header">
			<a onclick="javascript:history.go(); return false;">
				<img border="0" alt="Logo" src="logo.png" width="56" height="56">
			</a>
			<font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Регистрация пациента__</b>
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
								<label>Номер медицинской карты*</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "id_card_inp"  maxlength = "6" required pattern = "^[0-9]+$" placeholder="До шести цифр {0...9}">
							</td>
						</tr>

						<tr>
							<td>
								<label>ID врача</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "doctor_id_inp"  maxlength = "11" min = 0 pattern = "^[0-9]+$"
								placeholder="До 11 цифр {0...9}">
							</td>
						</tr>

						<tr>
							<td>
								<label>Фамилия*</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "surname_inp"  maxlength = "20" required pattern = "^[a-zA-Zа-яА-Я ]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Имя*</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "name_inp"  maxlength = "20" required pattern = "^[a-zA-Zа-яА-Я ]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Отчество (если есть)</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "middlename_inp"  maxlength = "20" pattern = "^[a-zA-Zа-яА-Я ]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Возраст</label>
							</td>
							<td>
								<input class="txt_inp" type="number" name = "age_inp"  maxlength = "3" pattern = "^[0-9]+$" min = 0 max = 200>
							</td>
						</tr>

						<tr>
							<td>
								<label>Диагноз*</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "diagnosis_inp"  maxlength = "50" required pattern = "^[a-zA-Zа-яА-Я0-9,._- ]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Дата поступления*</label>
							</td>
							<td>
								<input class="txt_inp" type="date" name = "dt_inp" required min="1800-01-01" max='<?php echo date('Y-m-d');?>' pattern = "[0-9]2-[0-9]{2}-[0-9]{4}">
							</td>
						</tr>

						<tr>
							<td>
								<label>Назначения</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "appointments_inp"  maxlength = "50" pattern = "^[a-zA-Zа-яА-Я0-9,._- ]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Палата</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "room_inp"  maxlength = "5" pattern = "^[0-9]+$" min = 0 max = 99999>
							</td>
						</tr>

						<tr>
							<td>
								<label>Код отделения</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "depcode_inp"  maxlength = "3" pattern = "^[A-ZА-Я0-9-]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Адрес проживания*</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "address_inp"  maxlength = "20" required pattern = "^[a-zA-Zа-яА-Я0-9,._- ]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Работа</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "job_inp"  maxlength = "20" pattern = "^[a-zA-Zа-яА-Я0-9-]+$">
							</td>
						</tr>

						<tr>
							<td>
								<label>Логин для входа*</label>
							</td>
							<td>
								<input class="txt_inp" type="text" name = "log_inp"  maxlength = "20" required pattern = "^[a-zA-Z0-9_]+$" placeholder = "Допустимые символы: 0-9, a-z, A-Z и _" maxlength="20">
							</td>
						</tr>

						<tr>
							<td>
								<label>Пароль для входа*<label>
								</td>
								<td><input class="txt_inp" type="password" name = "password_inp"  maxlength = "20" required pattern = "^[a-zA-Z0-9_]+$" placeholder = "Допустимые символы: 0-9, a-z, A-Z и _" maxlength="20">
							</td>
						</tr>
					</table>
					<br>
					<input class="aa" type="submit" name="Submit"  value="Отправить данные">
					<input class="aa" type="reset" name="enter"  value="Сбросить">
				</form>
				<?php
					if (isset($_GET['id_card_inp']) && isset($_GET['surname_inp']) && isset($_GET['name_inp']) && isset($_GET['diagnosis_inp']) && isset($_GET['dt_inp']) && isset($_GET['address_inp']) && isset($_GET['log_inp']) && isset($_GET['password_inp'])) {
						$id_card_x = $_GET['id_card_inp'];
						$surname_x = $_GET['surname_inp'];
						$name_x = $_GET['name_inp'];
						$diagnosis_x = $_GET['diagnosis_inp'];
						$dt_x = $_GET['dt_inp'];
						$address_x = $_GET['address_inp'];
						$log_x = $_GET['log_inp'];
						$password_x = md5($_GET['password_inp']);
						$middlename_x = $_GET['middlename_inp'];
						$appointments_x = $_GET['appointments_inp'];
						$depcode_x = $_GET['depcode_inp'];
						$job_x = $_GET['job_inp'];


						if (is_numeric($_GET['doctor_id_inp'])) {
							$doctor_id_x = (int)$_GET['doctor_id_inp'];
							$mysqli = new mysqli("localhost","root","899127231112H@rv@rd", "hospital") OR DIE("ERROR CON ");
							$result = $mysqli->query("SELECT id FROM doctors WHERE id = $doctor_id_x");
							if($result->num_rows == 0) {
								DIE("<h1 сolor: white>Такого сотрудника в базе нет</h1>");
							}
							$mysqli->close();
						}

						$db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE("ERROR CON ");			
						mysqli_select_db($db,"hospital") or die(mysqli_error($db));  
						mysqli_query($db, "SET NAMES utf8");
						$query = "INSERT INTO patients (job, depcode, appointments, middlename, id_card, surname, name, diagnosis, dt, address, log, password)

							VALUES ('$job_x', '$depcode_x', '$appointments_x', '$middlename_x', '$id_card_x', '$surname_x', '$name_x', '$diagnosis_x', '$dt_x', '$address_x', '$log_x', '$password_x');"; 
						mysqli_query($db, $query) or die(mysqli_error($db));

						if (is_numeric($_GET['age_inp'])) {
							$age_x = (int)$_GET['age_inp'];
							$query = "UPDATE patients SET age = $age_x WHERE id_card = $id_card_x";
							mysqli_query($db, $query) or die(mysqli_error($db));
						}

						if (is_numeric($_GET['room_inp'])) {
							$room_x = (int)$_GET['room_inp'];
							$query = "UPDATE patients SET room = $room_x WHERE id_card = $id_card_x";
							mysqli_query($db, $query) or die(mysqli_error($db));
						}

						if (is_numeric($_GET['doctor_id_inp'])) {
							$doctor_id_inp = (int)$_GET['doctor_id_inp'];
							$query = "UPDATE patients SET doctor_id = $doctor_id_x WHERE id_card = $id_card_x";
							mysqli_query($db, $query) or die(mysqli_error($db));
						}


		
						echo "<script language = 'javascript'>
							document.location.href = 'admin.php';
						</script>";
					}
				?>
	</body>
</html>