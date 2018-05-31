<?php

function __autoload($className) {
	
	// Пути до папок с классами
	$arrayPaths = array(
		'/models/',
		'/components/',
	);
	
	// Ищем вызываемый класс в указанных папках
	foreach ($arrayPaths AS $path) {
		$path = MDIR.$path.$className.'.php';
		if(is_file($path)) {
			include_once($path);
		}
	}

}

?>