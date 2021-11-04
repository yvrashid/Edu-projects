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
                $doctor_id_x = $_SESSION['Doctor_ID'];
                $db=mysqli_connect("localhost","root","899127231112H@rv@rd", "hospital") OR DIE(mysqli_error($db));
                mysqli_select_db($db, "hospital");
                mysqli_query($db, "SET NAMES utf8");
                $result = mysqli_query($db, "SELECT surname, name, middlename, experience, specialty FROM doctors WHERE id = '$doctor_id_x'") or die(mysqli_error($db));
                $a=mysqli_fetch_array($result);
                $pole0=$a[0]; $pole1=$a[1];
                $pole2=$a[2]; $pole3=$a[3]; $pole4=$a[4];
                echo "<br><br>";
                echo "<table class=table>"; 
                    echo "<tr><th><b>Фамилия</b></th><td>$pole0</td></tr>
                        <tr><th><b>Имя</b></th> <td>$pole1</td></tr>
                        <tr><th><b>Отчество</b></th> <td>$pole2</td></tr>
                        <tr><th><b>Опыт работы (в годах)</b></th> <td>$pole3</td></tr>
                        <tr><th><b>Специальность (основная)</b></th> <td>$pole4</td></tr>";
                echo "</table>";
                echo "<br><br>";
            }
        ?>
    </body>
</html>