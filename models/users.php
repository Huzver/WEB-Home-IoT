<?php

// Модель обработки запросов для пользователей
class Users {
	
	// Получение данных конкретного пользователя
	public static function getUserById($id) {
		// Обрабатываем запрашиваемый ID
		$id = intval($id);
		
		// Подключаемся к базе данных
		$db = DB::getConnection();
		
		// Отправляем запрос в базу данных
		$result = $db->query('
			SELECT
				id,
				group_id,
				name,
				full_name,
				email
			FROM users
			WHERE id='.$id.'
		');
		// Оставим только буквенный вариант выборки
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		// Получаем данные о пользователе
		$usersList = $result->fetch();
		
		// Возвращаем массив с полученными данными
		return $usersList;
	}
	
	// Получение списка всех пользователей
	public static function getUsersList() {
		// Подключаемся к базе данных
		$db = DB::getConnection();
		
		// Подготавливаем список пользователей
		$usersList = array();
		
		// Отправляем запрос в базу данных
		$result = $db->query('
			SELECT
				id,
				group_id,
				name,
				full_name,
				email
			FROM users
			ORDER BY id DESC
		');
		
		// Перебираем массив данных
		$i = 0;
		while($row = $result->fetch()) {
			$usersList[$i]['id'] = $row['id'];
			$usersList[$i]['group_id'] = $row['group_id'];
			$usersList[$i]['name'] = $row['name'];
			$usersList[$i]['full_name'] = $row['full_name'];
			$usersList[$i]['email'] = $row['email'];
			$i++;
		}
		
		// Возвращаем массив с полученными данными
		return $usersList;
	}
	
}

?>