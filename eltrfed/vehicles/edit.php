<?php
$id = $_GET['id'];
require '../include/top.php';

$veh = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vehicles` WHERE `veh_id` = $id")); // получаем само т\с
$model = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `models` WHERE `model_id` = {$veh['veh_model']}")); // получаем само т\с
$type = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `types` WHERE `type_id` = {$model['model_type']}")); // получаем тип модели

if(!empty($_POST)){
    $sql="UPDATE `vehicles` SET `veh_model` = '{$_POST['veh_model']}', `veh_num1` = '{$_POST['veh_num1']}', `veh_num2` = '{$_POST['veh_num2']}',
    `veh_month_created` = ". n($_POST['veh_month_created']) .", `veh_year_created` = ". n($_POST['veh_year_created']) .", `veh_factory_num` = '{$_POST['veh_factory_num']}',
    `veh_vin` = '{$_POST['veh_vin']}', `veh_parent` = ".n($_POST['veh_parent']).", `veh_start_operate_day` = ".n($_POST['veh_start_operate_day']) .",
    `veh_start_operate_month` = ".n($_POST['veh_start_operate_month']) .", `veh_start_operate_year` = ".n($_POST['veh_start_operate_year']) .", 
    `veh_end_operate_day` = ".n($_POST['veh_end_operate_day']) .", `veh_end_operate_month` = ".n($_POST['veh_end_operate_month']) .", 
    `veh_end_operate_year` = ".n($_POST['veh_end_operate_year']) .", `veh_condition` = ".n($_POST['veh_condition']) .", `veh_depot` = ".n($_POST['veh_depot']) .", 
    `veh_note_full` = ".n($_POST['veh_note_full']) .", `veh_note_short` = ".n($_POST['veh_note_short']) .", `veh_route` = ".n($_POST['veh_route']) .", 
    `date_update` = CURRENT_TIMESTAMP WHERE `veh_id` = $id";
    mysqli_query($conn, $sql);
    header('Location: /vehicles/');
}

?>

<title>Редактировать <?=$type['type_name'] . ' ' . number($veh['veh_num1'], $veh['veh_num2'])?></title>
<h2>Редактировать <?=$type['type_name'] . ' ' . number($veh['veh_num1'], $veh['veh_num2'])?></h2>
<div style="width: 30%">
    <table class="table_full">
    <form method="post">
    <tr><th style="padding-top: 10px">Модель<hr></th><td style="padding-top: 10px"><select name="veh_model"><?foreach($models as $model): ?><option value="<?=$model['model_id']?>" <?=checked($model['model_id'], $veh['veh_model'])?>><?=$model['model_name']?></option><? endforeach; ?></select><hr></td></tr>
    <tr><th>Бортномер<hr></th><td><input type="text" name="veh_num1" placeholder="Бортномер" value="<?=$veh['veh_num1']?>"><hr></td></tr>
    <tr><th>Госномер<hr></th><td><input type="text" name="veh_num2" placeholder="Госномер (при наличии)" value="<?=$veh['veh_num2']?>"><hr></td></tr>
    <tr><th>Выпущен<hr></th><td><input type="number" min="1" max="12" name="veh_month_created" placeholder="месяц" style="width: 60px; border: none;" min="1" max="12" value="<?=$veh['veh_month_created']?>">. <input type="number" name="veh_year_created" placeholder="год" style="width: 60px; border: none;" value="<?=$veh['veh_year_created']?>"><hr></td></tr>
    <tr><th>Заводской номер<hr></th><td><input type="number" name="veh_factory_num" placeholder="Только цифры" required value="<?=$veh['veh_factory_num']?>" ><hr></td></tr>
    <tr><th>VIN<hr></th><td><input type="text" name="veh_vin" placeholder="VIN-код" value="<?=$veh['veh_vin']?>"><hr></td></tr>
    <!-- <tr><th>Родительское т\с<hr></th><td><input type="number" name="veh_parent" placeholder="ID родительского т\с" value="<?=$veh['veh_parent']?>"><hr></td></tr> -->
    <tr><th>С<hr></th><td><input type="number" name="veh_start_operate_day" placeholder="число" style="width: 55px; border: none;" min="1" max="31" value="<?=$veh['veh_start_operate_day']?>">. <input type="number" min="1" max="12" name="veh_start_operate_month" placeholder="месяц" style="width: 60px; border: none;" min="1870" max="2024" value="<?=$veh['veh_start_operate_month']?>">. <input type="number" name="veh_start_operate_year" placeholder="год" style="width: 60px; border: none;" value="<?=$veh['veh_start_operate_year']?>"><hr></td></tr>
    <tr><th>По<hr></th><td><input type="number" name="veh_end_operate_day" placeholder="число" style="width: 55px; border: none;" min="1" max="31" value="<?=$veh['veh_end_operate_day']?>">. <input type="number" name="veh_end_operate_month" placeholder="месяц" style="width: 60px; border: none;" min="1" max="12" value="<?=$veh['veh_end_operate_month']?>">. <input type="number" name="veh_end_operate_year" placeholder="год" style="width: 60px; border: none;" min="1870" max="2024" value="<?=$veh['veh_end_operate_year']?>"><hr></td></tr>
    <tr><th>Состояние<hr></th><td><select name="veh_condition"><? conditions2($conditions, $veh['veh_condition']) ?></select><hr></td></tr>
    <tr><th>Депо<hr></th><td><select name="veh_depot"><? foreach($depots as $depot): ?><option class="c" value="<?=$depot['depot_id']?>" <?=checked($depot['depot_id'], $veh['veh_depot'])?>><?=$depot['depot_name_short']?></option><? endforeach; ?></select><hr></td></tr>
    <tr><th>Полное описание<hr></th><td><input type="text" name="veh_note_full" placeholder="Описание для профиля т\с" height="50px" value="<?=$veh['veh_note_full']?>"><hr></td></tr>
    <tr><th>Краткое описание<hr></th><td><input type="text" name="veh_note_short" placeholder="Описание для общего списка т\с" value="<?=$veh['veh_note_short']?>"><hr></td></tr>
    <tr><th>Закрепление<hr></th><td><input type="number" name="veh_route" placeholder="ID маршрута" value="<?=$veh['veh_route']?>"><hr></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit">Сохранить</button></div></th></tr>

</form>
</table>
    </div>