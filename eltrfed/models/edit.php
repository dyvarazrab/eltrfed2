<?php
$id = $_GET['id'];
require '../include/top.php';

$model1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `models` WHERE `model_id` = $id")); // получаем саму модель

if(isset($_POST)){
    $sql="UPDATE `models` SET `model_name` = '{$_POST['model_name']}', `model_type` = '{$_POST['model_type']}', `model_note` = ".n($_POST['model_note']).", `is_parent` = ".n($_POST['is_parent']).", `parent_id` =".n($_POST['parent_model']).", `date_update` = CURRENT_TIMESTAMP WHERE `model_id` = $id";
    mysqli_query($conn, $sql);
}



?>
<title>Редактировать модель <?=$model1['model_name']?> | <?=$sitename?></title>
<h2>Редактировать модель <?=$model1['model_name']?></h2>
<div style="width: 40%">
    <table class="table_full">
    <form method="post">
    <tr><th><hr>Название модели</th><td><hr><input type="text" name="model_name" value="<?=$model1['model_name']?>"></td></tr>
    <tr><th><hr>Тип т\с</th><td><hr><select name="model_type" value="<?=$model1['model_type']?>"><?foreach($types as $type):?><option value="<?=$type['type_id']?>"><?=$type['type_name']?></option><?endforeach;?></select></td></tr>
    <tr><th><hr>Примечание</th><td><hr><input type="text" name="model_note" value="<?=$model1['model_note']?>"></td></tr>
    <tr><th><hr>Является родительской моделью?</th><td><hr><input type="checkbox" name="is_parent" value="<?=$model1['is_parent']?>"> </td></tr>
    <tr><th><hr>Укажите родительскую модель</th><td><hr><select name="parent_model"><option value="NULL">Нет родительской.</option><?foreach($parent_models as $model):?><option value="<?=$model['model_id']?>" <?=checked($model['model_id'], $model1['parent_id']);?>><?=$model['model_name']?></option><?endforeach;?></select></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit" value="Отправить">Отправить</button></div></th></tr>

</form>
</table>
    </div>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>