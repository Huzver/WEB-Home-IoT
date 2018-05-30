<?php

// Подключаем модель Пользователей для контроллера
include_once(MDIR.'/models/users.php');

class users_controller {

	// Список всех пользователей
	public function actionIndex() {
		
		// Получаем от модели список пользователей
		$usersList = array();
		$usersList = Users::getUsersList();
		
		// Подключаем шаблон для вывода
		require_once(MDIR.'/views/users/index.php');
		
		return true;
	}

	// Отдельный пользователь
	public function actionView($id) {
		echo "<br>Просмотр конкретного пользователя";
		echo "<br>ID пользователя: $id";
		
		if ($id) {
			$userItem = Users::getUserById($id);
			echo "<pre>";
			print_r($userItem);
			echo "</pre>";
		}
		
		return true;
	}

	// Авторизация на сайте
	public function actionLogin() {
		echo "<br>Авторизация пользователя";
		return true;
	}

	// Напоминание пароля
	public function actionRemember() {
		echo "<br>Напоминание пароля пользователя";
		return true;
	}

}

?>