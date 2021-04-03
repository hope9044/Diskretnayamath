<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Lab3</title>
    
</head>
<body> 
Формат ввода:
<li>Элементы в множествах вводятся через запятую</li><br>
Пример:<br>
"1,2,3"

<li>Элементы в отношении вводятся через запятую, между парами элементов ставится точка с запятой </li><br>
Пример:<br>
"1,4;5,2;3,6"
<br> Пример для проверки отношения
<li>Первое множество:"1,2,3" </li>
<li>Второе множество:"4,5,6" </li>
<li>Отношение:"1,4;5,2;3,6" </li>
<br> Пример для проверки отношения
<li>Первое множество:"a,b,c" </li>
<li>Второе множество:"d,e,f" </li>
<li>Отношение:"a,d;b,e;c,f" </li>

    <form action="" method="post">
        <h3>Первое множество</h3>
        <input type="text" name="arr1"  value="<?php echo $_POST["arr1"]; ?>" placeholder = "Введите 1-е мн-во">
        <h3>Второе множество</h3>
        <input type="text" name="arr2" value="<?php echo $_POST["arr2"]; ?>" placeholder = "Введите 2-е мн-во">
        <h3>Отношение</h3>
        <input type="text" name="arr3" value="<?php echo $_POST["arr3"]; ?>" placeholder = "Введите отношение">
        <input type="submit" name="access">
        <div><?php
		/**
			* Функция для валидации введённых значений
			*
			* Функция удаляет пустые и повторяющиеся элементы метод array_unique() чистит массив от 
			повторяющихся элементов array_diff() удаляет пустые элементы, цикл проходится по массив и удаляет элементы < 0 и > 9
			*
			* @param arr - введённые пользователем значения 
			*
			* @return arrF, возвращает обработанный массив
			*
			*/

		function Validate($arr){
				
			$UsmassV = array_unique($arr);
			$arrF = array_diff($UsmassV, array(''));
			for($i = 0; $i < count($arrF); $i++){
				if (($arrF[$i] < 0) || ($arrF[$i] > 9)){
					echo ("Ошибка в " . ($i+1) . " элементе  <br/>" );
					
				}
			}
			return $arrF;
		}
		/**
			* Фeнкция для проверки принадлежности элементов отношения к множествам
			*
			* Проверяется, принадлежат ли оба множества отношению
			*
			* @param A первое множество, B второе множество, C отношение
			*
			* @return true, если отношение верно, false, если не верно
			*
			*/
		function check($A, $B, $C) {
			for ($i = 0; $i < count($C); $i++) {
				for ($j = 0; $j < count($C[$i]); $j++) {
					if ($C[$i][$j] == $A[$i] || $C[$i][$j] == $B[$i]) {
						return true;
					} 
					else {
						return false;
						echo ("В отношении присутствует элемент, которого нет в множествах<br>");
						die();
					}
				}
			}
		
		};
		/**
			* Функция для проверки, является ли отношение функцией
			* 
			* Функция проверяет множество с введёными отношениями на наличие элементов из массива А и массива В
			*
			* @param A первое множество, B второе множество, C отношение
			*
			* @return true если отношение - функция, false если отношение не функция
			*
			*/
		function MainCheck($A, $B, $C) {
			$flag = true;
			for ($i = 0; $i < count($A); $i++) {
				for ($j = 0; $j < count($A); $j++) {
					if ((in_array($C[$i][0], $B) && in_array($C[$i][1], $A)) || (in_array($C[$i][0], $A) && in_array($C[$i][1], $B))) {
						continue;
					}
					else {
						echo ("Ошибка в отношении, в элементе ".($i+1)." Отношение не является функцией!<br>");
						die();
						$flag = false;
					}
				}              
			}
        return $flag;
		};
		/**
			*Основное тело программы
			*
			*метод explode() позволяет разделять массив по пробелам или другим знакам
			*
			*здесь вызываются все необходимые программе функции
		*/
		if (isset($_POST["access"])){
			$Usmass = explode(",", $_POST["arr1"]);
			$Usmass2 = explode(",", $_POST["arr2"]);
			$Usmass3  = explode(";", $_POST["arr3"]);
			
			$Mass1 = Validate($Usmass);
			$Mass2 = Validate($Usmass2);
			$Mass3 = Validate($Usmass3);
			for($i = 0; $i < count($Mass3); $i++){
				$Mass3[$i] = explode (",", $Mass3[$i]);
			}
			
			if(check($Mass1, $Mass2, $Mass3)){
				if (MainCheck($Mass1, $Mass2, $Mass3)){
					echo("Отношение является функцией!");
				}
                else {
                    echo("Отношение не является функцией!");
                }
				
			};
			
		}
		
		?> 
		</div>
    </form>
</body>
</html>
