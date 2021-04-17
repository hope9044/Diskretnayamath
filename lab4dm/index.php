<?php
/**
 * @param $arr
 * Функция исправляет диагональные элементы матрицы на 0, чтобы исправить ошибку пользователя в построении матрицы
 * return $arr
 */
function validateDiagElement($arr) {
    for ($i=0; $i < count($arr[$i]); $i++) {
        $arr[$i][$i] = 0; 
    }
    return $arr; 
}

/**
 * @param $arr
 * Функция проверяет матрицу на размерность x * x
 * return $s
 */
function validate($arr) {
    $lenght_matrix = count($arr[0]);
    $cnt = 0;
    for ($i = 0; $i < count($arr); $i++) {
        $cnt += count($arr[$i]);
    }
    if (($lenght_matrix * $lenght_matrix) != $cnt) {
        return $s = "Ошибка в матрице (не x * x)";
    }
}

/**
* @param $arr
* @param $n
* Функция search_path находит кратчайший путь по методу Флойда-Уоршелла, проверяя, короче ли путь через соседнюю вершину прямого пути или нет
* return arr
*/
function search_path($arr, $n) {
    for ($k = 0; $k < $n; $k++) {
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i != $j && $arr[$i][$k] && $arr[$k][$j]) {
                    if (($arr[$i][$k] + $arr[$k][$j] < $arr[$i][$j]) || $arr[$i][$j] == 0) {
                        $arr[$i][$j] = $arr[$i][$k] + $arr[$k][$j];
                    }    
                }
            }
        }
    }
    return $arr;
};

/**
* @param $arr
* @param $verh_gr
* Функция mOut выводит перезаписанную матрицу с найдеными путями
* return $text
*/
function mOut($arr, $n) {
    $text = null;
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            $text = $text.$arr[$i][$j]." ";
        }
        $text = $text."<br>";
    }
    return $text;
}


ini_set('display_errors','Off');
if(isset($_POST["access"])) {

    $verh_gr = htmlspecialchars($_POST["graphVerh"]);
    if(empty($verh_gr)) {
        $err = "<div>Введите количество вершин</div>";
    }

    $graph = explode("\n", $_POST["m"]);
    if($graph[0] == "") {
        $err = "Введите матрицу";
    }

    for ($i = 0; $i < count($graph); $i++) {
        $graph[$i] = explode(" ", $graph[$i]);
    }
    $graph = validateDiagElement($graph);
    $err = $err.validate($graph);
    if (empty($err)) {
        $return_graph = search_path($graph, $verh_gr);
        $text = mOut($return_graph, $verh_gr);
        echo "<div>Матрица<br>".$text."</div>";
    } else {
        echo "<div>".$err."</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Матрица Флойда-Уоршелла</title>
</head>
<body>
    <form action="" method="POST">
        <h3>Сколько вершин?</h3>
        <input type="text" name="graphVerh" value="<?php echo $_POST["graphVerh"]; ?>" placeholder="Введите кол-во вершин">
        <h3>Вес рёбер в матрице</h3>
        <textarea name="m" rows="5" cols="10"><?php echo $_POST["m"]; ?></textarea>
        <input type="submit" name="access" value="Обработать">
    </form>
</body>
</html>