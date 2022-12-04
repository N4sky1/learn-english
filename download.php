<?php require_once 'header.php'; ?>
<?php require_once './functions/no-user-go-main.php'; ?>
<?php require_once './functions/download-from-file.php';?>

<section class="download">
	<form class="download__form-word" method="post"  name="download-form">
		<div>
			<label>Русское слово</label>
			<input type="text" name="rus" pattern="[А-Яа-яЁё\s]+" required />
		</div>
		<div>
			<label>Английское слово</label>
			<input type="text" name="eng" pattern="[A-Za-z\s]+" required />
		</div>
		<div>
			<label>Транскрипция</label>
			<input type="text" name="transcr"  />
		</div>
		<div>
			<label>Комментарий</label>
			<input name="comment"  />
		</div>
		<div>
			<label>Пример предложения на Русском</label>
			<textarea name="example-rus"></textarea>
		</div>
		<div>
			<label>Пример предложения на Английском</label>
			<textarea name="example-eng"></textarea>
		</div>
		<button type="submit" name="download-word" value="download-word">Загрузить</button>
	</form>

	<form class="download__form-file" method="post"  name="download-file">
		<!--<div class="form-element">
			<label>ссылка на таблицу</label>
			<input type="text" name="file"  required />
		</div>-->
		<button type="submit" name="download-file" value="download-file">Загрузить из гугл таблицы</button>
	</form>
</section>



<?php require_once 'footer.php'; ?>