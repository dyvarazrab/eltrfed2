<?php 
$title = "Редактировать информацию о фото";
require $_SERVER['DOCUMENT_ROOT'] . '/include/top.php';
$id = $_GET['id'];
$ph = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `photo` WHERE `id` = $id")); 

if(!empty($_POST)){
    mysqli_query($conn, "UPDATE photo SET `text` = '{$_POST['text']}', `date` = '{$_POST['date']}', `date_update` = CURRENT_TIMESTAMP WHERE `id` = $id");
    header('Location: show.php?ph=' . $id);
} 
?>


<h2><?=$title?></h2>
<div style="width: 30%">
<table class="table_full">
    <form method="post" enctype="multipart/form-data">
    <tr><th>Описание<hr></th><td><input type="text" name="text" required placeholder="Введите описание" value="<?=$ph['text']?>"><hr></td></tr>
    <tr><th>Дата<hr></th><td><input type="date" name="date" value="<?=$ph['date']?>"><hr></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit" value="Отправить">Отправить</button></div></th></tr>
    </form>
</table>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>