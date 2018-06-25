<?php

mb_internal_encoding('UTF-8');
mb_http_output();

header('Content-type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past

require('./project/includes/configuration/prepend.inc.php');

Hikify\Main::run('Hikify\Main', null, 'hikify');
