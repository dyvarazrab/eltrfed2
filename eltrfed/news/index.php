<?php
require '../include/top.php';

?>
<br/><a href="create.php">Создать новость</a>
<link rel="stylesheet" type="text/css" href="../include/file.css">
<div>

<?php 
foreach($news as $a){
    $c = $a['location_id'];
    //var_dump($c);
    $b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `location` WHERE `id` = $c"));
    echo $b['name'];
}

?>
</div>