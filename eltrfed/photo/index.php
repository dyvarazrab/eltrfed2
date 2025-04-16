<?php
$title = "Фотографии";

require $_SERVER['DOCUMENT_ROOT'] . '/include/top.php';
?>
<div class="button mb-10"><i class="fa fa-plus" aria-hidden="true" style="color: white"></i> <a href="create.php">Добавить фото</a></div>


<table class="photo">
    <?php 
    $a = 1;
    foreach($photos as $photo){
        if(($a % 2) == 1){
            echo '<tr><td><a href="show.php?ph='.$photo['id'].'"><img src="/photo/img/'.$photo['file_name'].'" height="300"><br/>'.$photo['text'].'</a></td>';
        }
        if(($a % 2) == 0){
            echo '<td><a href="show.php?ph='.$photo['id'].'"><img src="/photo/img/'.$photo['file_name'].'" height="300"><br/>'.$photo['text'].'</a></td></tr>';
        }
        $a++;
    }
?>
</table><br><br>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>

