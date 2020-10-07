<?php

use src\Engine;


/**
 *
 * @author Edikowy
 * @author Abelg
 *
 */

spl_autoload_extensions('.php');
spl_autoload_register('autoload');
function autoload($class) {
    set_include_path('./src/');
    spl_autoload($class);
}

$index = new Engine();
$index -> start();
