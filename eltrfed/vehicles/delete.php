<?php
require $_SERVER['DOCUMENT_ROOT'] . '/include/function.php';
$id = $_GET['id'];

if(isset($id)){
    mysqli_query($conn, "DELETE FROM `vehicles` WHERE `veh_id` = '$id'");
    header('Location: index.php');
}