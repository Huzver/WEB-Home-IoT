<?php

	// Класс главной страницы сайта
	class main_controller {
	
		// Обработка главной страницы
		public function actionIndex() {
			
			// Проверяем, авторизирован ли пользователь
			$userId = Users::checkLogin();
			
			// Получаем нужные данные о пользователе
			if ($userId) {
				$userData = Users::getUserById($userId);
			}
			
			// Подключаем шаблон главной страницы Index
			require_once(MDIR.'/views/main/index.php');
			
			return true;
		}
	
	}

?>