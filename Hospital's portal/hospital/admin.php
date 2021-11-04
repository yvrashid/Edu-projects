<html>
    <head>
        <title>Электронный личный кабинет главного врача</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="button.css">
    </head>
    <body>
        <br>
        <div class="header">
            <a onclick="javascript:history.go(); return false;">
                <img border="0" alt="Logo" src="logo.png" width="56" height="56">
            </a>
            <font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Электронный личный кабинет главного врача__</b>
            </font>
            <a class="aa" href="logout.php">Выйти</a>
        </div>
        <hr>
        <?php
            session_start();
            if (!isset($_SESSION['Name'])) {
                echo '<center><a href = "index.php"><h1>Вы не авторизованы</h1></a>';
                exit;
            }
            else {
                $sur = $_SESSION['sur'];
                $nam = $_SESSION['nam'];
                $mid = $_SESSION['mid'];

                echo '<center><h1>Добро пожаловать, '.$sur.'  '.$nam.'  '.$mid.'!</h1>';
                echo '<div class="patients">
                    <center>
                    <a class="aa" href="patients.php">Пациенты клиники</a>
                    <a class="aa" href="reg_patient.php">Новый пациент</a>
                    <a class="aa" href="del_patient.php">Удаление пациента</a>
                    <!--<a class="aa" href="edit_patient.php">Редактирование данных пациента</a> -->
                    </div>
                    <br><br>
                    <div class="staff">
                    <center>
                    <a class="aa" href="staff.php">Персонал клиники</a>
                    <a class="aa" href="reg_employee.php">Новый сотрудник</a>
                    <a class="aa" href="del_employee.php">Увольнение сотрудника</a>
                    <!--<a class="aa" href="edit_employee.php">Редактирование данных сотрудника</a> -->
                    </div>
                    <center>
                    <br><br>
                    <a class="aa" href="about.php">Сведения об учреждении здравоохранения</a>';
            }
        ?>
    </body>
</html>