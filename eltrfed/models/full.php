<?php
$id = $_GET['id'];
require '../include/top.php';




$model = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `models` WHERE `model_id` = $id")); // получаем саму модель
if($model['is_parent'] == 0){ // если модель не родительская, то
    $parent = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `models` WHERE `model_id` = {$model['parent_id']}")); // получаем родителя
} elseif($model['is_parent'] == 1){ // если модель родительская, то
    $parent['model_name'] = "Модель является родительской.";
    $parent['model_id'] = $model['model_id']; // id модели для отображения в таблице передаем сюда
    $all_mods = mysqli_fetch_all(mysqli_query($conn, "SELECT `model_id` FROM `models` WHERE `parent_id` = $id"), MYSQLI_ASSOC);
    $ids3 = implode(',', array_column($all_mods, 'model_id'));
    $all_vehs = mysqli_fetch_all(mysqli_query($conn, "SELECT `veh_id` FROM `vehicles` WHERE `veh_model` IN ($ids3)"), MYSQLI_ASSOC);
    $ids2 = implode(',', array_column($all_vehs, 'veh_id'));

}


$count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM `vehicles` WHERE `veh_model` IN ($id". n1($ids3).")")); // сколько тс этой модели




$vehicles = mysqli_fetch_all(mysqli_query($conn, "SELECT `veh_id` FROM `vehicles` WHERE `veh_model` = $id"), MYSQLI_ASSOC); // получаем все т\с этой модели 
$ids = implode(',', array_column($vehicles, 'veh_id'));


$ids = merge($ids, $ids2);

$photos = []; // Инициализируем переменную $photos как пустой массив
if (!empty($ids)) {
    $photos_result = mysqli_query($conn, "SELECT `photo_id` FROM `photo_vehicle` WHERE `vehicle_id` IN ($ids)");
    if ($photos_result) {
        $photos_ids = mysqli_fetch_all($photos_result, MYSQLI_ASSOC);
        $photos_id = implode(',', array_column($photos_ids, 'photo_id'));
        
        if (!empty($photos_id)) {
            $photos_result = mysqli_query($conn, "SELECT * FROM photo WHERE `id` IN ($photos_id)");
            if ($photos_result) {
                $photos = mysqli_fetch_all($photos_result, MYSQLI_ASSOC);
            }
        }
    }
}

?>
<title><?=$model['model_name']?></title>
<h1><?=$model['model_name']?></h1>
<table><tr><td width="50%">
<table class="veh_full_table">
<center><strong>Информация о модели</strong><center>

    <tr><th class="textright"><hr>id<hr></th><td><hr><?=$id?><hr></td></tr>
    <tr><th class="textright">Вид модели<hr></th><td><a href="/models/?t=<?=$model['model_type']?>"><?=type($model['model_type'])?></a><hr></td></tr>
    <tr><th class="textright">Название<hr></th><td><?=$model['model_name']?><hr></td></tr>
    <tr><th class="textright">Примечание<hr></th><td><?=$model['model_note']?>&nbsp;<hr></td></tr>
    <tr><th class="textright">Родительская модель<hr></th><td><a href="?id=<?=$parent['model_id']?>"><?=$parent['model_name'] . ' [' . $parent['model_id'] . ']'?></a><hr></td></tr>
    <tr><th class="textright">Количество Т\С этой модели<hr></th><td><a href="/vehicles/?m=<?=$id?>"><?=$count['COUNT(*)']?></a><hr></td></tr>
</table>
<table class="veh_full_table vertical">
    <center><strong>Древо модели</strong><center>
        <thead>
        <tr><th>id</th><th>Тип</th><th>Название</th><th>Примечание к модели</th><th>Действия</td></tr>
        </thead>
        <tbody>
        <?php   
        if($model['is_parent'] !== "1"){
            $parentModel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `models` WHERE `model_id` = {$model['parent_id']}"));
        }
        else{
            $parentModel = $model;
        }
        $models = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `models` WHERE `parent_id` = {$parentModel['model_id']}"), MYSQLI_ASSOC);
            ?>
        <tr><th><hr><?=$parentModel['model_id'];?></th><th><hr><?=type($parentModel['model_type']);?></th><th><hr><?=linkModel($parentModel);?></th><th><hr>&#8194;<?=$parentModel['model_note'];?></th><th><hr><a href="edit.php?id=<?=$model['model_id']?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="delete.php?id=<?=$model['model_id']?>"><i class="fa fa-trash" aria-hidden="true"></i></a></th></tr>

        <?php foreach($models as $model):?>
            <tr><td><?=$model['model_id'];?></td><td><?=type($model['model_type']);?></td><td><?=linkModel($model);?></td><td><?=$model['model_note'];?></td><td><a href="edit.php?id=<?=$model['model_id']?>"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="delete.php?id=<?=$model['model_id']?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
        <? endforeach; ?>
        
</tbody>
</table></td>

<td width="50%">
<table class="photo">
<tr><td colspan="2"><strong><? echo empty($photos) ? 'Фотографий с этой моделью Т\С нет.' : 'Фотографии с этой моделью Т\С:';?></strong></td></tr>
    <?php 
    $a = 1;
    foreach($photos as $photo){
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