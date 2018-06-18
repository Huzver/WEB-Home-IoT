<?php
include_once(MDIR.'/views/layouts/header.php');
include_once(MDIR.'/views/layouts/topmenu.php');
?>

<div id="left-menu-box">
	<div class="left-menu-inner">
		<a href="/settings/">Все данные</a>
		<a href="/settings/events/">Системные события</a>
	</div>
</div>

<div id="content-box">
	
	<!-- Информация о сервере -->
	<div class="module-box">
		<div class="module-title">Информация о сервере</div>
		<div class="module-content">
			<?php foreach ($serverInfo AS $index => $value) { ?>
				<div class="item"><strong><?php echo $index.":</strong> - ".$value; ?></div>
			<?php } ?>
		</div>
		<div class="module-footer"></div>
	</div>
	
	<!-- Настройки панели -->
	<div class="module-box">
		<div class="module-title">Настройки панели</div>
		<div class="module-content">
			
		</div>
		<div class="module-footer"></div>
	</div>
</div>


<?php
include_once(MDIR.'/views/layouts/footer.php');
?>