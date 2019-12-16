<?php
require_once __DIR__."/vendor/autoload.php";
use ITTech\View\View;

$view = new View($_SERVER["DOCUMENT_ROOT"]."/test", 3600 * 24);
echo $view->render("index.php");

