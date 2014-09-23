<?php
require_once('/HTMLView.php');
require_once('/loginController.php');

session_start();

$loginC = new loginController();
$htmlBody = $loginC->loginPage();

$view = new HTMLView();
$view->echoHTML($htmlBody);
