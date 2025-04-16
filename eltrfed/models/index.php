<?php
if(empty($_GET)){
    
}
require '../include/top.php';
$type = $_GET['t'];
$np = $_GET['np'];
if(empty($np)):
    if(isset($type)){
        $result = mysqli_query($conn, "SELECT * FROM models WHERE `is_parent` = 1 AND `model_type` = $type ORDER BY `model_name` ASC");
    }
    else{
        $result = mysqli_query($conn, "SELECT * FROM models WHERE `is_parent` = 1  ORDER BY `model_name` ASC");
    }
    if (!$result) {
        die('Ошибка выполнения запроса: ' . mysqli_error($conn));
    }
    $parents = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <div class="button"><i class="fa fa-plus" aria-hidden="true" style="color: white"></i> <a href="create.php">Добавить модель</a></div>

    <table class="full_veh_table vertical">
        <?php
        echo "<thead>";
        echo "<tr><th>id</th><th>Тип</th><th>Название</th><th>Примечание к модели</th><th>Действия</td></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach($parents as $model) {
            // Получаем дочерние модели
            $childs = mysqli_fetch_all(mysqli_query($conn, "SELECT `model_id` FROM models WHERE `parent_id` = {$model['model_id']} ORDER BY `model_name` ASC"), MYSQLI_ASSOC);
            
            echo '<tr>';
            echo '<th><hr>'. $model['model_id'] .'</th>';
            echo '<th><hr>'. type($model['model_type']) .'</th>';
            echo '<th><hr><a href="full.php?id='. $model['model_id'] . '">' . $model['model_name'] . '</a></th>';
            echo '<th><hr>'. $model['model_note'] .'&emsp;</th>';
            echo '<th><hr><a href="edit.php?id=' . $model['model_id'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="delete.php?id=' . $model['model_id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></a></th>';
            echo '</tr>';
            
            // Отображаем дочерние модели
            foreach ($childs as $child) {
                $childModel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM models WHERE `model_id` = {$child['model_id']}  ORDER BY `model_name` ASC"));
                if ($childModel) {
                    echo '<tr>';
                    echo '<td>' . $childModel['model_id'] .'</td>';
                    echo '<td></td>';
                    echo '<td><a href="full.php?id='. $childModel['model_id'] . '">' . $childModel['model_name'] .'</a></td>'; // Предполагается, что у дочерней модели есть поле model_name
                    echo '<td>' . $childModel['model_note'] .'</td>';
                    echo '<td><a href="edit.php?id=' . $childModel['model_id'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="delete.php?id=' . $childModel['model_id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';

                }
            }
            
            echo "</tr>";
        }
        echo "</tbody>";
    ?>
    </table>
<?php endif; ?>
<?php
if(isset($np)){
    // $parents = implode(',', array_column(mysqli_fetch_all(mysqli_query($conn, "SELECT `parent_model_id` FROM model_parents"), MYSQLI_ASSOC), 'parent_model_id'));
    
    if(isset($type)){
        $result = mysqli_query($conn, "SELECT * FROM models WHERE isnull(`is_parent`) AND isnull(`parent_id`) AND `model_type` = $type ORDER BY `model_name` ASC");
    }
    else{
        $result = mysqli_query($conn, "SELECT * FROM models WHERE isnull(`is_parent`) AND isnull(`parent_id`)  ORDER BY `model_name` ASC");
    }
    if (!$result) {
        die('Ошибка выполнения запроса: ' . mysqli_error($conn));
    }
    
    echo '<table class="full_veh_table vertical">';
        echo "<thead>";
        echo "<tr><th>id</th><th>Тип</th><th>Название</th><th>Примечание к модели</th><th>Действия</td></tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach($result as $model) {
         
            echo '<tr>';
            echo '<td>'. $model['model_id'] .'</td>';
            echo '<td>'. type($model['model_type']) .'</td>';
            echo '<td><a href="full.php?id='. $model['model_id'] . '">' . $model['model_name'] . '</a></td>';
            echo '<td>'. $model['model_note'] .'&emsp;</td>';
            echo '<td><a href="edit.php?id=' . $model['model_id'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="delete.php?id=' . $model['model_id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
            echo '</tr>';
            }
        
        echo "</tbody>";
    echo '</table>';
}

 require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php';