



<?php 
require '../include/top.php';

$date = $_POST['date'];
$uptext = $_POST['uptext'];
$text = $_POST['text'];
$location_id = $_POST['location_id'];
$news_type = $_POST['news_type'];
$visible = $_POST['visible'];


$sql = "INSERT INTO `location_news` 
(`news_id`, `date`, `uptext`, `text`, `location_id`, `news_type`, `visible`, `date_create`, `date_update`) 
VALUES 
(NULL, $date, $uptext, $text, $location_id, $news_type, $visible, NOW(), NOW());"

?>

<select><? locations_all($locations_all); ?></select>