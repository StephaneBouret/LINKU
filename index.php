<?php

session_start();

include 'View/View.php';
include 'Controller/Controller.php';
include 'Model/Model.php';
include 'Controller/TicketController.php';


if(isset ($_GET['controller'])) {
    $controllerStart = ucfirst($_GET['controller'] ."Controller");
} else {
    $controllerStart = 'TicketController';
} 

$controller = new $controllerStart();

if(isset ($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'start';
} 

$controller->$action();
