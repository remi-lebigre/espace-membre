<?php //automatise l'affichage des require '...'; sur chaque page.

    define ('ROOT', realpath(dirname(__FILE__) . '/../') . '/'); //permet de partir de ROOT pour tous les require

    function autoloadItemsClass($sClassName)
    {
        $sFilePath = ROOT . 'src/' . str_replace('\\', '/',$sClassName) . '.class.php'; //require tous les fichiers terminant par .class.php
        if (is_file($sFilePath)) {
            require_once $sFilePath;
        }
    }

    spl_autoload_register('autoloadItemsClass');