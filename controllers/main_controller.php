<?php

	// Класс главной страницы сайта
	class main_controller {
	
		// 1. Обработка главной страницы
		public function actionIndex() {
			
			// Подключаем шаблон главной страницы Index
			require_once(MDIR.'/views/main/index.php');
			
			return true;
		}
		
		// 2. Получение времени через AJAX запрос
		public function actionTime($offset) {
			
			$nowTime = Site::getNowTime(time(), $offset);
			
			echo $nowTime;
			
			return true;
		}
	
		// 3. Общая страница настроек
		public function actionSettings() {
			
			// Заголовок страницы
			$addPageTitle = 'Настройки панели управления';
			
			// Запрашиваем данные о сервере - массив
			$serverInfo = Site::getServerInfo();
			
			// Подключаем шаблон настроек
			require_once(MDIR.'/views/main/settings.php');
			
			return true;
		}
	}

?>