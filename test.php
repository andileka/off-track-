<?php
require('./project/includes/configuration/prepend.inc.php');

$steps		= 10;

$datetime	= QCubed\QDateTime::now();
$datetime->setTime(06,00,00);
foreach(Tourist::loadAll() as $tourist) {
	for($i=0;$i< $steps;$i++) {
		$datetime->addMinutes(rand(1,rand(10,50)));
		$movementx = rand(-5,100)/10000;
		$movementy = rand(-5,100)/10000;
		error_log($movementx);
		error_log($movementy);

		$objCurrentPosition = $tourist->Position;
		$tourist->MoveTo($objCurrentPosition->Lat+$movementx,$objCurrentPosition->Long+$movementy, $datetime);
	}
}