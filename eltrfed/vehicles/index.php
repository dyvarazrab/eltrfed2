<?php
$title = "Список всех т\с в БД";

require '../include/top.php';
?>
<br/>
<div class="button"><i class="fa fa-plus" aria-hidden="true" style="color: white"></i> <a href="create.php">Создать т\с</a></div>
<table class="vehtable">
<thead>
        <tr><th>id</th><th>Модель</th><th></th><th>Борт</th><th>Дата постройки</th><th>Заводской номер</th><th>VIN</th><th>С</th><th>По</th><th>Состояние</th><th>Депо</th><th>Краткое описание</th><th>Закрепление</th>
        </thead>
        <tbody>
<? 
if(empty($_GET)){}
if(isset($_GET['m'])){
    $vehicles = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM vehicles WHERE `veh_model` = {$_GET['m']}"), MYSQLI_ASSOC);
    if(empty($vehicles)){
        $childs = implode(',', array_column(mysqli_fetch_all(mysqli_query($conn, "SELECT `model_id` FROM models WHERE `parent_id` = {$_GET['m']}"), MYSQLI_ASSOC), 'model_id'));
        $vehicles = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM vehicles WHERE `veh_model` IN ($childs)"), MYSQLI_ASSOC);
    }
}
    
        foreach($vehicles as $vehicle): ?>
            <tr class="c<?=$vehicle['veh_condition']?>">
            <td><a href="full.php?id=<?=$vehicle['veh_id']?>"><?=$vehicle['veh_id']?></td>
            <td><a href="/models/full.php?id=<?=$vehicle['veh_model']?>"><?=model($vehicle['veh_model'])?></a></td>
            <td><a href="edit.php?id=<?=$vehicle['veh_id']?>"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="delete.php?id=<?=$vehicle['veh_id']?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            <td class="b"><a href="full.php?id=<?=$vehicle['veh_id']?>"><?=number($vehicle['veh_num1'], $vehicle['veh_num2'])?></td>
            <td><?=dtd($vehicle['veh_month_created']) . dtd($vehicle['veh_year_created'])?></td>
            <td><?=$vehicle['veh_factory_num']?></td>
            <td><?=$vehicle['veh_vin']?></td>
            <!-- <td>$vehicle['veh_parent']</td> -->
            <td><?=dtd($vehicle['veh_start_operate_day']) . dtd($vehicle['veh_start_operate_month']) . dtd($vehicle['veh_start_operate_year'])?></td>
            <td><?=dtd($vehicle['veh_end_operate_day']) . dtd($vehicle['veh_end_operate_month']) . dtd($vehicle['veh_end_operate_year'])?></td>
            <?=condition2($vehicle['veh_condition'])?>
            <td><?=depot_short($vehicle['veh_depot'])?></td>
            <td><?=$vehicle['veh_note_short']?></td>
            <td><?=$vehicle['veh_route']?></td>      
            </tr>
        <? endforeach; ?>
            </tbody>
            
            </table>
    </div>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>