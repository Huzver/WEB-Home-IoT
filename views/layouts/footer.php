		</div>
		<div class="info-box">
			<?php if (isset($errors) AND is_array($errors)) : ?>
				<?php foreach ($errors AS $error) : ?>
					<div class="item-error"><strong>Ошибка:</strong>&nbsp;<?php echo $error; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</body>
</html>