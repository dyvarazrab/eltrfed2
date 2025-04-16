<?php
$id = $_GET['id'];
require '../include/top.php';

// Получаем информацию о транспортном средстве
$vehicle = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vehicles` WHERE `veh_id` = $id"));
$vehicle_depot = $vehicle['veh_depot'];
$depot = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `depots` WHERE `depot_id` = $vehicle_depot"));
$veh_model = $vehicle['veh_model'];
$model = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `models` WHERE `model_id` = $veh_model"));
$veh_cond = $vehicle['veh_condition'];
$cond = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `conditions` WHERE `cond_id` = $veh_cond"));
$veh_route = $vehicle['veh_route'];
if (isset($veh_route)) {
    $route = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `routes` WHERE `id` = $veh_route"));
}
$vehicle_type = $model['model_type'];
$loc_depot = $depot['depot_location'];
$loc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `locations` WHERE `id` = $loc_depot"));

// Получаем фотографии
$photos1 = mysqli_fetch_all(mysqli_query($conn, "SELECT `photo_id` FROM `photo_vehicle` WHERE `vehicle_id` = $id"), MYSQLI_ASSOC);
$photos_ids = array_column($photos1, 'photo_id');

if (!empty($photos_ids)) {
    $photos_ids_string = implode(',', $photos_ids);
    $photos2 = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM photo WHERE `id` IN ($photos_ids_string)"), MYSQLI_ASSOC);
} else {
    $photos2 = []; 
}


?>
<title><?=$model['model_name'] . " № " . number($vehicle['veh_num1'], $vehicle['veh_num2'])?></title>
<div class="button"><i class="fa fa-link" aria-hidden="true"></i><a href="/photo/makecon.php?veh=<?=$id?>"> Привязать фото к этому Т\С</a></div>
<div class="button"><i class="fa fa-link" aria-hidden="true"></i><a href="edit.php?id=<?=$id?>"> Редактировать Т\С</a></div>
<h1><?=$loc['name']?>, <?=type($model['model_type']) . ' ' . number($vehicle['veh_num1'], $vehicle['veh_num2']) ?></h1>

<table><tr><td width="30%">
<table class="veh_full_table">
    <tr><th class="textright"><hr>id<hr></th><td><hr><?=$id?><hr></td></tr>
    <tr><th class="textright">Модель<hr></th><td><a class="standart" href="/models/full.php?id=<?=$model['model_id']?>"><?=$model['model_name']?></a><hr></td></tr>
    <tr><th class="textright">Борт<hr></th><td><?=number($vehicle['veh_num1'], $vehicle['veh_num2'])?><hr></td></tr>
    <tr><th class="textright">Выпущен<hr></th><td><?=dtd($vehicle['veh_month_created']).dtd($vehicle['veh_year_created'])?><hr></td></tr>
    <tr><th class="textright">Заводской номер<hr></th><td><?=$vehicle['veh_factory_num']?><hr></td></tr>
    <tr><th class="textright">VIN<hr></th><td><?=$vehicle['veh_vin']?><hr></td></tr>
    <!-- <tr><th class="textright">Родительское т\с<hr></th><td><?=$vehicle['veh_parent']?><hr></td></tr> -->
    <tr><th class="textright">С<hr></th><td><?=dtd($vehicle['veh_start_operate_day']).dtd($vehicle['veh_start_operate_month']).dtd($vehicle['veh_start_operate_year'])?><hr></td></tr>
    <tr><th class="textright">По<hr></th><td><?=dtd($vehicle['veh_end_operate_day']).dtd($vehicle['veh_end_operate_month']).dtd($vehicle['veh_end_operate_year'])?><hr></td></tr>
    <tr><th class="textright">Состояние<hr></th><td><span class="c<?=$veh_cond?>"><?=$cond['cond_name']?></span><hr></td></tr>
    <tr><th class="textright">Депо<hr></th><td><?=$depot['depot_name_full']?><hr></td></tr>
    <tr><th class="textright">Описание<hr></th><td><?=$vehicle['veh_note_full']?><hr></td></tr>
    <tr><th class="textright">Закрепление<hr></th><td><?=$route['num'] . ' "' . $route['start_stop'] . ' - ' . $route['last_stop'] . '"'?><hr></td></tr>
</table></td>
<td>
<table class="photo">
<tr><td colspan="2"><strong><? echo empty($photos2) ? 'Фотографий с этим Т\С нет.' : 'Фотографии с этим Т\С:';?></strong></td></tr>
    <?php 
    $a = 1;
    foreach($photos2 as $photo){
        if(($a % 2) == 1){
            echo '<tr><td><a href="/photo/show.php?ph='.$photo['id'].'"><img src="/photo/img/'.$photo['file_name'].'" height="150"><br/>'.$photo['text'].'</a></td>';
        }
        if(($a % 2) == 0){
            echo '<td><a href="/photo/show.php?ph='.$photo['id'].'"><img src="/photo/img/'.$photo['file_name'].'" height="150"><br/>'.$photo['text'].'</a></td></tr>';
        }
        $a++;
    }
?>
</table>
</td>
<td></td>
</tr></table>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>