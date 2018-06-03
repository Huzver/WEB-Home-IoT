		<div class="footer">
			<div class="info"><strong>Home Web IoT<sup>&reg;</sup>:</strong> Система для сбора, отображения и управления контроллерами, датчиками и другими устройствами "умного дома"</div>
			<div class="copyright">&copy; Copyright <?php echo date('Y', time()); ?></div>
		</div>
		<div class="info-box">
			<?php if (isset($errors) AND is_array($errors)) : ?>
				<?php foreach ($errors AS $error) : ?>
					<div class="item-error"><strong>Ошибка:</strong>&nbsp;<?php echo $error; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<script src="/templates/js/jquery-3.3.1.min.js"></script>
		<script src="/templates/js/main.js"></script>
		<script>
			$(document).ready(function(){
				$('#left-menu-slider').on('click',function(){
					$('#left-menu-box').animate({width: "toggle"},200,function(){
						$('#left-menu-slider').toggleClass('rotate90');
					});
					return false;
				});
			});
		</script>
	</body>
</html>