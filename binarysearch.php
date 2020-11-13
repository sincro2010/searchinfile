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

$startTime = microtime(true); //начало таймера

define($PATH_INFO, dirname('_FILE_')); //определяет константу для корневой дирректории
$iskomoye = $_POST['search']; //переменная, которая вводится в поле поиска
$search = "ключ".$iskomoye;  //изменить текстовую часть ключа можно тут
$filename = $PATH_INFO.'newkey.txt'; //изменить имя файла можно тут

$file = new SplFileObject($filename);//создаём объект файла
	$start = 0; //задаем начало поиска
	$file->seek($file->getSize());
	$end = $file->key(); // определяем конец поиска
	//echo $end . "строк"."<br>"; //проверка количества строк в файле
	$file->seek(0);
	$string=$file->current();
	$key = stristr($string, "\t", true); //начальное значение переменной бинарного поиска присваиваем ключу первой строки файла
	//echo $key.'<br>'; //проверка начального ключа
	
while (strnatcmp($search, $key) !==0&&($end>$start+1)) {  //цикл продолжается пока значение поиска не совпадёт с ключём, либо пока разница между верхней и нижней границей не станет равна 1 
    $middle = round(($end+$start)/2); //определяем середину и округляем
    $file->seek($middle);
    $string = $file->current();  
    $key = stristr($string, "\t", true); // возвращаем ключ из  текущей строки
    (strnatcmp($search, $key) < 0)?$end = $middle:$start = $middle;//сравниваем переменную поиска с заданным ключом, и в зависимости от рез-та сравнения изменяем или нижнюю или верхнюю границу
	//echo $key . "<br>";    //проверерка текцщего значения ключа
}

if (strnatcmp($search, $key)!==0||$iskomoye ==0) { //если ключ не совпал с переменной поиска, или переменная поиска равна нулю
	$value = 'undef';	  // искомое значение равно undef
} else {
	$value = stristr($string, "\t"); 
}

echo "Вы ввели: ".$iskomoye.'<br>';	
echo "Искомое значение в файле: ". $value.'<br>';

 
 echo "Памяти использовано: ";
 require('memory.php');
 $time = microtime(true) - $startTime;
 echo "Время выполнения: ".number_format($time, 4) . "сек";

?>