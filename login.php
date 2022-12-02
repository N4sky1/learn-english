<?php require_once 'header.php'; ?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}



require_once('connect-for-users.php'); // передаем $connection


function check_mail($connection, $email) {
	$query = $connection->prepare("SELECT * FROM user WHERE email=:email");
	$query->bindParam("email", $email, PDO::PARAM_STR);
	$query->execute();
	if ($query->rowCount() > 0) {
		return 1; // почта уже есть в бд
	} 
	if ($query->rowCount() == 0) {
		return 0;
	}
}
function check_name($connection, $username) {
	$query = $connection->prepare("SELECT * FROM user WHERE username=:username");
	$query->bindParam("username", $username, PDO::PARAM_STR);
	$query->execute();
	if ($query->rowCount() > 0) {
		return 1; // почта уже есть в бд
	} 
	if ($query->rowCount() == 0) {
		return 0;
	}
}

function register($connection) {	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_hash = password_hash($password, PASSWORD_BCRYPT);
	if(check_name($connection, $username)) {
		echo('<p class="error">Этот имя уже зарегистрировано!</p>');
		return;
	}
	if(check_mail($connection, $email)) {
		echo('<p class="error">Этот адрес уже зарегистрирован!</p>');
		return;
	}
	$query = $connection->prepare("INSERT INTO user(username,password,email) VALUES (:username,:password_hash,:email)");
	$query->bindParam("username", $username, PDO::PARAM_STR);
	$query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
	$query->bindParam("email", $email, PDO::PARAM_STR);
	$result = $query->execute();
	if ($result) {
		echo '<p class="success">Регистрация прошла успешно! через 5 секунд вы будете перенаправлены в личный кабинет</p>';
		$_SESSION['user_name'] = $username;
		goLkPage();
	} else {
		echo '<p class="error">Неверные данные!</p>';
	}
}


if (isset($_POST['register'])) {
	register($connection);
}

function goLkPage() {
	header('Location: '.'http://localhost/le/lk.php');
}
// login form

//session_start();
//include('connect-for-users.php');
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = $connection->prepare("SELECT * FROM user WHERE username=:username");
	$query->bindParam("username", $username, PDO::PARAM_STR);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	if (!$result) {
		echo '<p class="error">Неверные пароль или имя пользователя!</p>';
	} else {
		if (password_verify($password, $result['password'])) {
			$_SESSION['user_name'] = $result['username'];
			$_SESSION['user_id'] = $result['id'];
			goLkPage();
		} else {
			echo '<p class="error"> Неверные пароль или имя пользователя!</p>';
		}
	}
}

?>
<section class="user-input">
	<form class="user-input__login" method="post" action="" name="register-form">
		<div>
			<label>Username</label>
			<input type="text" name="username" pattern="[a-zA-Z0-9]+" 
				required readonly
				onfocus="this.removeAttribute('readonly')"
			/>
		</div>
		<div>
			<label>Email</label>
			<input type="email" name="email" required />
		</div>
		<div>
			<label>Password</label>
			<input type="password" name="password" 
				required readonly
				onfocus="this.removeAttribute('readonly')"
			/>
		</div>
		<button type="submit" name="register" value="register">Register</button>
	</form>

	<form class="user-input__register" method="post" action="" name="login-form">
		<div>
			<label>Username</label>
			<input type="text" name="username" pattern="[a-zA-Z0-9]+" required readonly
		onfocus="this.removeAttribute('readonly')"/>
		</div>
		<div>
			<label>Password</label>
			<input type="password" name="password" required readonly
		onfocus="this.removeAttribute('readonly')"/>
		</div>
		<button type="submit" name="login" value="login">Login</button>
	</form>
</section>



<?php
if(!isset($_SESSION['user_name'])){
	//header('Location: login.php');
	//exit;
	echo("вы не зарегистрированы");
} else {
	echo("вы зарегистрированы");
	echo " - ";
	echo($_SESSION['user_name']);
}?>

<?php require_once 'footer.php'; ?>