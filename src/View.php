<?php
namespace src;

class View {
    public static function show($templates) {
        return include 'src/template/'. $templates .'.php';
    }
}

