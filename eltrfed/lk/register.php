<?php
$title = "Регистрация";
require '../include/top.php';
?>
    <h2 class="center"><?=$title?></h2>
<div align="center">
    <form method="POST">
        <table class="table_full login">
            <tr><td><hr class="hr-main"><input type="text" placeholder="Логин"></input><hr class="hr-main"></td></tr>
            <tr><td><input type="password" placeholder="Пароль"></input></td></tr>
            <tr><td><div class="button"><button type="submit" value="Отправить">Отправить</button></div></td></tr>
        </table>
    </form>
</div>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>