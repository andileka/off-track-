<?php
require('./project/includes/configuration/prepend.inc.php');

$steps		= 10;

foreach(Tourist::loadAll() as $tourist) {
	for($i=0;$i< $steps;$i++) {
		$movementx = rand(-50,100)/10000;
		$movementy = rand(-50,100)/10000;
		error_log($movementx);
		error_log($movementy);

		$objCurrentPosition = $tourist->Position;
		$tourist->MoveTo($objCurrentPosition->Lat+$movementx,$objCurrentPosition->Long+$movementy);
	}
}