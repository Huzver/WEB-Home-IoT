<?php
if ($argv[1] == "START") {
	// Скрипт выполняется всегда без таймаута
	set_time_limit(0);
	// Открываем UDP сокет
	$socket = stream_socket_server("udp://0.0.0.0:10004", $errno, $errstr, STREAM_SERVER_BIND);
	
	if (!$socket) {
		die("$errstr ($errno)");
	}
	
	do {
		// MTU 1500
		$data = stream_socket_recvfrom($socket, 1500, STREAM_OOB, $peer);
		// Остановить сервер можно подав UDP сообщение STOP
		if ($data == "STOP") {
			unset($socket,$data);
			break;
		}
		
		$message = 'OK';
		stream_socket_sendto($socket, $message, 0, $peer);
		
	} while ($data !== false);

} else {
	echo "Не передан параметр запуска.";
}
?>