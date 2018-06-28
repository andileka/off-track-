<?php
header("Access-Control-Allow-Origin: *");
require('../project/includes/configuration/prepend.inc.php');
\Hikify\Helpers\Sms::sendSMS($_POST['to'], $_POST['message'], '11111', \QCubed\QDateTime::now());
