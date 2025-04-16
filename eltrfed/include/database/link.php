<?php
$conn = mysqli_connect('localhost', 'root', '', 'eltrfed');


$vehicles = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM vehicles"), MYSQLI_ASSOC);
$models = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM models ORDER BY `model_name` ASC"), MYSQLI_ASSOC);
$locations = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `locations` WHERE `parent_location` IS NOT NULL"), MYSQLI_ASSOC);
$fedokrugs = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `locations` WHERE `parent_location` IS NULL"), MYSQLI_ASSOC);
$locations_all = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `locations`"), MYSQLI_ASSOC);
$conditions = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM conditions WHERE `cond_id` < 10"), MYSQLI_ASSOC);
$depots = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM depots"), MYSQLI_ASSOC);
$routes = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM routes"), MYSQLI_ASSOC);
$news = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM location_news"), MYSQLI_ASSOC);
$types = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM types"), MYSQLI_ASSOC);
$photos = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `photo` ORDER BY `id` DESC LIMIT 10"), MYSQLI_ASSOC);
$cond_routes = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM conditions WHERE `cond_id` > 9"), MYSQLI_ASSOC);
$parent_models = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM models WHERE `is_parent` = 1"), MYSQLI_ASSOC);

?>
