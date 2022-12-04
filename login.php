<?php require_once 'header.php'; ?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}


require_once('./functions/connect-bd.php');
require_once('./functions/connect-for-users.php'); // передаем $connection

function goLkPage() {
	header('Location: '.'http://localhost/le/lk.php');
}
function check_data($data, $where) {
	$request = "SELECT * FROM user WHERE ".$where." = ?";
    $execute = array($data);
    $array = connect_bd($request, $execute, false);
	if ($array) return 1;
	return 0;
}

function register() {	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_hash = password_hash($password, PASSWORD_BCRYPT);
	if(check_data($username, 'username')) {
		echo('<p class="error">Этот имя уже зарегистрировано!</p>');
		return;
	}
	if(check_data($email, 'email')) {
		echo('<p class="error">Этот адрес уже зарегистрирован!</p>');
		return;
	}
	$request = "INSERT INTO user(username,password,email) VALUES (:username,:password_hash,:email)";
	$execute = array('username' => $username, 'password_hash' => $password_hash, 'email' => $email);
	$array = connect_bd($request, $execute, false);
	if ($array) {
		$_SESSION['user_name'] = $username;
		goLkPage();
	} else {
		echo '<p class="error">Неверные данные!</p>';
	}
}
function login() {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$request = "SELECT * FROM user WHERE username=?";
	$execute = array($username);
	$array = connect_bd($request, $execute, false);
	$error = '<p class="error">Неверные пароль или имя пользователя!</p>';
	if (!$array) {
		echo $error;
		return;
	}
	if (password_verify($password, $array[0]['password'])) {
		$_SESSION['user_name'] = $array[0]['username'];
		$_SESSION['user_id'] = $array[0]['id'];
		goLkPage();
	} else {
		echo $error;
	}
}

if (isset($_POST['register'])) {
	register();
}
if (isset($_POST['login'])) {
	login();
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



<?php require_once 'footer.php'; ?>