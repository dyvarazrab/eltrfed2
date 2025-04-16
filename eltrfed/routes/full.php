<?php
$title = "Информация о маршруте";

require '../include/top.php';
$r = $_GET['id'];
$route = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `routes` WHERE `id` = $r"));
?>

<div style="width: 30%">
    <table class="table_full">
    <tr><th style="padding-top: 10px">Тип<hr></th><td style="padding-top: 10px"><?=type($route['type'])?><hr></td></tr>
    <tr><th>Локация маршрута<hr></th><td><?=location($route['loc_id'])?><hr></td></tr>
    <tr><th>Депо<hr></th><td><?=depot_full($route['depot']);?><hr></td></tr>
    <tr><th>Номер<hr></th><td><?=$route['num'];?><hr></td></tr>
    <tr><th>Начальная остановка<hr></th><td><a href="/stops/full.php?id=<?=$route['start_stop'];?>"><?=stop($route['start_stop']);?></a><hr></td></tr>
    <tr><th>Маршрут<hr></th><td><?=$route['route'];?><hr></td></tr>
    <tr><th>Конечная остановка<hr></th><td><a href="/stops/full.php?id=<?=$route['last_stop'];?>"><?=stop($route['last_stop']);?></a><hr></td></tr>
    <tr><th>План выпуска, ед.<hr></th><td><?=$route['release1'];?><hr></td></tr>    
    <tr><th>Факт выпуска, ед.<hr></th><td><?=$route['fact'];?><hr></td></tr>
    <tr><th>Есть карта маршрута?<hr></th><td><?=boolv($route['map']);?><hr> </td></tr>
    <tr><th>Интервал<hr></th><td><?=$route['inter'];?><hr></td></tr>
    <tr><th>Дата запуска<hr></th><td><?=dtd2($route['date_open']);?><hr></td></tr>
    <tr><th>Дата посл. обновления<hr></th><td><?=dtd2($route['date_update1']);?><hr></td></tr>
    <tr><th>Примечание<hr></th><td><?=$route['note'];?><hr></td></tr>
    </table>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>