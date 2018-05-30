<?php

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
		
		$email = '';
		$password = '';
		$remember = false;
		
		$errors = false;
		
		// Проверяем полученные данные
		if (isset($_POST['login'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			// Работаем с email адресом
			if (Users::checkEmail($email)) {
				echo "<br>email ok!";
			} else {
				$errors[] = "Email некорректен";
			}
			
			// Работаем с паролем
			if (Users::checkPassword($password)) {
				echo "<br>password ok!";
			} else {
				$errors[] = "Пароль не должен быть короче 8-ми символов";
			}
			
			// Работаем с пунктом "запомнить меня"
			if (isset($_POST['remembermy'])) {
				$remember = true;
			}
		}
		
		// Подключаем шаблон для вывода
		require_once(MDIR.'/views/users/login.php');
		
		return true;
	}

	// Напоминание пароля
	public function actionRemember() {
		echo "<br>Напоминание пароля пользователя";
		return true;
	}

}

?>