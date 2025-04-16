<?php
$title = "Маршруты";
$t = $_GET['t'];
$l = $_GET['l'];
require '../include/top.php';
?>
<form>
    Тип: <select name="t"><option value="1,2,3,4,5,6,7,8,9,10">Все</option><? foreach($types as $type): ?> <option value="<?=$type['type_id']?>"><?=$type['type_name']?></option><? endforeach; ?></select><br/>
    Локация: <input  autocomplete="off" role="combobox" list="l" id="input" name="l" placeholder="Введите локацию \ выберите из списка" value="<?=$l?>">
    <datalist id="browsers" role="listbox">
    <? foreach($locations_all as $loc): ?>
    <option value="<?=$loc['id'];?>"><?=$loc['name'];?></option>
    <? endforeach; ?>
  </datalist>
        <button type="submit">Применить</button>
</form><br>
<div class="button"><i class="fa fa-plus" aria-hidden="true" style="color: white"></i> <a href="create.php">Добавить маршрут</a></div>


<!-- <input  autocomplete="off" role="combobox" list="" id="input" name="l" placeholder="Введите локацию \ выберите из списка"> -->

  <datalist id="l" role="listbox">
    <? foreach($locations_all as $loc): ?>
    <option value="<?=$loc['id'];?>" label="<?=$loc['name'];?>"><?=$loc['name'];?></option>
    <? endforeach; ?>
  </datalist>

<?php if((!empty($t) && $t !== "1,2,3,4,5,6,7,8,9,10") && empty($l)): $routes = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `routes` WHERE `type` IN ($t) AND `id` != 0"), MYSQLI_ASSOC); ?>
  <table class="vehtable">
    <tr><th>id<hr></th><th>Локация<hr></th><th>№<hr></th><th>конечные<hr></th><th>маршрут<hr></th><th>план<hr></th><th>факт<hr></th><th>закреп<hr></th><th style="min-width: 200px">время работы, интервал<hr></th></tr>
        <? foreach($routes as $route): ?>
            <tr><td><?=$route['id'];?></td><td><?=location($route['loc_id']);?></td><td><span class="route-num"><a href="full.php?id=<?=$route['id']?>"><?=$route['num'];?></span></a></td><td><?=stop($route['start_stop']) . " - " . stop($route['last_stop']);?></td><td style="max-width:500px;"><?=$route['route']?></td><td><?=$route['release1']?></td><td><?=$route['fact']?></td><td></td><td><?=$route['inter']?></td>
            <?endforeach;?>
</table>

<?php elseif(!empty($l) && empty($t)): $routes = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `routes` WHERE `loc_id` = $l AND `id` != 0"), MYSQLI_ASSOC);?>
  <table class="vehtable">
    <tr><th>id<hr></th><th>Тип<hr></th><th>№<hr></th><th>конечные<hr></th><th>маршрут<hr></th><th>план<hr></th><th>факт<hr></th><th>закреп<hr></th><th>время работы, интервал<hr></th></tr>
        <? foreach($routes as $route): ?>
            <tr><td><?=$route['id'];?></td><td><?=type($route['type']);?></td><td><span class="route-num"><a href="full.php?id=<?=$route['id']?>"><?=$route['num'];?></span></a></td><td><?=stop($route['start_stop']) . " - " . stop($route['last_stop']);?></td><td style="max-width:500px;"><?=$route['route']?></td><td><?=$route['release1']?></td><td><?=$route['fact']?></td><td></td><td><?=$route['inter']?></td>
            <?endforeach;?>
</table>

<?php elseif((!empty($l) && !empty($t))): $routes = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `routes` WHERE `loc_id` = $l AND `type` IN ($t) AND `id` != 0"), MYSQLI_ASSOC);?>
<table class="vehtable">
    <tr><th>id<hr></th></th><th>№<hr></th><th>конечные<hr></th><th>маршрут<hr></th><th>план<hr></th><th>факт<hr></th><th>закреп<hr></th><th>время работы, интервал<hr></th></tr>
        <? foreach($routes as $route): ?>
            <tr><td><?=$route['id'];?></td><td><span class="route-num"><a href="full.php?id=<?=$route['id']?>"><?=$route['num'];?></span></a></td><td><?=stop($route['start_stop']) . " - " . stop($route['last_stop']);?></td><td style="max-width:500px;"><?=$route['route']?></td><td><?=$route['release1']?></td><td><?=$route['fact']?></td><td></td><td><?=$route['inter']?></td>
            <?endforeach;?>
</table>


<?php else: $routes = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `routes` WHERE `id` != 0"), MYSQLI_ASSOC);?>
<table class="vehtable">
    <tr><th>id<hr></th><th>Тип<hr></th><th>Локация<hr></th><th>№<hr></th><th>конечные<hr></th><th>маршрут<hr></th><th>план<hr></th><th>факт<hr></th><th>закреп<hr></th><th>время работы, интервал<hr></th></tr>
        <? foreach($routes as $route): ?>
            <tr><td><?=$route['id'];?></td><td><?=type($route['type']);?></td><td><?=location($route['loc_id']);?></td><td><span class="route-num"><a href="full.php?id=<?=$route['id']?>"><?=$route['num'];?></span></a></td><td><?=stop($route['start_stop']) . " - " . stop($route['last_stop']);?></td><td style="max-width:500px;"><?=$route['route']?></td><td><?=$route['release1']?></td><td><?=$route['fact']?></td><td></td><td><?=$route['inter']?></td>
            <?endforeach;?>
</table>
<?php endif; ?>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>