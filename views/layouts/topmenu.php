<?php
// Получаем нужные данные о пользователе
if (isset($GLOBALS['userId'])) {
	$userData = Users::getUserById($GLOBALS['userId']);
}

// Получаем массив данных о сегодняешнем дне
$nowDate = Site::getNowDate(time(), $userData['user_time_zone_offset'], $userData['user_time_zone_name']);

?>
<div class="top-box">
	<div id="left-menu-slider" class="menu icon-menu"></div>
	<a class="logo" href="/"></a>
	<div class="button-open-menu">
		<div class="tab-box">
			<a class="icon-objects" href="/objects/" title="Объекты">Объекты</a>
			<a class="icon-sensor" href="/sensors/" title="Датчики">Датчики</a>
			<a class="icon-logic" href="/logic/" title="Логика">Логика</a>
			<a class="icon-chart" href="/charts/" title="Графики">Графики</a>
		</div>
	</div>
	<a class="logout icon-logout" href="/logout/" title="ВЫХОД"></a>
	<?php if (Users::isAdmin($GLOBALS['userId']) != false) { ?>
		<!-- Только для Администраторов -->
		<a class="settings icon-settings" href="/settings/" title="Системные настройки"></a>
	<?php } ?>
	<a class="cabinet icon-user" href="/cabinet/" title="Личный кабинет пользователя"></a>
	<div class="info-now">
		<div class="day-week" title="Сегодня <?php echo $nowDate['nowDayWeek']; ?>"><?php echo $nowDate['nowDayWeek']; ?></div>
		<div class="info-now-2">
			<div class="next-date"><?php echo $nowDate['nowDay'].' '.$nowDate['nowMonth'].' '.$nowDate['nowYear'].' - <span id="timer" data-offset="'.$userData['user_time_zone_offset'].'">'.$nowDate['nowHour'].':'.$nowDate['nowMinute'].':'.$nowDate['nowSecond']; ?></span></div>
			<div class="time-zone"><?php echo $nowDate['nowTimeZone']; ?></div>
		</div>
	</div>
</div>