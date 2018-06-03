<?php

// Модель обработки запросов для пользователей
class Site {
	
	// 1. Получение данных о сегодняшней дате и времени
	public static function getNowDate($time, $userTimeZoneOffset, $userTimeZoneName) {
		
		// Формируем массив
		$nowDate = array();
		
		// Месяцы на русском
		$months = array( 1 => 'января',
						'февраля',
						'марта',
						'апреля',
						'мая',
						'июня',
						'июля',
						'августа',
						'сентября',
						'октября',
						'ноября',
						'декабря',
					   );
		// Дни недели на русском
		$dayWeek = array( 0 => 'Воскресенье',
						 'Понедельник',
						 'Вторник',
						 'Среда',
						 'Четверг',
						 'Пятница',
						 'Суббота',
						);
		
		// Временная зона - (UTC +03:00) Москва, Санкт-Петербург, Волгоград
		if (!$userTimeZoneOffset AND !$userTimeZoneName) {
			$userTimeZoneOffset = 0;
		}
		// Коррекция даты от часового пояса UTC
		$time += $userTimeZoneOffset * 3600;
		
		$nowDate['nowTimeZone'] = $userTimeZoneName;
		
		// День - 99
		$nowDate['nowDay'] = date('d', $time);
		// День недели - Воскресенье
		$nowDate['nowDayWeek'] = date($dayWeek[date('w', $time)], $time);
		// Месяц - мая
		$nowDate['nowMonth'] = date($months[date('n', $time)], $time);
		// Год - 9999
		$nowDate['nowYear'] = date('Y', $time);
		
		// Час - 9
		$nowDate['nowHour'] = date('G', $time);
		// Минуты - 99
		$nowDate['nowMinute'] = date('i', $time);
		// Секунды - 99
		$nowDate['nowSecond'] = date('s', $time);
		
		// Возвращаем массив с полученными данными
		return $nowDate;
	}
	
	// 2. Получение времени через AJAX запрос - 99:99
	public static function getNowTime($time, $offset) {
		
		// Коррекция даты от часового пояса UTC
		$time += $offset * 3600;
		
		// Час - 9
		$nowHour = date('G', $time);
		// Минуты - 99
		$nowMinute = date('i', $time);
		// Секунды - 99
		$nowSecond = date('s', $time);
		
		// Возвращаем отформатированное время
		return $nowHour.':'.$nowMinute.':'.$nowSecond;
	}
	
	// 3. Получение информации о сервере
	public static function getServerInfo() {
		
		// Формируем массив данных
		$serverInfo = array();
		
		// Имя сервера
		$serverInfo['Имя сервера'] = $_SERVER['SERVER_NAME'];
		// IP адрес сервера
		$serverInfo['IP адрес'] = $_SERVER['SERVER_ADDR'];
		// Обработчик запросов
		$serverInfo['Обработчик'] = $_SERVER['SERVER_SOFTWARE'];
		// Версия PHP
		$serverInfo['Версия PHP'] = phpversion();
		// Версия сервера
		$command = escapeshellcmd('uname -a');
		$osVersion = exec($command);
		if ($osVersion == '') {
			$osVersion = 'На данный момент поддерживаются команды Linux OS';
		}
		$serverInfo['Версия Ядра ОС'] = $osVersion;
		// Версия Mysql
		$command = escapeshellcmd('mysql -V');
		$mysqlVersion = exec($command);
		if ($mysqlVersion == '') {
			$mysqlVersion = 'На данный момент поддерживаются команды Linux OS';
		}
		$serverInfo['Версия MySQL'] = $mysqlVersion;
		
		// Возвращаем массив
		return $serverInfo;
	}
	
}

?>