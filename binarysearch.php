<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
</head>
<body>
   <h1>Поиск ключа</h1>
   <form action="" method="POST">
   <table>
   <tr>
   <td>
    Введите номер ключа в файле
	</td> 
	<td>
	<input type="text" name="search" required placeholder="например цифра 2">
	</td>
   </tr>
   	<tr>
   <td>
    <input type="submit">
   </td> 
	<td>
    </td>
   </tr>
   </table>
   </form>
   <br><br><br><br>
<?php
ini_set( 'memory_limit', -1);

function binarySearchByKey($file, $search){
		$string = file_get_contents($file); //читаем данные из файла
		mb_convert_encoding($string, 'cp1251'); //применяем русский язык
		$explodedstring = explode('\x0A', $string); //получается масив ключ\tзначение
		//echo "<pre>";
		//print_r($explodedstring);
		array_pop($explodedstring); //удаление последнего элемента массива, т.к. он пустой
		foreach ($explodedstring as $key => $value) {
			   $arr[] = explode('\t', $value); //формируем массив в массиве с отбражением ключа
		}
		//echo "<pre>";
		//print_r($arr);

	    $start = 0; //задаем начальное значение
	    $end = count($arr)-1; // определяем конец, т.к. нулевой массив считается первым элементом вычитаем 1
 
	while ($start <= $end){//условие пока начальное значение не больше или равно конечному
		$middle = floor(($start + $end)/2); //определяем середину и округляем
		$strnatcmp = strnatcmp($arr[$middle][0],$search); //сравниваем полученное с искомым
		if ($strnatcmp > 0){
			$end = $middle - 1; //присваиваем к конечному значению
		}
		elseif ($strnatcmp < 0){
		$start = $middle + 1; //присваиваем к начальному значению	
		}
		else {
			return $arr[$middle][1]; //возращаем значение ключу
		}
	}
			
	
			return 'undef'; //в случае если в файле нет искомого значения 
		
}

 if (!empty($_POST['search']))
 {
define($PATH_INFO, dirname('_FILE_')); //определяет константу для корневой дирректории
$iskomoye = $_POST['search']; //переменная, которая вводится в поле поиска
$search = 'ключ'.$iskomoye;  //изменить текстовую часть ключа можно тут
$file = $PATH_INFO.'newkey.txt'; //изменить имя файла можно тут

echo "Искомое значение в файле: ";
echo binarySearchByKey($file, $search)."<br>";
 }
 
 echo "Памяти использовано: ";
 require('memory.php');
?>