<?php
require $_SERVER['DOCUMENT_ROOT'] . '/include/function.php';
$id = $_GET['id'];
$type = $_GET['t'];

if(isset($id)){
    mysqli_query($conn, "DELETE FROM `models` WHERE `model_id` = '$id'");
    header('Location: index.php?np=1');
}