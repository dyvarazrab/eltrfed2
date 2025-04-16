<?php
$title = "Создать маршрут";
require '../include/top.php';

$type = $_POST['type'];
$loc_id = $_POST['loc_id'];
$depot = $_POST['depot'];
$num = $_POST['num'];
$start_stop = $_POST['start_stop'];
$route = $_POST['route'];
$last_stop = $_POST['last_stop'];
$date_open = $_POST['start_operate_year'].'-'.$_POST['start_operate_month'].'-'.$_POST['start_operate_day'];
$date_update1 = $_POST['end_operate_year'].'-'.$_POST['end_operate_month'].'-'.$_POST['end_operate_day'];
$release1 = $_POST['release1'];
$note = $_POST['note'];
$inter = $_POST['inter'];
$map = $_POST['map'];
$fact = $_POST['fact'];

$sql = "INSERT INTO `routes` (`id`, `type`, `loc_id`, `depot`,
 `num`, `start_stop`, `route`,
  `last_stop`, `release1`, `fact`, `inter`, 
  `map`, `date_open`, `date_update1`, `note`,
   `date_create`, `date_update`)
    VALUES 
    (NULL, ".n($type).", ".n($loc_id).", ".n($depot).", 
    ".n($num).", ".n($start_stop).", ".n($route).",
     ".n($last_stop).", ".n($release1).", ".n($fact).", ".n($inter).",
      ".n($map).", ".n($date_open).", ".n($date_update1).", ".n($note).",
      CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
// echo $sql;


if($_POST !== 0){
    mysqli_query($conn, $sql);
}   


// var_dump($_POST);
// var_dump($sql);



?>

<h2><?=$title?></h2>
<div style="width: 30%">
    <table class="table_full">
    <form method="post">
    <tr><th style="padding-top: 10px">Тип<hr></th><td style="padding-top: 10px"><select name="type"><?foreach($types as $type): ?><option value="<?=$type['type_id']?>"><?=$type['type_name']?></option><? endforeach; ?></select><hr></td></tr>
    <tr><th>Локация маршрута<hr></th><td><select name="loc_id"><?foreach($locations as $location): ?><option value="<?=$location['id']?>"><?=$location['name']?></option><? endforeach; ?></select><hr></td></tr>
    <tr><th>Депо<hr></th><td><select name="depot"><? foreach($depots as $depot): ?><option class="c" value="<?=$depot['depot_id']?>"><?=$depot['depot_name_short']?></option><? endforeach; ?></select><hr></td></tr>
    <tr><th>Номер<hr></th><td><input type="text" name="num" required><hr></td></tr>
    <tr><th>Начальная остановка<hr></th><td><input type="text" name="start_stop" required><hr></td></tr>
    <tr><th>Маршрут<hr></th><td><input type="text" name="route" placeholder="Основные пункты" required><hr></td></tr>
    <tr><th>Конечная остановка<hr></th><td><input type="text" name="last_stop" required><hr></td></tr>
    <tr><th>План выпуска, ед.<hr></th><td><input type="number" name="release1" required><hr></td></tr>    
    <tr><th>Факт выпуска, ед.<hr></th><td><input type="number" name="fact" required><hr></td></tr>
    <tr><th>Есть карта маршрута?<hr></th><td><input type="checkbox" name="map" value="1"><hr> </td></tr>
    <tr><th>Интервал<hr></th><td><input type="text" name="inter"><hr></td></tr>
    <tr><th>Дата запуска<hr></th><td><input type="number" name="start_operate_day" placeholder="число" style="width: 55px; border: none;" min="1" max="31">. <input type="number" min="1" max="12" name="start_operate_month" placeholder="месяц" style="width: 60px; border: none;" min="1870" max="2024">. <input type="number" name="start_operate_year" placeholder="год" style="width: 60px; border: none;"><hr></td></tr>
    <tr><th>Дата посл. обновления<hr></th><td><input type="number" name="end_operate_day" placeholder="число" style="width: 55px; border: none;" min="1" max="31">. <input type="number" name="end_operate_month" placeholder="месяц" style="width: 60px; border: none;" min="1" max="12">. <input type="number" name="end_operate_year" placeholder="год" style="width: 60px; border: none;" min="1870" max="2100"><hr></td></tr>
    <tr><th>Примечание</th><td><input type="text" name="note"height="50px"></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit" value="Отправить">Отправить</button></div></th></tr>

</form>
</table>
    </div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>