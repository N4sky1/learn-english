<?php if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}?>
<?php require_once './functions/logout.php'; ?>


<?php 
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $url;
?>
<!DOCTYPE html>
<html lang="Ru">
<head>
   <title>Изучение Английского</title>
   <link rel="stylesheet" href="./assist/css/main.css">
</head>
<body>
	
<section class="navigation">
	<a  class="navigation__logo" 
		href="http://localhost/le">главная</a>
	<div class="navigation__links">
		<?php
		if(isset($_SESSION['user_name'])){
			?>
			<a href="http://localhost/le/learn.php">учить</a>
			<a href="http://localhost/le/download.php">загрузить</a>
			<a href="http://localhost/le/lk.php"><?php echo $_SESSION['user_name'] ?></a>
			<form method="post" name="exit-form">
				<button type="submit" name="exit" value="exit">выход</button>
			</form>
			<?php
		} else {
			?>
			<a href="http://localhost/le/login.php">вход</a>
			<?php
		}?>
	</div>
</section>

