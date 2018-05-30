<?php

	// Класс главной страницы сайта
	class main_controller {
	
		// Обработка главной страницы
		public function actionIndex() {
			
			// Подключаем шаблон главной страницы Index
			require_once(MDIR.'/views/main/index.php');
			
			return true;
		}
	
	}

?>