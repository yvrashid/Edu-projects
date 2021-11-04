<html>
    <head>
        <title>Личный кабинет пациента</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="button.css">
    </head>
    <body>
        <br>
        <div class="header">
            <a onclick="javascript:history.go(); return false;">
                <img border="0" alt="Logo" src="logo.png" width="56" height="56">
            </a>
            <font size="6" color="grey" face="Myriad Pro Light"><b>Поликлиника. Личный кабинет пациента__</b>
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
                $username = $_SESSION['Name'];
                $db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE(mysqli_error($db));
                mysqli_select_db($db, "hospital");
                mysqli_query($db, "SET NAMES utf8");
                $result = mysqli_query($db, "SELECT * FROM patients WHERE log = '$username'") or die(mysqli_error($db));
                $a=mysqli_fetch_array($result);
                $pole0=$a[0]; $pole2=$a[2]; $pole3=$a[3];
                $pole4=$a[4]; $pole5=$a[5]; $pole7=$a[7];
                $pole6=$a[6]; $pole8=$a[8]; $pole10=$a[10];
                $pole9=$a[9]; $pole11=$a[11]; $pole12=$a[12];
                $pole1=$a[1];

                echo '<center><h1>Добро пожаловать, '.$pole2.'  '.$pole3.'  '.$pole4.'!</h1>';
                echo "<table class=table>"; 
                    echo "<tr><th><b>История болезни №</b></th><td>$pole0</td></tr>
                        <tr><th><b>Возраст</b></th> <td>$pole5</td></tr>
                        <tr><th><b>Дата поступления</b></th> <td>$pole7</td></tr>
                        <tr><th><b>Диагноз</b></th> <td>$pole6</td></tr>
                        <tr><th><b>Назначения</b></th> <td>$pole8</td></tr>
                        <tr><th><b>Отделение</b></th> <td>$pole10</td></tr>
                        <tr><th><b>Палата</b></th> <td>$pole9</td></tr>
                        <tr><th><b>Адрес проживания</b></th> <td>$pole11</td></tr>
                        <tr><th><b>Место работы</b></th> <td>$pole12</td></tr>
                        <tr><th><b>Лечащий врач (ID)</b></th> <td>$pole1</td></tr>";
                echo "</table>";
                echo "<br><br>";
                echo '<div class="patients">
                    <center>
                    <a class="aa" href="personal_doctor.php">Мой лечащий врач</a>
                    <a class="aa" href="about.php">Сведения об учреждении здравоохранения</a>
                    </div>
                    <br><br>';
            }
        ?>
    </body>
</html>