
<?php require_once 'header.php'; ?>
<?php 
$bd = mysqli_connect("localhost", "root", "", "english"); 
$bd_no_connect_text = "Что то пошло не так, перезагрузите страницу " . mysqli_connect_error();
$bd ? "" : print($bd_no_connect_text);

?>
  <div>
  Главная страница
  </div>
<?php require_once 'footer.php'; ?>
