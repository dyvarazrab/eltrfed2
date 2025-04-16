<?php 
$title = "Добавить фото";
require $_SERVER['DOCUMENT_ROOT'] . '/include/top.php';
?>


<h2><?=$title?></h2>
<div style="width: 30%">
<table class="table_full">
    <form method="post" action="create_photo.php" enctype="multipart/form-data">
    <tr><th style="padding-top: 10px">Выберите фото<hr></th><td style="padding-top: 10px"><input type="file" name="fileToUpload" id="fileToUpload"><hr></td></tr>
    <tr><th>Введите описание<hr></th><td><input type="text" name="photo_text" required placeholder="Введите описание"><hr></td></tr>
    <tr><th>Выберите дату<hr></th><td><input type="date" name="photo_date"><hr></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit" value="Отправить">Отправить</button></div></th></tr>
    </form>
</table>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>