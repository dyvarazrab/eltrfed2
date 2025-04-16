<?php
$title = "Создать т\с";
require '../include/top.php';



$veh_model = $_POST['veh_model'];
$veh_num1 = $_POST['veh_num1'];
$veh_num2 = $_POST['veh_num2'];
$veh_month_created = $_POST['veh_month_created'];
$veh_year_created = $_POST['veh_year_created'];
$veh_factory_num = $_POST['veh_factory_num'];
$veh_vin = $_POST['veh_vin'];
$veh_parent = $_POST['veh_parent'];
$veh_start_operate_day  = $_POST['veh_start_operate_day'];
$veh_start_operate_month = $_POST['veh_start_operate_month'];
$veh_start_operate_year = $_POST['veh_start_operate_year'];
$veh_end_operate_day  = $_POST['veh_end_operate_day'];
$veh_end_operate_month  = $_POST['veh_end_operate_month'];
$veh_end_operate_year  = $_POST['veh_end_operate_year'];
$veh_condition  = $_POST['veh_condition'];
$veh_depot = $_POST['veh_depot'];
$veh_note_full  = $_POST['veh_note_full'];
$veh_note_short  = $_POST['veh_note_short'];
$veh_route  = $_POST['veh_route'];

$sql = "INSERT INTO `vehicles` (`veh_id`, `veh_model`, `veh_num1`, `veh_num2`, `veh_month_created`, `veh_year_created`,
`veh_factory_num`, `veh_vin`, `veh_parent`, `veh_start_operate_day`, `veh_start_operate_month`, 
`veh_start_operate_year`, `veh_end_operate_day`, `veh_end_operate_month`, `veh_end_operate_year`, 
`veh_condition`, `veh_depot`, `veh_note_full`, `veh_note_short`, `veh_route`, `date_create`, `date_update`) 
VALUES (NULL, '$veh_model', '$veh_num1', " . n($veh_num2) . ", " . n($veh_month_created) . ", " . n($veh_year_created) . ", ".
$veh_factory_num . ", " . n($veh_vin) . ", " . n($veh_parent) . ", " . n($veh_start_operate_day) . ",  " . n($veh_start_operate_month). ", " . 
n($veh_start_operate_year) . ",  " . n($veh_end_operate_day) .", " . n($veh_end_operate_month).",  " . n($veh_end_operate_year) .", '$veh_condition', 
'$veh_depot',  " . n($veh_note_full) . ",  " . n($veh_note_short) . ",  " . n($veh_route) .", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";


if($_POST !== 0){
    mysqli_query($conn, $sql);
}   





?>



<h2>Создать т\с</h2>
<div style="width: 30%">
    <table class="table_full">
    <form method="post">
    <tr><th style="padding-top: 10px">Модель<hr></th><td style="padding-top: 10px"><select name="veh_model"><?foreach($models as $model): ?><option value="<?=$model['model_id']?>"><?=$model['model_name']?></option><? endforeach; ?></select><hr></td></tr>
    <tr><th>Бортномер<hr></th><td><input type="text" name="veh_num1" required placeholder="Бортномер"><hr></td></tr>
    <tr><th>Госномер<hr></th><td><input type="text" name="veh_num2" placeholder="Госномер (при наличии)"><hr></td></tr>
    <tr><th>Выпущен<hr></th><td><input type="number" min="1" max="12" name="veh_month_created" placeholder="месяц" style="width: 60px; border: none;" min="1" max="12">. <input type="number" name="veh_year_created" placeholder="год" style="width: 60px; border: none;"><hr></td></tr>
    <tr><th>Заводской номер<hr></th><td><input type="number" name="veh_factory_num" placeholder="Только цифры" required ><hr></td></tr>
    <tr><th>VIN<hr></th><td><input type="text" name="veh_vin" placeholder="VIN-код"><hr></td></tr>
    <tr><th>Родительское т\с<hr></th><td><input type="number" name="veh_parent" placeholder="ID родительского т\с"><hr></td></tr>
    <tr><th>С<hr></th><td><input type="number" name="veh_start_operate_day" placeholder="число" style="width: 55px; border: none;" min="1" max="31">. <input type="number" min="1" max="12" name="veh_start_operate_month" placeholder="месяц" style="width: 60px; border: none;" min="1870" max="2024">. <input type="number" name="veh_start_operate_year" placeholder="год" style="width: 60px; border: none;"><hr></td></tr>
    <tr><th>По<hr></th><td><input type="number" name="veh_end_operate_day" placeholder="число" style="width: 55px; border: none;" min="1" max="31">. <input type="number" name="veh_end_operate_month" placeholder="месяц" style="width: 60px; border: none;" min="1" max="12">. <input type="number" name="veh_end_operate_year" placeholder="год" style="width: 60px; border: none;" min="1870" max="2024"><hr></td></tr>
    <tr><th>Состояние<hr></th><td><select name="veh_condition"><? conditions($conditions) ?></select><hr></td></tr>
    <tr><th>Депо<hr></th><td><select name="veh_depot"><? foreach($depots as $depot): ?><option class="c" value="<?=$depot['depot_id']?>"><?=$depot['depot_name_short']?></option><? endforeach; ?></select><hr></td></tr>
    <tr><th>Полное описание<hr></th><td><input type="text" name="veh_note_full" placeholder="Описание для профиля т\с" height="50px"><hr></td></tr>
    <tr><th>Краткое описание<hr></th><td><input type="text" name="veh_note_short" placeholder="Описание для общего списка т\с"><hr></td></tr>
    <tr><th>Закрепление<hr></th><td><input type="number" name="veh_route" placeholder="ID маршрута"><hr></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit" value="Отправить">Отправить</button></div></th></tr>

</form>
</table>
    </div>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>

