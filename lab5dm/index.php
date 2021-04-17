<?php

/**
* @param $arr
* Функция validate проверяет матрицу на то, что она состоит из 0 и 1, а также, что матрица квадратная
* return $err
*/
function validate($arr) {
    for ($i=0; $i < count($arr); $i++) {
        for ($j = 0; $j < count($arr); $j++) {
            if ($arr[$i][$j] != 0 && $arr[$i][$j] != 1)  {
                return $err = "Некорректный ввод матрицы";
            }
        }
    }
}

/**
* @param $arr
* Функция проверяет, возможен ли путь в вершину. Если да, то изменит 0 на 1. Используется метод Уоршелла
* return $arr
*/
function search_path_true($arr) {
    for ($k = 0; $k < count($arr); $k++) {
        for ($i = 0; $i < count($arr); $i++) {
            for ($j = 0; $j < count($arr); $j++) {
                if ($arr[$i][$j] == 0 && $arr[$k][$j] == 1 && $arr[$i][$k] == 1) {
                    $arr[$i][$j] = 1;
                }
            }
        }
    }
    // var_dump($arr);
    return $arr;
}

/**
* @param $arr
* Функция выводит матрицу на экран пользователя
*/
function out_mat($arr) {
    $out = "Ответ<br>";
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 0; $j < count($arr); $j++) {
            $out = $out.$arr[$i][$j];
        }
        $out = $out."<br>";
    }
    echo $out;
}


if (isset($_POST["sbm"])) {
    $mat_in = $_POST["m"];
    $mat_in = explode("\n", $mat_in);
    if($mat_in[0] == "") {
        $err = "Поле пустое";
    }
    for ($i = 0; $i < count($mat_in); $i++) {
        $mat_in[$i] = explode(" ", $mat_in[$i]);
    }
    $err = $err.validate($mat_in);
    if (empty($err)) {
        $mat_in = search_path_true($mat_in);
        out_mat($mat_in);
    } else {
        echo $err;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Логическая матрица</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Введите матрицу</h2>
        <textarea type="text" name="m" rows="6"><?php echo @$_POST["m"]; ?></textarea>
        <input type="submit" name="sbm" value="Обработать">
    </form>
</body>
</html>