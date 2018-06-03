<?php
$addPageTitle = 'Авторизация';
include_once(MDIR.'/views/layouts/header.php');
?>


<div class="login-body">
	<div class="login-box">
		<div class="login-main">
			<a href="/"><div class="logo"></div></a>
			<div class="title icon-login">Авторизация</div>
			<form action="#" method="post">
				<label class="login-label icon-mail-alt">
					<input type="email" name="email" placeholder="Ваш email" value="<?php echo $email;?>"/>
				</label>
				<label class="login-label icon-key">
					<input type="password" name="password" placeholder="Пароль" value="<?php echo $password;?>" />
				</label>
				<label class="checkbox login-checkbox">
					<input type="checkbox" name="remembermy" value="on" />
					Запомнить
				</label>
				<a class="login-remember" href="/remember/">Забыли пароль?</a>
				<label class="button button-height-35 green login-button">
					Войти
					<input type="submit" name="login" value="ВОЙТИ" />
				</label>
			</form>
			<div class="login-copy">Copyright &copy; <?php echo date('Y', time()); ?></div>
		</div>
	</div>
</div>


<?php
include_once(MDIR.'/views/layouts/footer.php');
?>