<?php
require '../include/top.php';

// var_dump($vehicles);
?>
<table>
    <?php
    echo "<thead>";
        echo "<tr><th>id</th><th>Модель</th><th>Бортномер</th><th>Госномер</th><th>Дата постройки</th><th>Заводской номер</th><th>VIN</th><th>Родительское т\с</th><th>День начала работы</th><th>День конца работы</th><th>Состояние</th><th>Депо</th><th>Полное описание</th><th>Краткое описание</th><th>Закрепление</th>";
        echo "</thead>";
        echo "<tbody>";
        foreach($vehicles as $vehicle){
            echo '<td>'. $vehicle['veh_id'] .'</td>';
            echo '<td>'. $vehicle['veh_model'] .'</td>';
            echo '<td>'. $vehicle['veh_num1'] .'</td>';
            echo '<td>'. $vehicle['veh_num2'] .'</td>';
            echo '<td>'. $vehicle['veh_date_created'] .'</td>';
            echo '<td>'. $vehicle['veh_factory_num'] .'</td>';
            echo '<td>'. $vehicle['veh_vin'] .'</td>';
            echo '<td>'. $vehicle['veh_parent'] .'</td>';
            echo '<td>'. $vehicle['veh_start_operate_day']. '.'. $vehicle['veh_start_operate_month']. '.'. $vehicle['veh_start_operate_year'] .'</td>';
            echo '<td>'. $vehicle['veh_end_operate_day']. '.'. $vehicle['veh_end_operate_month'].  '.'. $vehicle['veh_end_operate_year'] .'</td>';
            condition2($vehicle['veh_condition']);
            echo '<td>'. $vehicle['veh_depot'] .'</td>';
            echo '<td>'. $vehicle['veh_note_full'] .'</td>';
            echo '<td>'. $vehicle['veh_note_short'] .'</td>';
            echo '<td>'. $vehicle['veh_route'] .'</td>';           
            echo "</tr>";
        }
            echo "</tbody>";
            ?>
            </table>

            <?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
        