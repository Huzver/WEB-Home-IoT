<?php

class Router {
	
	private $routes;
	
	public function __construct() {
		$routesPath = MDIR.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	
	// Метод возвращает строку ЧПУ в виде news/views/232323 и т.д.
	// Возвращаемое значение: String
	public function getUrl() {
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'],'/');
		}
	}
	
	// Метод определения наличия Cookie после авторизации
	// Если Cookie нет, то считаем авторизацию не пройденной и направляем на страницу логина
	public function getAuthorization() {
		if (!isset($_COOKIE['loginHash']) AND !isset($_COOKIE['userId'])) {
			return false;
		} else {
			return true;
		}
	}
	
	public function run() {
		
		// Проверяем есть ли у пользователя Cookie
		$cookie = $this->getAuthorization();

		// 1. Получаем строку запроса
		// Например: http://iot.gregory-gost.ru/news
		$url = $this->getUrl();

		// 2. Проверяем наличие такого запроса в /config/routes.php
		foreach ($this->routes AS $urlPattern => $path) {
			// Сравниваем $urlPattern и $url
			if (preg_match("~$urlPattern~", $url)) {
				
				// Получаем обработанную строку запроса
				$internalRoute = preg_replace("~$urlPattern~", $path, $url);

				// Определить какой controlles и action обрабатывают запрос и дополнительные параметры
				$segments = explode('/', $internalRoute);
				
				// Получаем имя контроллера
				$controllerName = array_shift($segments)."_controller";
				
				// Получаем имя метода (Action-а)
				$actionName = "action".ucfirst(array_shift($segments));
				
				if ($cookie != true AND $actionName != 'actionRemember') {
					// Cookie отсутствует
					
					// Открываем страницу Авторизации
					$controllerName = "users_controller";
					$actionName = "actionLogin";
					$parameters = $segments;
					$controllerFile = MDIR."/controllers/".$controllerName.".php";
					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					}
					$controllerObject = new $controllerName;
					$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

				} else {
					// Cookie на месте

					// Получаем остальные параметры
					$parameters = $segments;

					// 3. Подключаем файл класса контроллера
					$controllerFile = MDIR."/controllers/".$controllerName.".php";
					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					}

					// 4. Создаем объект и вызываем метод (т.е. Action)
					$controllerObject = new $controllerName;

					$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
					
				}

				if ($result != null) {
					break;
				}
			}
		}
	}

}

?>