<?php

class users_controller {

	// 1. Авторизация на сайте
	public function actionLogin() {
		
		$email = '';
		$password = '';
		$remember = false;
		
		$errors = false;
		
		// Проверяем полученные данные
		if (isset($_POST['login'])) {
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			
			// Работаем с email адресом
			if (!Users::checkEmail($email)) {
				$errors[] = "Введенный email некорректен";
			}
			if (!Users::checkEmailExists($email)) {
				$errors[] = "Такой email не существует";
			}
			
			// Работаем с паролем
			if (!Users::checkPassword($password)) {
				$errors[] = "Пароль не должен быть короче 8-ми символов";
			}
			
			// Работаем с пунктом "запомнить меня"
			if (isset($_POST['remembermy'])) {
				$remember = true;
			}
			
			// Проверяем существует ли такой пользователь по email и паролю
			// Возвращается ID пользователя из базы или false
			$userId = Users::checkUserData($email, $password);
			
			if ($userId == false) {
				$errors[] = "Неправильные данные для входа";
			} else {
				// Запоминаем, что пользователь вошел корректно (сессия)
				Users::login($userId, $email, $remember);
				
				// Отправляем на главную страницу (Панель управления)
				header("Location: /");
			}
			
		}
		
		// Подключаем шаблон для вывода
		require_once(MDIR.'/views/users/login.php');
		
		return true;
	}
	
	// 2. Выход с сайта
	public function actionLogout() {
		
		// Очищаем данные Сессии
		unset($_SESSION['userId'],$_SESSION['userHash'],$_SESSION['userRemember']);
		header("Location: /login/");
	}

	// 3. Личный кабинет пользователя
	public function actionCabinet() {
		
		// Проверяем, авторизирован ли пользователь
		$userId = Users::checkLogin();
		
		// Получаем нужные данные о пользователе
		if ($userId) {
			$userData = Users::getUserById($userId);
			
			// Выборка данных
			$userName = $userData['user_name'];
		}
		
		// Подключаем шаблон для вывода
		require_once(MDIR.'/views/users/lk.php');
		
		return true;
	}
	
	
	
	
	
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

	// Напоминание пароля
	public function actionRemember() {
		echo "<br>Напоминание пароля пользователя";
		return true;
	}

}

?>