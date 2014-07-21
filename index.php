<?php
    session_start();    //ligne nécessaire à l'utilisation de $_SESSION
    use memberspace\controller\Controller;  //il faut utiliseur la classe Controller

    require 'inc/conf.inc.php'; //il faut boucler dans tous les require, grace à la fonction contenue dans conf.inc.php
    new Controller();   //démarre l'utilisation du controller