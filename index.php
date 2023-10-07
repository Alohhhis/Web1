<?php
session_start();
$start_time = microtime(true);
$x = $_POST['x'];
$y = $_POST['yCoord'];
if (!is_numeric($y[-1])){
    $y = substr($y, 0, -1);
}
$r = $_POST['Radius'];
// координаты вершин треугольника
$x1 = 0;
$y1 = 0;
$x2 = 0;
$y2 = -$r/2;
$x3 = $r;
$y3 = 0;

// вычисление расстояний от точки до вершин треугольника
$d1 = sqrt(($x - $x1) ** 2 + ($y - $y1) ** 2);
$d2 = sqrt(($x - $x2) ** 2 + ($y - $y2) ** 2);
$d3 = sqrt(($x - $x3) ** 2 + ($y - $y3) ** 2);

$current_time = date("Y-m-d H:i:s");

function checkPoint($x, $y, $r){
    global $d1, $d2, $d3;
    if (($x >= - $r) && ($x <= 0) && ($y <= 0) && ($y >= $r/2)){
        return "убил";
    }elseif(($x <=  $r) && ($x >= 0) && ($y >=  -$r/2) && ($y <= 0) && ($d1 <= $r || $d2 <= $r || $d3 <= $r)){
        return "убил";
    } elseif(($x >= 0) && ($y >= 0) && (pow($x, 2) + pow($y, 2) <= pow($r, 2))){
        return "убил";
    } else{
        return "мимо";
    }
}
function validateX($x){
    $X_values = array (-5,-4,-3,-2,-1,0,1,2,3);
    if (!isset($x) || !is_numeric($x)){
        return false;
    }
    return in_array($x, $X_values);
}

function validateY($y){
    $Y_MIN = -3;
    $Y_MAX = 5;
    if (!isset($y)){
      return false;
    }
    $numY = str_replace(',', '.', $y);
    $numY = str_replace(' ', '', $numY);
    return is_numeric($numY) && $numY >= $Y_MIN && $numY <= $Y_MAX;
}

function validateR($r){
    $r_values = array (1,2,3,4,5);
    if (!isset($r) || !is_numeric($r)){
        return false;
    }
    return in_array($r, $r_values);
}



function validate($x,$y,$r){
    return validateX($x) && validateY($y) && validateR($r);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты</title>
    <link rel="stylesheet" href="result.css">
</head>
<body>

<table class="result">
    <thead>
    <tr>
        <th>X</th>
        <th>Y</th>
        <th>R</th>
        <th>Текущее время</th>
        <th>Статус</th>
        <th>Время выполнения скрипта</th>
    </tr>
    </thead>
    <tbody>

    <?php
    if (validate($x, $y, $r)){
        $result = checkPoint($x,$y,$r);
        $end_time = microtime(true);
        $_SESSION['tdata'][] = [$x, $y, $r, $current_time, $result, abs($end_time-$start_time)];
        foreach ($_SESSION['tdata'] as $data) {
            echo <<<HTML
            <tr>
                <td>$data[0]</td>
                <td>$data[1]</td>
                <td>$data[2]</td>
                <td>$data[3]</td>
                <td>$data[4]</td>
                <td>$data[5] ms</td>
            </tr>
        HTML;}
    }else{
        echo '<div>';
        echo '<p class="error">Пу пу пууууу, ломают тут чёта</p>';
        echo '<br>';
        echo '<img src="errorCat.jpg" class="error"  alt="cat"/>';
        echo '</div>';
    }
    ?>


    </tbody>
</body>
</html>
