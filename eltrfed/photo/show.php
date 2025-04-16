<?php
require $_SERVER['DOCUMENT_ROOT'] . "/include/top.php";
$get = $_GET['ph'];

$photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `photo` WHERE `id` = $get"));
$vehicles1 = mysqli_fetch_all(mysqli_query($conn, "SELECT vehicle_id FROM photo_vehicle WHERE `photo_id` = $get"), MYSQLI_ASSOC);


if (!empty($vehicles1)) {
    $vehicle_ids_string = implode(',', array_column($vehicles1, 'vehicle_id'));
    $vehicles2 = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM vehicles WHERE `veh_id` IN ($vehicle_ids_string)"), MYSQLI_ASSOC);
} else {
    $vehicles2 = []; 
}


if(isset($photo)){
    echo '<div class="button mb-10"><i class="fa fa-link" aria-hidden="true"></i><a href="makecon.php?ph='.$get.'"> Связать фото с Т\С</a></div> <div class="button mb-10"><i class="fa fa-pencil" aria-hidden="true"></i><a href="edit.php?id='.$get.'"> Редактировать информацию о фото</a></div>';
    echo '<div class="center"><img src="img/' . $photo['file_name'] . '" height="800"></div>';
    echo '<table align="center"><tr><td width="30%">';

    echo '<table class="photo_full_table">';
        echo '<tr><th colspan="2"><hr>' . $photo['text'] . '<hr></th></tr>';
        echo '<tr><th class="textright">id фото<hr></th><td>' . $get . '<hr></td></tr>';
        echo '<tr><th class="textright">Дата фото<hr></th><td>'.$photo['date'].'<hr></td></tr>';
    echo '</table></td><td width="30%">';
    foreach($vehicles2 as $veh){
        echo '<table class="photo_full_table left-50">';
            echo '<tr><th colspan="2"><hr><a href="/vehicles/full.php?id=' . $veh['veh_id'] . '">' . model($veh['veh_model']) . " " . number($veh['veh_num1'], $veh['veh_num2'])  . '</a><hr></th></tr>';
            echo '<tr><th class="textright">Депо<hr></th><td>' . depot_full($veh['veh_depot']) . '<hr></td></tr>';
            echo '<tr><th class="textright">Состояние<hr></th><td>' . condition3($veh['veh_condition']) . '<hr></td></tr>';
        echo '</table>';
    }
    echo '</td><td width="30%">';
    foreach($routes as $route){
        echo '<table class="photo_full_table left-50">';
            echo '<tr><th colspan="2"><hr><a href="/routes/full.php?id=' . $route['id'] . '"> Маршрут' .' № ' . '</a><hr></th></tr>';
            echo '<tr><th class="textright">Депо<hr></th><td>' . depot_full($veh['veh_depot']) . '<hr></td></tr>';
            echo '<tr><th class="textright">Статус<hr></th><td>' . condition3($veh['veh_condition']) . '<hr></td></tr>';
        echo '</table>';
    }
    echo '</td></tr>';


















}
else{
    echo "<strong>Фото не выбрано.<strong>";
}

?>
<br><br>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>