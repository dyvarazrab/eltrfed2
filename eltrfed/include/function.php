<?php
require 'database/link.php';

function condition($a){
    if($a == 1){
        echo "<tr style=\"background-color: white\">";
    }
    if($a == 2){
        echo "<tr style=\"background-color: yellow\">";
    }
    if($a == 3){
        echo "<tr style=\"background-color: green\">";
    }
    if($a == 4){
        echo "<tr style=\"background-color: red\">";
    }
    if($a == 5){
        echo "<tr style=\"background-color: grey\">";
    }
    if($a == 6){
        echo "<tr style=\"background-color: #d77d31\">";
    }
    if($a == 7){
        echo "<tr style=\"background-color: #42aaff\">";
    }
    if($a == 8){
        echo "<tr style=\"background-color: #800080\">";
    }
    if($a == 9){
        echo "<tr style=\"background-color: blue\">";
    }
}
function condition2($a){
    if($a == 1){
        echo "<td>Эксплуатируется</td>";
    }
    if($a == 2){
        echo "<td>Не эксплуатируется</td>";
    }
    if($a == 3){
        echo "<td>Не эксплуатировался</td>";
    }
    if($a == 4){
        echo "<td>Списан</td>";
    }
    if($a == 5){
        echo "<td>Отставлен от эксплуатации</td>";
    }
    if($a == 6){
        echo "<td>Судьба неизвестна</td>";
    }
    if($a == 7){
        echo "<td>Модернизирован</td>";
    }
    if($a == 8){
        echo "<td>Передан</td>";
    }
    if($a == 9){
        echo "<td>Перенумерован</td>";
    }
}
function condition3($a){
    if($a == 1){
        return "<span style=\"background-color: white\">Эксплуатируется</span>";
    }
    if($a == 2){
        return "<span style=\"background-color: yellow\">Не эксплуатируется</span>";
    }
    if($a == 3){
        return "<span style=\"background-color: green\">Не эксплуатировался</span>";
    }
    if($a == 4){
        return "<span style=\"background-color: red\">Списан</span>";
    }
    if($a == 5){
        return "<span style=\"background-color: grey\">Отставлен от эксплуатации</span>";
    }
    if($a == 6){
        return "<span style=\"background-color: #d77d31\">Судьба неизвестна</span>";
    }
    if($a == 7){
        return "<span style=\"background-color: #42aaff\">Модернизирован</span>";
    }
    if($a == 8){
        return "<span style=\"background-color: #800080\">Передан</span>";
    }
    if($a == 9){
        return "<span style=\"background-color: blue\">Перенумерован</span>";
    }
}
function checkPost($a){
    if(isset($a)){
        return NULL;
    }
    else{
        return $a;
    }
}
function locations_all($locations_all){
    foreach($locations_all as $location){
        echo '<option value="' . $location['id'] . '">' . $location['name'] . '</option>';
    }
}
function conditions($a){
    foreach($a as $b){
        echo '<option value="' . $b['cond_id'] . '">' . $b['cond_name'] . '</option>';
    }
}
function n($a){
    if($a == null || $a == "NULL")
    {
        return "NULL";
    }
    else{
        return "'".$a."'";
    }
}
function depot_short($a){
    $sql = "SELECT * FROM `depots` WHERE `depot_id` = $a";
    global $conn;
    $depot = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $depot['depot_name_short'];
}
function depot_full($a){
    $sql = "SELECT * FROM `depots` WHERE `depot_id` = $a";
    global $conn;
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    // if (!$result) {
    //     die('Ошибка выполнения запроса: ' . mysqli_error($conn));
    // }
    
    $depot = mysqli_fetch_assoc($result);
    return $depot['depot_name_full'];
}
function model($a){
    $sql = "SELECT * FROM `models` WHERE `model_id` = $a";
    global $conn;
    $model = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $model['model_name'];
}
function dtd($a){
    if(isset($a)){
        if(strlen($a) == 4){
            return $a;
        }
        if(strlen($a) == 1){
            return '0' . $a . '.';
        }
        if(strlen($a) == 2){
            return $a . '.';
        }
    }
    else{
        return ' ';
    }

}
function dtd2($a){
    if(!empty($a)){
    list($year, $month, $day) = explode('-', $a);
    return $day . "." . $month . "." . $year;
    }
    else{
        return '&#8194;';
    }
}
function number($a, $b){
    if($a !== '-' && (empty($b) || $b == NULL)){
        return "№ " . $a; // Изменено с $veh_num1 на $a
    }
    if(($a == '-' || $a == NULL) && isset($b)){
        return "г\н " . $b;
    }
    if(($a !== '-' || NULL) && isset($b)){
        return "№ " . $a . '(г\н ' . $b . ')';
    }
}
function type($a){
    $sql = "SELECT * FROM `types` WHERE `type_id` = $a";
    global $conn;
    $type = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $type['type_name'];
}
function checked($a, $b){
    if($a == $b){
        return 'selected';
    }
}
function conditions2($a, $c){
    foreach($a as $b){
        echo '<option value="' . $b['cond_id'] . '"' . checked($b['cond_id'], $c) . '>' . $b['cond_name'] . '</option>';
    }
}
function merge($a, $b){
    if(strlen($a) !== 0 && strlen($b) !== 0){
        return $a . ',' . $b;
    }
    if(strlen($a) !== 0 && strlen($b) == 0){
        return $a;
    }
    if(strlen($a) == 0 && strlen($b) !== 0){
        return $b;
    }
    if(strlen($a) == 0 && strlen($b) == 0){
        
    }
}
function n1($a){
    if(empty($a)){}
    else{
        return ','.$a;
    }
}
function linkModel($a){
    if('/models/full.php?id='.$a['model_id'] !== $_SERVER['REQUEST_URI']){
        // echo '<pre>' . print_r($a) . '</pre>';
        return '<a href="/models/full.php?id=' . $a['model_id'] . '">' . $a['model_name'] . '</a>';      
    }
    else{
        return '<strong>' . $a['model_name'] . '</strong>';
    }
}
function location($a){
    $sql = "SELECT * FROM `locations` WHERE `id` = $a";
    global $conn;
    $location = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $location['name'];
}
function stop($a){
    $sql = "SELECT * FROM `stops` WHERE `stop_id` = $a";
    global $conn;
    $stop = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $stop['stop_name'];
}
function boolv($a){
    if($a == 1){
        return "Да";
    }
    else{
        return "Нет";
    }
}