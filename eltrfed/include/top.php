<?php
require 'function.php';
require 'settings.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/include/styles.css">
<link rel="icon" href="/include/icon/favicon-32x32.png" type="image/x-icon">
<script src="https://kit.fontawesome.com/b3c380eadd.js" crossorigin="anonymous"></script>
<div class="top">
    <div class="button float-left"><a href="/">Главная</a></div>
    <div class="button float-left drop"><a href="/vehicles">Т\С</a></div>
    <div class="button float-left drop"><a href="/models">Модели</a></div>
    <div class="button float-left drop"><a href="/news">Новости</a></div>
    <div class="button float-left drop"><a href="/routes">Маршруты</a></div>
    <div class="button float-left drop"><a href="/photo">Фото</a></div>
    <div class="button float-right drop"><a href="/lk">Профиль</a></div>
</div>

<div>


    
    <?php 

if(!empty($title)): ?>
    <title><?=$title . " | " . $sitename; ?></title>
    <?php endif; ?>
    </div>
</head>
    <body>
        <div class="main">
            <br/>   

