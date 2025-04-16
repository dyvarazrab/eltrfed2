<?php
$title = "Создать модель";
require '../include/top.php';

$model_name = $_POST['model_name'];
$model_type = $_POST['model_type'];
$model_note = $_POST['model_note'];
$model_is_parent = $_POST['is_parent'];
$parent_model = $_POST['parent_model'];
// echo $parent_model;
// var_dump($_POST);

if(isset($_POST)){
    mysqli_query($conn, "INSERT INTO `models` (`model_type`, `model_name`, `model_note`, `is_parent`, `parent_id`, `date_create`, `date_update`) VALUES (" .n($model_type) .", " .n($model_name) .", " .n($model_note) .", " .n($model_is_parent) .", " .n($parent_model) .", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
}   



?>

<h2><?=$title?></h2>
<div style="width: 30%">
    <table class="table_full">
    <form method="post">
    <tr><th><hr>Название модели</th><td><hr><input type="text" name="model_name"></td></tr>
    <tr><th><hr>Тип т\с</th><td><hr><select name="model_type"><?foreach($types as $type):?><option value="<?=$type['type_id']?>"><?=$type['type_name']?></option><?endforeach;?></select></td></tr>
    <tr><th><hr>Примечание</th><td><hr><input type="text" name="model_note" maxlength="35"></td></tr>
    <tr><th><hr>Является родительской моделью?</th><td><hr><input type="checkbox" name="is_parent" value="1"> </td></tr>
    <tr><th><hr>Укажите родительскую модель</th><td><hr><select name="parent_model"><option value="NULL">Является родительской.</option><?foreach($parent_models as $model):?><option value="<?=$model['model_id']?>"><?=$model['model_name']?></option><?endforeach;?></select></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit" value="Отправить">Отправить</button></div></th></tr>

    </form>
    </table>
</div>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>