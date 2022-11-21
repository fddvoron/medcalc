<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<title>MEDCALC.EXE</title>
<link rel="stylesheet" type="text/css" href="medcalc.css" />
</head>
<body>
<p align="center">МЕДИЦИНСКИЙ КАЛЬКУЛЯТОР</p> 
<? 

include 'medfunc.php';

echo '<div id="window"><form id="form1" name="form1" method="post" action="medcalc.php">';
echo '<table>';
echo '<tr><td>Пол</td><td><select name="sexform" size = "1">';
echo '<option value="1">Мужской</option><option value="2">Женский</option></select></td></tr>';
echo '<tr><td>Возраст, лет</td><td><input name="ageform" type="text" maxlength="2" size="4" /></td></tr>';
echo '<tr><td>Масса тела, кг</td><td><input name="massaform" type="text" maxlength="3" size="4" /></td></tr>';
echo '<tr><td>Рост, см</td><td><input name="heightform" type="text" maxlength="3" size="4" /></td></tr>';
echo '<tr><td>Креатинин, мкмоль/л</td><td><input name="creatinineform" type="text" maxlength="3" size="4" /></td></tr>';
echo '<tr><td colspan="2" align="center"><input type="submit" name="EpiSubmit" value="СКФ по CKD-EPI" /> <input type="submit" name="KgSubmit" value="СКФ по Кокрофту-Голту" /> <input type="submit" name="ImtSubmit" value="ИМТ" /></form></td></tr>';
echo '</table></div>';


if(isset($_POST['EpiSubmit']))
{
	echo "<script> document.getElementById('window').innerHTML = '' </script>";

	$sextype = (int)$_POST['sexform'];
	$age = (int) $_POST['ageform'];
	$creatinine = (int) $_POST['creatinineform'];

	if ($creatinine == 0) $creatinine = 1;
	if ($sextype == 1) $sextab = 'Мужской';
	if ($sextype == 2) $sextab = 'Женский';

	echo '<div id="window"><table>';
	echo '<tr><td>Пол</td><td><center>'.$sextab.'</center></td></tr>';
	echo '<tr><td>Возраст, лет</td><td><center>'.$age.'</center></td></tr>';
	echo '<tr><td>Креатинин, мкмоль/л</td><td><center>'.$creatinine.'</center></td></tr>';
	echo '<tr><td>Скорость клубочковой фильтрации по формуле CKD-EPI, мл/мин/1,73м<sup>2</sup></td><td><center><b>'.Clearance_EPI($sextype, $age, $creatinine).'</b></center></td></tr>';
	echo '</table></div>';
	echo '<p align="center">:: <a href="medcalc.php">Назад</a> ::</p>';
}


if(isset($_POST['KgSubmit']))
{
	echo "<script> document.getElementById('window').innerHTML = '' </script>";

	$sextype = (int)$_POST['sexform'];
	$age = (int) $_POST['ageform'];
	$massa = (int) $_POST['massaform'];
	$creatinine = (int) $_POST['creatinineform'];

	if ($creatinine == 0) $creatinine = 1;
	if ($sextype == 1) $sextab = 'Мужской';
	if ($sextype == 2) $sextab = 'Женский';

	echo '<div id="window"><table>';
	echo '<tr><td>Пол</td><td><center>'.$sextab.'</center></td></tr>';
	echo '<tr><td>Возраст, лет</td><td><center>'.$age.'</center></td></tr>';
	echo '<tr><td>Масса тела, кг</td><td><center>'.$massa.'</center></td></tr>';
	echo '<tr><td>Креатинин, мкмоль/л</td><td><center>'.$creatinine.'</center></td></tr>';
	echo '<tr><td>Клиренс креатинина по формуле Кокрофта-Голта, мл/мин</td><td><center><b>'.Clearance_KG($sextype, $massa, $age, $creatinine).'</b></center></td></tr>';
	echo '</table></div>';
	echo '<p align="center">:: <a href="medcalc.php">Назад</a> ::</p>';
}


if(isset($_POST['ImtSubmit']))
{
	echo "<script> document.getElementById('window').innerHTML = '' </script>";

	$massa = (int) $_POST['massaform'];
	$height = (int) $_POST['heightform'];

	if ($height == 0) $height = 1;

	echo '<div id="window"><table>';
	echo '<tr><td>Масса тела, кг</td><td><center>'.$massa.'</center></td></tr>';
	echo '<tr><td>Рост, см</td><td><center>'.$height.'</center></td></tr>';
	echo '<tr><td>Индекс массы тела, кг/см&sup2;</td><td><center><b>'.IMT($height, $massa).'</b></center></td></tr>';
	echo '</table></div>';
	echo '<p align="center">:: <a href="medcalc.php">Назад</a> ::</p>';

}

echo '<table>';
echo '<tr><td align="justify" >Всестороннюю квалифицированную оценку результатов расчетов может произвести только лечащий врач.<br />Используя калькулятор вы соглашаетесь с тем, что результаты расчетов предоставляются без каких-либо гарантий и по принципу "как есть".</td></tr>';
echo '</table>';


?>
</body>
</html>