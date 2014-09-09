<?php
require_once('/HTMLView.php');
require_once('/loginController.php');

session_start();

$loginC = new loginController();
$htmlBody = $loginC->doLogin();

$view = new HTMLView();
$view->echoHTML($htmlBody);
