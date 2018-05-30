	<div class="info-box">
		<?php if (isset($errors) AND is_array($errors)) : ?>
			<?php foreach ($errors AS $error) : ?>
				<div class="item-error">Ошибка: <?php echo $error; ?></div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>

	</body>
</html>