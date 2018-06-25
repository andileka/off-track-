<?php
class SigfoxParser {
		
	public static function processInput() {
		self::requireqcubed();

		$_SESSION['USER'] = 1;		
		$rawdata					= file_get_contents('php://input');
		if($rawdata) {
			Log::MakeEntry("SIGFOX", null, $rawdata);
		}
		$result = array();
		parse_str ( $rawdata, $result);
		
		
		$hexdata = $result['rawData'];
		
		$string = hex2bin($hexdata);
		if($string) {
			Log::MakeEntry("SIGFOX", null, $string);
		}
		
	}

	private static function log($what) {
		//return;
		$path = "/mnt/backups/storage/tmp/parts.log";
		if(file_exists($path) && is_writable($path)){
			// first time -> create *.log file
			if(!file_exists($path)){
				touch($path);
			}

			$log = fopen($path, 'a');
			fwrite($log, date('Y-m-d H:i') . "\t". $what . "\n");
			fclose($log);
		}
	}
	
	private static function requireqcubed(){
		require_once '../qcubed/includes/prepend.inc.php';
	}
}
SigfoxParser::processInput();