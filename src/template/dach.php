<?php
use src\Config;
use src\Util;
?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon">
<?php foreach(Config::$view['style'] as $styl): ?>
<link href="<?= $styl ?>" rel="stylesheet">
<?php endforeach;?>
<?php foreach(Config::$view['skrypty'] as $skrypt): ?>
<script src="<?= $skrypt ?>"></script>
<?php endforeach;?>
<title><?= Util::self() ?></title>
</head>
<body>
<div id="zero">
<header id="dach">
<div id="lewy">
<div id="data"></div>
<div id="czas"></div>
</div>
<div id="center">
<a href="index.php" id="logo"><?= Config::$view['logo'] ?></a>
</div>
<div id="prawy"></div>
<nav id="linki">
<ul>
<?php foreach(Config::$view['linki'] as $n => list($nazwa, $id, $url)): ?>
<li><a href="<?= $url ?>" id="<?= $id ?>"><?= $nazwa ?></a></li>
<?php endforeach;?>
</ul>
</nav>
</header>
<div id="front">
