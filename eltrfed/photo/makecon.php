<?php
$ph = $_GET['ph'];
$veh = $_GET['veh'];
$title = "Связать фотографию и Т\С";

require $_SERVER['DOCUMENT_ROOT'] . '/include/top.php';

// var_dump($_POST);


if($_POST){
    $sql = "INSERT INTO `photo_vehicle` (`photo_id`, `vehicle_id`) VALUES ('{$_POST['ph']}', '{$_POST['veh']}');";
    echo $sql;

    mysqli_query($conn, $sql);
    if(!empty($ph)){
        header('Location: show.php?ph=' . $ph);
    }
    elseif(!empty($veh)){
        header('Location: /vehicles/full.php?id=' . $veh);
    }
}
?>
<h2><?=$title?></h2>
<div style="width: 30%">
<table class="table_full">
    <form method="post">
    <tr><th><hr>Введите ID фото</th><td><hr><input type="number" name="ph" required value="<?=$ph?>"></td></tr>
    <tr><th><hr>Введите ID Т\С</th><td><hr><input type="number" name="veh" required value="<?=$veh?>"></td></tr>
    <tr><th colspan="2" class="form_button"><div class="button"><button type="submit">Связать</button></div></th></tr>
    </form>
</table>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>